<?php

namespace umbalaconmeogia\japanzipcodecsv\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "zipcode".
 *
 * @property int $id
 * @property string|null $local_public_entity_code
 * @property string|null $old_zip_code
 * @property string|null $zip_code
 * @property string|null $prefecture_name_kana
 * @property string|null $city_ward_town_village_name_kana
 * @property string|null $town_area_name_kana
 * @property string|null $prefecture_name_kanji
 * @property string|null $city_ward_town_village_name_kanji
 * @property string|null $town_area_name_kanji
 * @property int|null $multiple_zip_code
 * @property int|null $has_banchi
 * @property int|null $has_chome
 * @property int|null $multiple_town_area
 * @property int|null $modified
 * @property int|null $modified_reason
 *
 * @property string $multipleZipCodeStr
 * @property string $hasBanchiStr
 * @property string $hasChomeStr
 * @property string $multipleTownAreaStr
 * @property string $modifiedStr
 * @property string $modifiedReasonStr
 */
class Zipcode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zipcode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['multiple_zip_code', 'has_banchi', 'has_chome', 'multiple_town_area', 'modified', 'modified_reason'], 'integer'],
            [['local_public_entity_code', 'old_zip_code', 'zip_code', 'prefecture_name_kana', 'city_ward_town_village_name_kana', 'town_area_name_kana', 'prefecture_name_kanji', 'city_ward_town_village_name_kanji', 'town_area_name_kanji'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('japanzipcodecsv', 'ID'),
            'local_public_entity_code' => Yii::t('japanzipcodecsv', 'Local Public Entity Code'),
            'old_zip_code' => Yii::t('japanzipcodecsv', 'Old Zip Code'),
            'zip_code' => Yii::t('japanzipcodecsv', 'Zip Code'),
            'prefecture_name_kana' => Yii::t('japanzipcodecsv', 'Prefecture Name Kana'),
            'city_ward_town_village_name_kana' => Yii::t('japanzipcodecsv', 'City Ward Town Village Name Kana'),
            'town_area_name_kana' => Yii::t('japanzipcodecsv', 'Town Area Name Kana'),
            'prefecture_name_kanji' => Yii::t('japanzipcodecsv', 'Prefecture Name Kanji'),
            'city_ward_town_village_name_kanji' => Yii::t('japanzipcodecsv', 'City Ward Town Village Name Kanji'),
            'town_area_name_kanji' => Yii::t('japanzipcodecsv', 'Town Area Name Kanji'),
            'multiple_zip_code' => Yii::t('japanzipcodecsv', 'Multiple Zip Code'),
            'has_banchi' => Yii::t('japanzipcodecsv', 'Has Banchi'),
            'has_chome' => Yii::t('japanzipcodecsv', 'Has Chome'),
            'multiple_town_area' => Yii::t('japanzipcodecsv', 'Multiple Town Area'),
            'modified' => Yii::t('japanzipcodecsv', 'Modified'),
            'modified_reason' => Yii::t('japanzipcodecsv', 'Modified Reason'),
        ];
    }

    private static function applicableOptionArr()
    {
        return [
            0 => '該当せず',
            1 => '該当',
        ];
    }

    /**
     * @return string[]
     */
    public static function multipleZipCodeOptionArr()
    {
        return self::applicableOptionArr();
    }

    /**
     * @return string
     */
    public function getMultipleZipCodeStr()
    {
        return ArrayHelper::getValue(self::multipleZipCodeOptionArr(), $this->multiple_zip_code);
    }

    /**
     * @return string[]
     */
    public static function hasBanchiOptionArr()
    {
        return self::applicableOptionArr();
    }

    /**
     * @return string
     */
    public function getHasBanchiStr()
    {
        return ArrayHelper::getValue(self::hasBanchiOptionArr(), $this->has_banchi);
    }

    /**
     * @return string[]
     */
    public static function hasChomeOptionArr()
    {
        return self::applicableOptionArr();
    }

    /**
     * @return string
     */
    public function getHasChomeStr()
    {
        return ArrayHelper::getValue(self::hasChomeOptionArr(), $this->has_chome);
    }

    /**
     * @return string[]
     */
    public static function multipleTownAreaOptionArr()
    {
        return self::applicableOptionArr();
    }

    /**
     * @return string
     */
    public function getMultipleTownAreaStr()
    {
        return ArrayHelper::getValue(self::multipleTownAreaOptionArr(), $this->multiple_town_area);
    }

    /**
     * @return string[]
     */
    public static function modifiedOptionArr()
    {
        return [
            0 => '変更なし',
            1 => '変更あり',
            2 => '廃止',
        ];
    }

    /**
     * @return string
     */
    public function getModifiedStr()
    {
        return ArrayHelper::getValue(self::modifiedOptionArr(), $this->modified);
    }

    /**
     * @return string[]
     */
    public static function modifiedReasonOptionArr()
    {
        return [
            0 => '変更なし',
            1 => '市政・区政・町政・分区・政令指定都市施行',
            2 => '住居表示の実施',
            3 => '区画整理',
            4 => '郵便区調整等',
            5 => '訂正',
            6 => '廃止',
        ];
    }

    /**
     * @return string
     */
    public function getModifiedReasonStr()
    {
        return ArrayHelper::getValue(self::modifiedReasonOptionArr(), $this->modified_reason);
    }
}