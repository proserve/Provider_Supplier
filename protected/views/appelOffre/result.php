<?php
$matrix = ProviderCompare::model()->finalM($model->id);
$provider = ProviderCompare::model()->getWinner($model->id);
$providerID= $provider->id;
$finance = Participe::model()->find('appel_offre_id=:offre and provider_id=:provider',
        array(
            'offre' => $model->id,
            'provider' => $provider->id,
        ));
?>

<div id="pr">
<?php
echo '<h1>'.Yii::t('app3', 'L\'avis d\'attribution de l\'appel d\'offre:').' '. $model->titre.'</h1>' ?>
    <div class="pagination-centered">
    <img  src= <?php echo Yii::app()->request->baseUrl. '/images/Logo.jpg'?>  />
    <strong><p>SONATRACH</p></strong>
    <strong> <p style="font-size: 12px; font-style: oblique" >Société Nationale pour la Recherche, la Production, le Transport, la Transformation,<br/>
        et la Commercialisation des Hydrocarbures s.p.a</p></strong>
    <br />
    <br />
    <br />
    
    </div>
      <p>
          Aprés l'évaluation technique et financière; nous recommandons comme mieux disant le fournisseur:
      </p>
       <div class="pagination-centered">
    <!--
    <div class="row">
        <b>
  <div class="span8 offset2">
      <p style="font-size: 15px ; font-family: sans-serif">
      IL EST PORTE A LA CONNAISSANCE DES SOUMISSIONNAIRES CONCERNES PAR 
L’APPEL D’OFFRES NATIONANL RESTREINT N°04/DGAM/SDAG/SM/2010 
PORTANT REALISATION DES TRAVAUX D’AMENAGEMENT GLOBAL DE LA 
BANQUE D’ALGERIE DE JIJEL ,QUE LE MARCHE Y AFFERENT A ETE 
ATTRIBUE PROVISOIREMENT A:</p> </div></b>
</div> -->
    <table class="table table-bordered">
        <thead>
        <th>Soumissionnaire</th> 
        <th>Montant corrigé</th>
        <th>Note Financière NF</th>
        <th>Note Technique NT</th>
        <th>Note Globale (NF*<?php echo $model->finance_rate;?> + NT*<?php echo $model->technique_rate;?>)</th>
        </thead>
        <tbody>
            <tr>
                <td><?php echo ProviderCompare::model()->getWinner($model->id)->name; ?></td>
            <td><?php echo $finance->finance; ?></td>
            <td><?php echo round($matrix['point financière'][$providerID], 2); ?></td>
            <td><?php echo round($matrix['point technique'][$providerID], 2); ?></td>
            <td><?php echo round($matrix['Finale Point'][$providerID], 2); ?></td>
            </tr>
        </tbody>
</table>
   
</div>
</div>
 <br/><br/>
<?php
     $this->widget('ext.mPrint.mPrint', array(
          'title' =>'tes',          //the title of the document. Defaults to the HTML title
          'tooltip' =>  Yii::t('app3', 'Print'),        //tooltip message of the print icon. Defaults to 'print'
          'text' => Yii::t('app3', 'Print'),    //text which will appear beside the print icon. Defaults to NULL
          'element' => '.pagination-centered',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form'
          ),
          'publishCss' => true,       //publish the CSS for the whole page?
         // 'visible' => Yii::app()->user->checkAccess('print'),  //should this be visible to the current user?
         // 'alt' => 'print',       //text which will appear if image can't be loaded
         // 'debug' => true,            //enable the debugger to see what you will get
         // 'id' => 'print-div'         //id of the print link
      ));
?>