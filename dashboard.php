<?php
if(!isset($_SESSION)){session_start();} ;
include_once "_header.php";
redirectIfNotLoggedIn();
if(isSeller() || isBuyer()){
    header("Location:order/");
    exit();
}
?>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
    $(function(){
        var chart = new CanvasJS.Chart("chartContainer",
            {
                title: {
                    text: "Progress Report"
                },
                creditText: "",
                data: [
                    {
                        type: "column",
                        dataPoints: [

                            { y: 10, label: "Users"},
                            { y: 500, label: "Products"},
                            { y: 50, label: "Orders"}
                        ]
                    }
                ]
            });
        chart.render();
    });
    var credit_remover = setInterval(function(){
        if($(".canvasjs-chart-credit")){
            $(".canvasjs-chart-credit").remove();
            clearInterval(credit_remover)
        }
    },200);
</script>
<div class="container" style="width: 90%;margin: 0 auto">
    <div class="row" style="padding: 20px;height: 420px">
        <div id="outer-categories-slider" class="col-md-12">
            <?php include_once "_dashsidebar.php"?>
            <div class="col-md-9">
                <div id="chartContainer" style="width: 600px; height: 300px"></div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "_footer.php";
?>
