<?php

/** @var string $title */

use yii\helpers\Html;
?>

## <?= $title ?>

これは日本郵便番号データを見るウェブサイトである。

でーばバージョンは TBD。

データ一覧を見るには、<?= Html::a('郵便番号一覧', ['zipcode/index']) ?>を開いてください。

## 参考

* [郵便番号データダウンロードトップページ](https://www.post.japanpost.jp/zipcode/download.html)
* [CSVダウンロード](https://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html)
* [CSVヘッダーの説明](https://www.post.japanpost.jp/zipcode/dl/readme.html)