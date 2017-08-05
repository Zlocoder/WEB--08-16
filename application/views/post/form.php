<?php

use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Должности', 'url' => ['post/index']];

$this->title = $model->scenario == 'create' ? 'Добавление должности' : 'Редактирование должности';

?>

<div class="row">
    <div class="col-md-12 text-center">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<?php if ($error = Yii::$app->session->removeFlash('error')) { ?>
    <div class="alert alert-danger">
        <p><?= $error ?></p>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'name') ?>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
