<?php 

use app\modules\directory\directoryModule;
use app\modules\directory\helpers\typesViewHelper;
use yii\helpers\Url;

if(!isset($typesDataModel)) {
    $typesDataModel = new \app\modules\directory\models\search\TypesSearch();
}

$typesDataModel->pagination = 7;

?>

            <?php yii\widgets\Pjax::begin([
                'timeout' => \Yii::$app->params['pjaxDefaultTimeout'], 
                'enablePushState' => false, 
                'enableReplaceState' => false, 
                'id' => 'typesCompactGridPjaxWidget'.$uid,
                ]);?>
            <?= yii\grid\GridView::widget([
                'id' => 'typesCompactGridWidget'.$uid,
                'dataProvider' => $typesDataModel->search(),
                'filterModel' => $typesDataModel,
                'filterUrl' => Url::toRoute(['/directory/edit/types']),
                'columns' => [
                    [
                        'class' => 'yii\grid\DataColumn',
                        'contentOptions' => ['class' => 'directory-min-width'],
                        'format' => 'raw',
                        'attribute' => 'name',
                        'filterInputOptions' => ['class' => 'directory-stretch-bar directory-grid-filter-control'],
                        'label' => directoryModule::ht('edit', 'Name'),
                        'value' => function($data) {
                            return typesViewHelper::getNameString($data);
                        }
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'contentOptions' => ['class' => 'directory-min-width'],
                        'filterInputOptions' => ['class' => 'directory-stretch-bar directory-grid-filter-control'],
                        'format' => 'raw',
                        'attribute' => 'type',
                        'filter' => ['string' => directoryModule::ht('edit', 'string'), 
                                                'text' => directoryModule::ht('edit', 'text'), 
                                                'image' => directoryModule::ht('edit', 'image'), 
                                                'file' => directoryModule::ht('edit', 'file')],
                        'label' => directoryModule::ht('edit', 'Type'),
                        'value' => function($data) {
                            return typesViewHelper::getTypeString($data);
                        }
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'filterInputOptions' => ['class' => 'directory-stretch-bar directory-grid-filter-control'],
                        'format' => 'raw',
                        'attribute' => 'description',
                        'label' => directoryModule::ht('edit', 'Description'),
                        'value' => function($data) {
                            return typesViewHelper::getTextString($data['description']);
                        }
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'contentOptions' => ['class' => 'directory-min-width directory-compact-types-grid-edit'],
                        'format' => 'raw',
                        'value' => function($data) {
                            return '<nobr>'
                                    . '<button class="directory-edit-type-button directory-small-button" '
                                    . 'title="'.directoryModule::ht('edit', 'Edit data type').'"><img src="'.
                                    directoryModule::getPublishPath('/img/edit-item.png').
                                    '" /></button>&nbsp;<button class="directory-delete-type-button directory-small-button" '
                                    . 'title="'.directoryModule::ht('edit', 'Delete data type').'"><img src="'.
                                    directoryModule::getPublishPath('/img/delete-item.png')
                                    .'" /></button></nobr>';
                        },
                    ]
                ]
            ]) ?>
            <?php yii\widgets\Pjax::end(); ?>