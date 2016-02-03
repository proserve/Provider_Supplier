
<?php
$var = Criteria::model()->getSelectedCriteria();
    $ar =array();$data1 =array();$data2 =array();
  //  $chaine ='';
    $o = 1;
        foreach ($var as $key=> $value) {
           
            $ar[$o-1] = Criteria::model()->findByPk($key)->name;
            $data1[$o-1] = round($value*100/EvaluatorCriteria::model()->getCriteriasMarksSum(),3);
            $data2[$o-1] = round($value*100/Criteria::model()->getSelectedCriteriaSum(),3);
           $o++;
           
        }
        
        $vari = $this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
       'exporting' => array('enabled' => true),
        'chart'=>array(
                'type'=>'line',
            'height'=>500 ,
            'width'=>1000
            ),
      'title' => array('text' =>  Yii::t('app', 'Criterias')),
      'xAxis' => array(
         'categories' => $ar,

      ),
      'yAxis' => array(
         'title' => array('text' => Yii::t('app1', 'Criteria Importance'))
      ),
      'series' => array(
         array('name' => Yii::t('app1', 'Importance level %(Befor AL)') , 'data' => $data1),
         array('name' => Yii::t('app1', 'Importance level %(After AL)') , 'data' =>$data2)
      ),
        'plotOptions'=>array(
                'line'=>array (
                    'dataLabels'=>array( 
                        'enabled'=>true
                    ),
                    'enableMouseTracking'=> false
                )
            ),
       'htmlOptions'=>array(),
    // register additional scripts
    // register themes
       'theme'=>'grid',
   )
));
?>