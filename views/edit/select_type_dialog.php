<?php 

use yii\jui\Dialog;
use yii\web\View;
use app\modules\directory\directoryModule;

?>

<?php if(false) { ?><style><?php } ob_start(); ?>
    
<?php $this->registerCss(ob_get_clean()); if(false) { ?></style><?php } ?>

<div class="directory-hide-element">

<?php 
Dialog::begin([
    'id' => 'selectTypeDialog',
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'resizable' => false,
        'width' => 600
    ],
]); ?>


<div>
    
<?php require('types_compact_grid.php');?>
    
    <span id="waitDlgQueryCompactDataType" class="directory-hide-element">
        <nobr>
            <img src="<?= directoryModule::getPublishPath('/img/wait.gif')?>">
            <span><?= directoryModule::t('search', 'processing request')?></span>
        </nobr>
    </span>
    <div id="errorDlgQueryCompactDataType" class="directory-error-msg directory-hide-element"></div>
    <div id="okDlgQueryCompactDataType" class="directory-ok-msg directory-hide-element"></div>

</div>


<?php Dialog::end(); ?>

</div>

<?php if(false) { ?><script type="text/javascript"><?php } ob_start(); ?>
    
    $("#selectTypeDialog").dialog("option", "buttons", {
            "<?= directoryModule::t('edit', 'Close')?>" : function() { 
                $(this).dialog("close").data("resultCallback")(false); 
            }
    });
    
<?php $this->registerJs(ob_get_clean(), View::POS_READY); if(false) { ?></script><?php } ?>

<?php if(false) { ?><script type="text/javascript"><?php } ob_start(); ?>
    
    function SelectDataType(resultCallback) {
        $("#selectTypeDialog").
                data("resultCallback", resultCallback).
                dialog("open");
        $.pjax.reload("#typesCompactGridPjaxWidget", {timeout : 30000});
    }
    
<?php $this->registerJs(ob_get_clean(), View::POS_HEAD); if(false) { ?></script><?php } ?>