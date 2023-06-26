<?php

namespace umbalaconmeogia\japanzipcodecsv\controllers;

use umbalaconmeogia\japanzipcodecsv\models\ZipcodeSearch;
use yii\web\Controller;

/**
 * ZipcodeController implements the CRUD actions for Zipcode model.
 */
class ZipcodeController extends Controller
{
    /**
     * Lists all Zipcode models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ZipcodeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
