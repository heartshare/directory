<?php 

use app\modules\directory\directoryModule;
use app\modules\directory\helpers\dataGridCellViewHelper;

?>


            <?php yii\widgets\Pjax::begin([
                'timeout' => directoryModule::$SETTING['pjaxDefaultTimeout'], 
                'enablePushState' => false, 
                'enableReplaceState' => false, 
                'id' => 'recordsGridPjaxWidget']); ?>
            <?= yii\grid\GridView::widget([
                'id' => 'recordsGridWidget',
                'dataProvider' => $dataModel->search(),
                'filterModel' => $dataModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\DataColumn',
                        'format' => 'raw',
                        'attribute' => 'value',
                        'filterInputOptions' => ['class' => 'directory-stretch-bar directory-grid-filter-control'],
                        'label' => directoryModule::ht('edit', 'Value'),
                        'value' => function($data) {
                            return 'lll';//dataGridCellViewHelper::getValueDataString($data->type_type, $data->original_value, $data->original_text);
                        }
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'headerOptions' => ['class' => 'directory-min-width'],
                        'format' => 'raw',
                        'attribute' => 'visible',
                        'filterInputOptions' => ['class' => 'directory-stretch-bar directory-grid-filter-control'],
                        'filter' => ['Y' => directoryModule::ht('edit', 'show'), 
                                                'N' => directoryModule::ht('edit', 'hide')],
                        'label' => directoryModule::ht('edit', 'Visible'),
                        'value' => function($data) {
                            return dataGridCellViewHelper::getVisibleFlagString($data->visible);
                        }
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'headerOptions' => ['class' => 'directory-min-width'],
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
