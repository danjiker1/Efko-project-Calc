<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'История расчетов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'user.username',
            'label' => 'Пользователь',
            'value' => function ($model) {
                return $model->user ? $model->user->username : '(not set)';
            },
        ],
        [
            'attribute' => 'month.name', 
            'label' => 'Месяц',
            'filter' => Html::dropDownList('HistorySearch[month_id]', null, $months, ['class' => 'form-control']),
        ],
        [
            'attribute' => 'tonnage.value', 
            'label' => 'Тоннаж',
            'filter' => Html::dropDownList('HistorySearch[tonnage_id]', null, $tonnages, ['class' => 'form-control']),
        ],
        [
            'attribute' => 'rawType.name', 
            'label' => 'Тип сырья',
            'filter' => Html::dropDownList('HistorySearch[raw_type_id]', null, $rawTypes, ['class' => 'form-control']),
        ],
        'price',
    ],
]); ?>
</div>