<?php
$var = Criteria::model()->getSelectedCriteria();
    $ar =array();$data1 =array();$data2 =array();
    $chaine ='';
    $o = 1;
     foreach ($var as $key=>$value) {
           
            $ar[$o-1] = Criteria::model()->findByPk($key)->name;
            $data1[$o-1] = round($value*100/EvaluatorCriteria::model()->getCriteriasMarksSum(),3);
            $data2[$o-1] = round($value*100/Criteria::model()->getSelectedCriteriaSum(),3);
            $chaine .='["'.$ar[$o-1].'",'. $data2[$o-1].'],';
           $o++;
           
        }

$this->widget('ext.highcharts.HighchartsWidget', array(
   'options'=>'{
      chart: {
      width: 1000,
      height:1000
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            "text":"'.Yii::t('app1', 'Selected Criterias').'"
        },
        "tooltip": {
    	    "pointFormat": "{series.name}: <b>{point.percentage:.1f}%</b>"
        },
        "plotOptions": {
            "pie": {
                "allowPointSelect": "true",
                "cursor": "pointer",
                "dataLabels": {
                    "enabled": true,
                    "color": "#000000",
                    "connectorColor": "#000000",
                    "format": "<b>{point.name}</b>: {point.percentage:.1f} %"
                }
            }
        },
        "series": [{
            "type": "pie",
            "name": "Importance share",
            "data": [
                '.$chaine.'
            ]
        }]
   }'
));?>