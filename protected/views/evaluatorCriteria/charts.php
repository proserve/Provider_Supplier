<h1><?php echo Yii::t('app2', 'Graphical view')  ?></h1>

<?php $collapse = $this->beginWidget('bootstrap.widgets.TbCollapse');
?>
     <div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">
           <?php echo Yii::t('app1', 'Grid'); ?> 
        </a>
    </div>
    <div id="collapseThree" class="accordion-body collapse">
        <div class="accordion-inner">
           <?php echo $this->renderPartial('alignement', NULL, true);?>
        </div>
    </div>
</div>
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
           <?php echo Yii::t('app1', 'Pei chart'); ?>
        </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
        <div class="accordion-inner">
           <?php echo $this->renderPartial('peiChartView', NULL, true);?>
        </div>
    </div>
</div>
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
            <?php echo Yii::t('app1', 'Line chart'); ?>
        </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
        <div class="accordion-inner">
           <?php echo $this->renderPartial('lineChartView', NULL, true);?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>