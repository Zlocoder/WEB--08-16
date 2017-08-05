<?php
use yii\helpers\Url;
use yii\grid\GridView;

$this->params['breadcrumbs'] = [['label' => 'Отделы']];
$this->title = 'Сисок отделов';
?>

<div class="row">
    <div class="col-md-12 text-center">
        <h1>Список отделов</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a href="<?= Url::to(['department/create'])?>" class="btn btn-default pull-right">Добавить отдел <i class="glyphicon glyphicon-plus"></i></a>
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
                'name',
                'city',
                'address',
                'phone',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}'
                ]
            ]
        ]) ?>
    </div>
</div>