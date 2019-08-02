@extends('layouts.app')
@section('content')
<script src="/js/Chart.bundle.js"></script>
<script>
    var year = ['2017','2018','2019', '2020'];
	var purchases = <?php echo $purchase; ?>;
    var sales = <?php echo $sale; ?>;

    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Purchases',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: purchases
        }, {
            label: 'Sales',
            backgroundColor: "rgba(151,187,205,0.5)",
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
                    text: 'Yearly Sale/Purchase'
                }
            }
        });

    };
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase / Sale Report</div>
                <div class="canvas-chart">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@stop