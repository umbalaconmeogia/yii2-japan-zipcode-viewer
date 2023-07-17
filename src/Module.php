<?php
namespace umbalaconmeogia\japanzipcodecsv;

use Yii;
use yii\helpers\Url;

class Module extends \yii\base\Module
{
    /**
     * Add configuration for command line.
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Database configuration
        \Yii::$app->setComponents([
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'sqlite:' . __DIR__ . '/data/db.sqlite',
                'charset' => 'utf8',
            ],
        ]);

        $this->registerTranslations();

        // Config for command line.
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'umbalaconmeogia\japanzipcodecsv\commands';
        }
    }

    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['japanzipcodecsv'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
            'basePath' => '@umbalaconmeogia/japanzipcodecsv/messages',
            'fileMap' => [
                'japanzipcodecsv' => 'japanzipcodecsv.php',
            ],
        ];
    }

    /**
     * @return string
     */
    public function getIntroName()
    {
        return Yii::t('japanzipcodecsv', 'introName');
    }

    /**
     * @return string
     */
    public function getIntroDescription()
    {
        return Yii::t('japanzipcodecsv', 'introDescription');
    }

    public function getIntroUrl()
    {
        return Url::to(["{$this->id}/intro/index"]);
    }
}