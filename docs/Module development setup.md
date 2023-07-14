# Module development environment setup

This is how to setup environment for developing an yii2 module.

* First, prepare an yii2 application, hereandafter we call "the app".
* In the composer.json file of the app
  * Set `"minimum-stability": "dev"`.
  * Add the package of the module to `require-dev`, for example
    ```json
    "require-dev": {
        // Other stuffs
		    "umbalaconmeogia/yii2-japanpost-zipcode-csv": "@dev"
    },
    ```
  * Add the path to the module source code to `repositories`, for example
    ```json
    "repositories": [
        // Other stuffs
        {
            "type": "path",
            "url": "/source/japan-zipcode/yii2-japanpost-zipcode-csv"
        }
    ]
    ```
* In the composer.json of the module, set `    "minimum-stability": "dev"`.
* In the app, run `composer update <package>` to install the module into vendor folder (this will create a symbolic link to the source code folder). For example
  ```shell
  composer update umbalaconmeogia/yii2-japanpost-zipcode-csv
  ```