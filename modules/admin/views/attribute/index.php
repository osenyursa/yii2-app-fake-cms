<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Model;
use app\models\Attribute;

$title = function () {
    $title = '';
    if ($model_id = Yii::$app->request->get('model_id')) {
        $title .= Model::findOne($model_id)->title . ' - ';
    }
    $title .= Yii::t('cms', 'Attributes');

    return $title;
};

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $title();
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            Yii::t('cms', 'Create {modelClass}', ['modelClass' => Yii::t('cms', 'Attribute')]),
            ['create','model_id' => Yii::$app->request->get('model_id')],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'title',
            'field',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Attribute::$typeLabels[$model->type];
                },
            ],
            // 'value',
            // 'remark',
            // 'is_show',
            // 'extra',
            // 'model_id',
            // 'is_must',
            // 'status',
            // 'update_time',
            // 'create_time',
            // 'validate_rule',
            // 'validate_time:datetime',
            // 'error_info',
            // 'validate_type',
            // 'auto_rule',
            // 'auto_time:datetime',
            // 'auto_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
