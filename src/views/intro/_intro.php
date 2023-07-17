<?php

/** @var string $title */

use yii\helpers\Html;
?>

## <?= $title ?>

This is a web site to view the zipcode data of Japan.

The data version is TBD

To see the data list, open <?= Html::a('Zipcode list', ['zipcode/index']) ?>

## Preferences

* [Zipcode data download top](https://www.post.japanpost.jp/zipcode/download.html)
* [CSV download](https://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html)
* [CSV header description](https://www.post.japanpost.jp/zipcode/dl/readme.html)