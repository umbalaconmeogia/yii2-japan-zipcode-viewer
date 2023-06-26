# yii2-japanpost-zipcode-csv

This is a simple webpage to view Japanpost zipcode data download from [Japan Post](https://www.post.japanpost.jp/zipcode/download.html).

It is release as an yii2 module so that can be added into yii2 web application.

## Add this module into an yii2 web application

### Install the module

Run
```shell
composer require umbalaconmeogia/yii2-japanpost-zipcode-csv
```

or add `"umbalaconmeogia/yii2-japanpost-zipcode-csv": "*"` to composer.json then run `composer update`

### Edit config

Add to modules in config

```php
$config['modules']['japanzipcodecsv'] = [
    'class' => 'umbalaconmeogia\japanzipcodecsv\Module',
];
```

### Access to the module web page
Now you can access to the module web page via the request `japanzipcodecsv/zipcode/index`.
For example http://app/index.php?r=japanzipcodecsv/zipcode/index

### Add link to the menu
```php
    ['label' => 'ZipcodeCsv', 'url' => ['/japanzipcodecsv/zipcode/index']],
```

## Other operation to maintain the data of the module

* Update to newest data (TBD).
* Set data version
  ```shell
  php yii system-setting/set-zipcode-version <version>
  ```

## Preferences
* [Zipcode data download top](https://www.post.japanpost.jp/zipcode/download.html)
* [CSV download](https://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html)
* [CSV header description](https://www.post.japanpost.jp/zipcode/dl/readme.html)