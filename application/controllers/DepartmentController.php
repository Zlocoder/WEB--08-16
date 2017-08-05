<?php

namespace app\controllers;

use app\models\Department;
use app\models\forms\DepartmentFilter;
use app\models\forms\DepartmentForm;
use yii\data\ActiveDataProvider;

class DepartmentController extends \yii\web\Controller {
    public function actionIndex () {
        $filter = new DepartmentFilter();
        $filter->load(\Yii::$app->request->get());

        $provider = new ActiveDataProvider([
            'query' => $filter->filterQuery,
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ],
            'sort' => [
                'defaultOrder' => [
                    'city' => SORT_ASC,
                    'address' => SORT_ASC,
                    'name' => SORT_ASC,
                ],
                'attributes' => [
                    'name',
                    'address' => [
                        'asc' => ['address' => SORT_ASC, 'name' => SORT_ASC],
                        'desc' => ['address' => SORT_DESC, 'name' => SORT_ASC]
                    ],
                    'city' => [
                        'asc' => ['city' => SORT_ASC, 'address' => SORT_ASC, 'name' => SORT_ASC],
                        'desc' => ['city' => SORT_DESC, 'address' => SORT_ASC, 'name' => SORT_ASC]
                    ],
                    'phone'
                ]
            ]
        ]);

        return $this->render('list', [
            'provider' => $provider,
            'filter' => $filter
        ]);
    }

    public function actionCreate () {
        $form = new DepartmentForm([
            'scenario' => 'create'
        ]);

        if (\Yii::$app->request->isPost) {
            $form->load(\Yii::$app->request->post());

            try {
                if ($form->save()) {
                    return $this->redirect(['department/index']);
                }
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', ['model' => $form]);
    }

    public function actionUpdate($id) {
        $form = new DepartmentForm([
            'scenario' => 'update',
            'department' => Department::findOne($id),
        ]);

        if (\Yii::$app->request->isPost) {
            $form->load(\Yii::$app->request->post());

            try {
                if ($form->save()) {
                    return $this->redirect(['department/index']);
                }
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', ['model' => $form]);
    }

    public function actionDelete($id) {
        Department::deleteAll(['id' => $id]);

        return $this->redirect(['department/index']);
    }
}

