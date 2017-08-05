<?php

use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Отделы', 'url' => ['department/index']];

$this->title = $model->scenario == 'create' ? 'Создание отдела' : 'Редактирование отдела';
?>

<div class="row">
    <div class="col-md-12 text-center">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<?php if ($errors = Yii::$app->session->removeFlash('error')) { ?>
    <div class="alert alert-danger">
        <p><?= $errors ?></p>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-6  col-md-offset-3">
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'phone') ?>

        <div class="form-group text-center">
            <button type="submit">Сохранить</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


