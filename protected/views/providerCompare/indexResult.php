<?php
echo '<h1>'.Yii::t('app3', 'Award notices').'</h1>';

$offre = AppelOffre::model()->findAll('publish=1');
$json = CJSON::encode($offre);

?>
    <link href="../../../../kendoui/examples/content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="../../../../kendoui/styles/kendo.common.min.css" rel="stylesheet">
    <link href="../../../../kendoui/styles/kendo.default.min.css" rel="stylesheet">

    <script src="../../../../kendoui/js/jquery.min.js"></script>
    <script src=".../../../../kendoui/js/kendo.web.min.js"></script>
    <script>
        
    </script>
    

    
    <div id="example" class="k-content">

  

    <div class="demo-section">
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap"></div>
    </div>

    <script type="text/x-kendo-tmpl" id="template">
        <div class="product-view k-widget">
            <div class="edit-buttons">
               
            </div>
            <dl>
            
                <dt><a " href="?r=appelOffre/result&number=#=number#">Titre</a></dt>
                <dd><a " href="?r=appelOffre/result&number=#=number#">#:titre# (Consulter)</a></dd>
              
                <dt>Numéro</dt>
                <dd>#:number#</dd>
                <dt>Référence</dt>
                <dd>#:reference#</dd>
        <dt>Type</dt>
                <dd>#:type#</dd>
            </dl>  
  
        </div>
    </script>

    <script src="../../../../kendoui/examples/content/shared/js/products.js"></script>
    <script>
        $(document).ready(function () {
                dataSource = new kendo.data.DataSource({
		data :<?php echo $json; ?>,
                    batch: true,
                    pageSize: 10,
                    id: "id",
                    schema: {
                        model: {
                            id: "ProductID",
                            fields: {
                                id: { editable: false, nullable: true },
                                titre: "titre",
                                type: "type",
                                reference: "reference",
                                number:  "number"
                            }
                        }
                    }
                });


            $("#pager").kendoPager({
                dataSource: dataSource
            });

            var listView = $("#listView").kendoListView({
                dataSource: dataSource,
                template: kendo.template($("#template").html()),
               // editTemplate: kendo.template($("#editTemplate").html())
            }).data("kendoListView");

        });
    </script>

    <style scoped>
        .demo-section {
            width: 805px;
        }
      /*  .product-view
        {
            float: left;
            position: relative;
            width: 301px;
            margin: -1px -1px 0 0;
        }*/
        .product-view dl
        {
            margin: 10px 0;
            padding: 0;
            min-width: 0;
        }
        .product-view dt, dd
        {
            float: left;
            margin: 0;
            padding: 3px;
            height: 26px;
            width: 600px;
            line-height: 26px;
            overflow: hidden;
        }
        .product-view dt
        {
            clear: left;
            padding: 3px 5px 3px 0;
            text-align: right;
            opacity: 0.6;
            width: 100px;
        }
        .k-listview
        {
            border: 0;
            padding: 0;
            min-width: 400px;
            min-height: 298px;
        }
        .k-listview:after, .product-view dl:after
        {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
        .edit-buttons
        {
            position: absolute;
            top: 0;
            right: 0;
            width: 26px;
            height: 146px;
            padding: 2px 2px 0 3px;
            background-color: rgba(0,0,0,0.1);
        }
        .edit-buttons .k-button
        {
            width: 26px;
            margin-bottom: 1px;
        }
        .k-pager-wrap
        {
            border-top: 0;
        }
        span.k-invalid-msg
        {
            position: absolute;
            margin-left: 6px;
        }
    </style>
</div>
<?php
$this->widget('ext.mPrint.mPrint', array(
          'title' => 'title',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Print',        //tooltip message of the print icon. Defaults to 'print'
          'text' => Yii::t('app3', 'Print') ,   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#print12',        //the element to be printed.
          'exceptions' => array(       //the element/s which will be ignored
              '.summary',
              '.search-form'
          ),
          'publishCss' => true,       //publish the CSS for the whole page?
         // 'visible' => Yii::app()->user->checkAccess('print'),  //should this be visible to the current user?
         // 'alt' => 'print',       //text which will appear if image can't be loaded
         // 'debug' => true,            //enable the debugger to see what you will get
      //    'id' => '#page'         //id of the print link
      ));
?>