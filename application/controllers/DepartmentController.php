<?php

namespace app\controllers;

use app\models\Department;
use app\models\forms\DepartmentForm;
use yii\data\ActiveDataProvider;

class DepartmentController extends \yii\web\Controller {
    public function actionIndex () {
        $provider = new ActiveDataProvider([
            'query' => Department::find(),
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ]
        ]);

        return $this->render('list', [
            'provider' => $provider
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

