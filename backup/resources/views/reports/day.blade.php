﻿@extends('layouts.app')
@section("content")
<script src="/js/Chart.bundle.js"></script>
<script>
    var year = ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
	var purchases = <?php echo $purchase; ?>;
    var sales = <?php echo $sale; ?>;

    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Purchases',
            backgroundColor: "rgb(255, 159, 25)",
            data: purchases
        }, {
            label: 'Sales',
            backgroundColor: "rgb(128, 0, 0)",
            data: sales
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Day Book'
                }
            }
        });

    };
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Day Book (Junuary / 2017)</div>
                <div class="canvas-chart">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section("scripts")
<!--Load JQuery-->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="/js/plugins/blockui-master/jquery.blockUI.js"></script>
<script src="/js/functions.js"></script>
<!--ChartJs-->
<script src="/js/plugins/chartjs/Chart.min.js"></script>
<script src="/js/plugins/chartjs/chartjs-script.js"></script>
@stop
