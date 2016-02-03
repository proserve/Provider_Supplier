<h1>Ranking</h1>
<?php 
$matrix = ProviderCompare::model()->finaleMatrix();
$json = '';
$prov =Provider::model()->getProviderUpdateOption() ;
 foreach ($prov as $key => $value) {
    $json .= '{"N":"N°:'.($key+1).'","Provider":"'.$value->id.'","ProviderName":"'.$value->name.'",'
            . '"techniquePoint":'.$matrix['point technique'][$value->id].','
            . '"FinancePoint":'.$matrix['point financière'][$value->id].
            ',"totalPoint":'.$matrix['Finale Point'][$value->id].'},';
}
$json = '['.$json.']';
print_r(json_decode($json, true, JSON_OBJECT_AS_ARRAY));
?>
<link href="../../../kendoui/examples/content/shared/styles/examples-offline.css" rel="stylesheet">
    <link href="../../../kendoui/styles/kendo.common.min.css" rel="stylesheet">
    <link href="../../../kendoui/styles/kendo.default.min.css" rel="stylesheet">
    <script src="../../../kendoui/js/jquery.min.js"></script>
    <script src="../../../kendoui/js/kendo.web.min.js"></script>
            <div id="clientsDb">

                <div id="grid" style="height: 380px">Providers ranking</div>

            </div>

            <script>
                $(document).ready(function() {
                    $("#grid").kendoGrid({
                        dataSource: {
                            data: <?php echo $json?>,
                            schema: {
                                model: {
                                    fields: {
                                        N: { type: "string" },
                                        Provider: { type: "string" },
                                        ProviderName: { type: "string" },
                                        techniquePoint: { type: "number" },
                                        FinancePoint: { type: "number" },
                                        totalPoint: { type: "number" },
                                    }
                                }
                            },
                            pageSize: 20,
                            serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true
                        },
                        height: <?php echo count($prov)*50+50?>,
                        sortable: true,
                        filterable: true,
                        columnMenu: true,
                        pageable: true,
                        columns: [
                            "N",
                            "Provider",
                            "ProviderName",
                            "techniquePoint",
                            "FinancePoint",
                            "totalPoint",
                        ]
                    });
                });
            </script>

