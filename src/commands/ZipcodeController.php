<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace umbalaconmeogia\japanzipcodecsv\commands;

use umbalaconmeogia\japanzipcodecsv\helpers\SjisToUtf8EncodingFilter;
use umbalaconmeogia\japanzipcodecsv\models\Zipcode;
use Exception;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manipulate SystemSetting
 */
class ZipcodeController extends Controller
{
    /**
     * Set version of zipcode data.
     * Syntax
     * ```shell
     *   php yii japanzipcodecsv/zipcode/import-japanpost-csv <csvPath>
     * ```
     * Example
     * ```shell
     *   php yii japanzipcodecsv/zipcode/import-japanpost-csv data/KEN_ALL.CSV
     * ```
     *
     * @param string $csvFilePath Path to csv file.
     * @return int Exit code
     */
    public function actionImportJapanpostCsv($csvFilePath)
    {
        // Delete all current Zipcode data.
        Zipcode::deleteAll();

        // Import from csv.
        // stream_filter_register(
        //     'sjis_to_utf8_encoding_filter',
        //     SjisToUtf8EncodingFilter::class
        // );

        if(0 === strpos(PHP_OS, 'WIN')) {
            setlocale(LC_CTYPE, 'C');
        }

        $fp = fopen($csvFilePath, 'r');
        // stream_filter_append($fp, 'sjis_to_utf8_encoding_filter');
        $csvColumnMapping = [
            0 => 'local_public_entity_code',
            1 => 'old_zip_code',
            2 => 'zip_code',
            3 => 'prefecture_name_kana',
            4 => 'city_ward_town_village_name_kana',
            5 => 'town_area_name_kana',
            6 => 'prefecture_name_kanji',
            7 => 'city_ward_town_village_name_kanji',
            8 => 'town_area_name_kanji',
            9 => 'multiple_zip_code',
            10 => 'has_banchi',
            11 => 'has_chome',
            12 => 'multiple_town_area',
            13 => 'modified',
            14 => 'modified_reason',
        ];
        $convertToFullWidth = [
            'prefecture_name_kana',
            'city_ward_town_village_name_kana',
            'town_area_name_kana',
        ];
        try {
            while (($row = fgetcsv($fp)) !== FALSE) {
                $zipcode = new Zipcode();
                foreach ($csvColumnMapping as $index => $attribute) {
                    $zipcode->$attribute = $row[$index];
                }
                foreach ($convertToFullWidth as $attribute) {
                    $zipcode->$attribute = mb_convert_kana($zipcode->$attribute, 'KV');
                }
                $zipcode->save();
            }
        } catch (Exception $e) {
            print_r($row);
            throw $e;
        }
        fclose($fp);

        return ExitCode::OK;
    }
}
