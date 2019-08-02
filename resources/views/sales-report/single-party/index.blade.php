<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body onload="window.print();">
  <div class="content-wrapper">
    <section class="content">
	@include("/header.report")			
	<div class="panel panel-default">
		<div class="panel-heading"><b>Sale Report Specific Party &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Party Code: {{$party[0]->id}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Party Name: {{$party[0]->party_name}}</b></div>
	<div class="panel-body">
		
		<!--<a href="/purchase-report/print" class="btn btn-warning" role="button" style="float:right;">
		<i class="fa fa-print"></i><span class="bold">Print</span></a>-->
	<table class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>	
			  <th>Date</th>
			  <th>Party</th>
			  <th>Product&nbsp;Name</th>
			  <th>Sale&nbsp;Price</th>
			  <th>Quantity</th>
			  <th>Total&nbsp;Sale</th>
			</tr>
		</thead>
		 <tbody>
		 <?php $SaleRate = 0; $quantity = 0; $SaleRatetotal = 0; ?>
		 
			 @if(count($sales) > 0)
				@foreach($sales as $sale)
				<tr>
					@foreach($sale->sale_details as $products)
					<td>{{ date("d/m/Y", strtotime($sale->date)) }}</td>
					<td>{{$sale->parties->party_name}}</td>
					<td>{{ $products->products->product_name }} ({{ $products->products->product_code }})</td>
					<td>{{ $products->sale_rate }}</td>
					<td>{{ $products->quantity }}</td>
					<td>{{ $products->sale_amount }}</td>
					<?php
					$SaleRate = $SaleRate + $products->sale_rate;
					$quantity = $quantity + $products->quantity;
					$SaleRatetotal = $SaleRatetotal + $products->sale_amount;
					?>
					</tr>
					@endforeach
						
				@endforeach
				<tr>
				<td colspan="3"><center><b>Total</b></center></td>
				<td>{{$SaleRate}}</td>
				<td>{{$quantity}}</td>
				<td>{{$SaleRatetotal}}</td>
				</tr>
			
			 @else
				<tr><td colspan="6" style="color:#FF0000;text-align:center;"><b>No Sales found</b></td></tr>
			 @endif
		 </tbody>
	</table>
		</div>
	</div>
	</section>
	</div>
</body>
</html>


