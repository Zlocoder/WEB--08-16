<?php

use yii\helpers\Url;
use yii\grid\GridView;

$this->params['breadcrumbs'] = [['label' => 'Должности']];
$this->title = 'Список должностей';

?>

<div class="row">
    <div class="col-md-12 text-center">
        <h1>Список должностей</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a href="<?= Url::to(['post/create'])?>" class="btn btn-default pull-right">Добавить должность <i class="glyphicon glyphicon-plus"></i></a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $filter,
            'summary' => 'Показано с {begin} по {end} из {totalCount}',
            'columns' => [
                'id',
                [
                    'attribute' => 'name',
                    'filterInputOptions' => ['class' => 'form-control input-sm']
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
                ]
            ]
        ]) ?>
    </div>
</div>