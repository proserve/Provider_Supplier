<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>

<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => Yii::t('app', 'Welcome to ') .' '. CHtml::encode(Yii::t('app', 'Provider Selector')),
));
echo '<br>';
$this->widget('bootstrap.widgets.TbCarousel', array(
    'items' => array(
        array(
            'image' => Yii::app()->request->baseUrl . '/images/slide1.jpg',
            'label' => 'Second Thumbnail label',
           /* 'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. ' .
            'Donec id elit non mi porta gravida at eget metus. ' .
            'Nullam id dolor id nibh ultricies vehicula ut id elit.'*/),
        array(
            'image' => Yii::app()->request->baseUrl . '/images/slide2.jpg',
            'label' => 'First Thumbnail label',
            /*'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. ' .
            'Donec id elit non mi porta gravida at eget metus. ' .
            'Nullam id dolor id nibh ultricies vehicula ut id elit.'*/),
    ),
    'htmlOptions' => array('style' => 'width:900px;margin-left:200px;', 'class' => 'carousel slide', 'id' => 'myCarousel'),
    'options' => array(),
));
$this->endWidget();

?>

