<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Markdown;

$this->title = Yii::t('app', 'Japan zipcode csv');
?>
<div class="site-index">
    <?= Markdown::process($this->render('_intro', ['title' => $this->title])) ?>
</div>