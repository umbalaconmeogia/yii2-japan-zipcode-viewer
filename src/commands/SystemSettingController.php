<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace umbalaconmeogia\japanzipcodecsv\commands;

use umbalaconmeogia\japanzipcodecsv\models\SystemSetting;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manipulate Zipcode data
 */
class SystemSettingController extends Controller
{
    /**
     * Set version of zipcode data.
     * Syntax
     * ```shell
     *   php yii system-setting/set-zipcode-version <version>
     * ```
     * Example
     * ```shell
     *   php yii system-setting/set-zipcode-version 20230531
     * ```
     *
     * @param string $version Version of zipcode data. For example, 20230531.
     * @return int Exit code
     */
    public function actionSetZipcodeVersion($version)
    {
        $systemSetting = SystemSetting::findOne(['key' => SystemSetting::KEY_ZIPCODE_VERSION]);
        if (!$systemSetting) {
            $systemSetting = new SystemSetting([
                'key' => SystemSetting::KEY_ZIPCODE_VERSION,
            ]);
        }
        $systemSetting->value = $version;
        $systemSetting->save();

        return ExitCode::OK;
    }
}
