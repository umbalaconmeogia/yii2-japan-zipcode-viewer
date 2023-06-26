<?php
/**
 * Stream filter.
 * Source: https://qiita.com/suin/items/3edfb9cb15e26bffba11
 */
namespace umbalaconmeogia\japanzipcodecsv\helpers;

final class SjisToUtf8EncodingFilter extends \php_user_filter
{
    /**
     * Buffer size limit (bytes)
     *
     * @var int
     */
    private static $bufferSizeLimit = 1024;

    /**
     * @var string
     */
    private $buffer = '';

    public static function setBufferSizeLimit(int $bufferSizeLimit): void
    {
        self::$bufferSizeLimit = $bufferSizeLimit;
    }

    /**
     * @param resource $in
     * @param resource $out
     * @param int $consumed
     * @param bool $closing
     */
    public function filter($in, $out, &$consumed, $closing): int
    {
        $isBucketAppended = false;
        $previousData = $this->buffer;
        $deferredData = '';

        while ($bucket = \stream_bucket_make_writeable($in)) {
            $data = $previousData . $bucket->data; // 前回後回しにしたデータと今回のチャンクデータを繋げる
            $consumed += $bucket->datalen;

            // 受け取ったチャンクデータの最後から1文字ずつ削っていって、SJIS的に区切れがいいところまでデータを減らす
            while ($this->needsToNarrowEncodingDataScope($data)) {
                $deferredData = \substr($data, -1) . $deferredData; // 削ったデータは後回しデータに付け加える
                $data = \substr($data, 0, -1);
            }

            if ($data) { // ここに来た段階で $data は区切りが良いSJIS文字列になっている
                $bucket->data = $this->encode($data);
                \stream_bucket_append($out, $bucket);
                $isBucketAppended = true;
            }
        }

        $this->buffer = $deferredData; // 後回しデータ: チャンクデータの句切れが悪くエンコードできなかった残りを次回の処理に回す
        $this->assertBufferSizeIsSmallEnough(); // メモリ不足回避策: バッファを使いすぎてないことを保証する
        return $isBucketAppended ? \PSFS_PASS_ON : \PSFS_FEED_ME;
    }

    private function needsToNarrowEncodingDataScope(string $string): bool
    {
        return !($string === '' || $this->isValidEncoding($string));
    }

    private function isValidEncoding(string $string): bool
    {
        return \mb_check_encoding($string, 'SJIS-win');
    }

    private function encode(string $string): string
    {
        return \mb_convert_encoding($string, 'UTF-8', 'SJIS-win');
    }

    private function assertBufferSizeIsSmallEnough(): void
    {
        \assert(
            \strlen($this->buffer) <= self::$bufferSizeLimit,
            \sprintf(
                'Streaming buffer size must less than or equal to %u bytes, but %u bytes allocated',
                self::$bufferSizeLimit,
                \strlen($this->buffer)
            )
        );
    }
}