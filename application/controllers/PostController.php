<?php

namespace app\controllers;

use app\models\forms\PostFilter;
use app\models\forms\PostForm;
use app\models\Post;
use yii\data\ActiveDataProvider;

class PostController extends \yii\web\Controller {
    public function actionIndex() {
        $filter = new PostFilter();
        $filter->load(\Yii::$app->request->get());

        $provider = new ActiveDataProvider([
            'query' => $filter->filterQuery,
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ],
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ]
        ]);
        
        return $this->render('list', [
            'provider' => $provider,
            'filter' => $filter
        ]);
    }

    public function actionCreate() {
        $form = new PostForm([
            'scenario' => 'create'
        ]);
        
        if (\Yii::$app->request->isPost) {
            $form->load(\Yii::$app->request->post());

            try {
                if ($form->save()) {
                    return $this->redirect(['post/index']);
                }
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', ['model' => $form]);
    }

    public function actionUpdate($id) {
        $form = new PostForm([
            'scenario' => 'update',
            'post' => Post::findOne($id),
        ]);

        if (\Yii::$app->request->isPost) {
            $form->load(\Yii::$app->request->post());

            try {
                if ($form->save()) {
                    return $this->redirect(['post/index']);
                }
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', ['model' => $form]);
    }

    public function actionDelete($id) {
        Post::deleteAll(['id' => $id]);

        return $this->redirect(['post/index']);
    }
}