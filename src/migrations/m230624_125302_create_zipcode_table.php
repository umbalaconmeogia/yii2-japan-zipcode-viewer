<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%zipcode}}`.
 */
class m230624_125302_create_zipcode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%zipcode}}', [
            'id' => $this->primaryKey(),
            'local_public_entity_code' => $this->string(), // 全国地方公共団体コード（JIS X0401、X0402）………　半角数字
            'old_zip_code' => $this->string(), // （旧）郵便番号（5桁）………………………………………　半角数字
            'zip_code' => $this->string(), // 郵便番号（7桁）………………………………………　半角数字
            'prefecture_name_kana' => $this->string(), // 都道府県名　…………　半角カタカナ（コード順に掲載）　（注1）
            'city_ward_town_village_name_kana' => $this->string(), // 市区町村名　…………　半角カタカナ（コード順に掲載）　（注1）
            'town_area_name_kana' => $this->string(), // 町域名　………………　半角カタカナ（五十音順に掲載）　（注1）
            'prefecture_name_kanji' => $this->string(), // 都道府県名　…………　漢字（コード順に掲載）　（注1,2）
            'city_ward_town_village_name_kanji' => $this->string(), // 市区町村名　…………　漢字（コード順に掲載）　（注1,2）
            'town_area_name_kanji' => $this->string(), // 町域名　………………　漢字（五十音順に掲載）　（注1,2）
            'multiple_zip_code' => $this->tinyInteger(), // 一町域が二以上の郵便番号で表される場合の表示　（注3）　（「1」は該当、「0」は該当せず）
            'has_banchi' => $this->tinyInteger(), // 小字毎に番地が起番されている町域の表示　（注4）　（「1」は該当、「0」は該当せず）
            'has_chome' => $this->tinyInteger(), // 丁目を有する町域の場合の表示　（「1」は該当、「0」は該当せず）
            'multiple_town_area' => $this->tinyInteger(), // 一つの郵便番号で二以上の町域を表す場合の表示　（注5）　（「1」は該当、「0」は該当せず）
            'modified' => $this->tinyInteger(), // 更新の表示（注6）（「0」は変更なし、「1」は変更あり、「2」廃止（廃止データのみ使用））
            'modified_reason' => $this->tinyInteger(), // 変更理由　（「0」は変更なし、「1」市政・区政・町政・分区・政令指定都市施行、「2」住居表示の実施、「3」区画整理、「4」郵便区調整等、「5」訂正、「6」廃止（廃止データのみ使用））
        ]);
        $indexColumns = [
            'local_public_entity_code',
            'zip_code',
            'multiple_zip_code',
            'has_banchi',
            'has_chome',
            'multiple_town_area',
            'modified',
            'modified_reason'
        ];
        foreach ($indexColumns as $column) {
            $this->createIndex("zipcode-{$column}-idx", 'zipcode', $column);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%zipcode}}');
    }
}
