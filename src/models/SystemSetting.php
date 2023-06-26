<?php

namespace umbalaconmeogia\japanzipcodecsv\models;

use Yii;

/**
 * This is the model class for table "system_setting".
 *
 * @property int $id
 * @property string|null $key
 * @property string|null $value
 */
class SystemSetting extends \yii\db\ActiveRecord
{
    const KEY_ZIPCODE_VERSION = 'ZIPCODE_VERSION';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('japanzipcodecsv', 'ID'),
            'key' => Yii::t('japanzipcodecsv', 'Key'),
            'value' => Yii::t('japanzipcodecsv', 'Value'),
        ];
    }

    /**
     * @return string|null
     */
    public static function zipcodeVersion()
    {
        $systemSetting = SystemSetting::findOne(['key' => self::KEY_ZIPCODE_VERSION]);
        return $systemSetting ? $systemSetting->value : NULL;
    }
}
