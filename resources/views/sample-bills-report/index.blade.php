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
	<div class="panel-heading"><b>All Samples Report</b></div>
<div class="panel-body">
	
	<!--<a href="/purchase-report/print" class="btn btn-warning" role="button" style="float:right;">
	<i class="fa fa-print"></i><span class="bold">Print</span></a>-->
		<table class="table table-striped table-bordered table-hover dataTables-example" >
			<thead>
				<tr>	
					  <th>Date</th>
					  <th>Invoice&nbsp;No</th>
					  <th>Sales&nbsp;Man</th>
					  <th>Product&nbsp;Name</th>
					  <th>Product&nbsp;Price</th>
					  <th>Quantity</th>
					  <th>Sale&nbsp;Rate</th>
					  
					<!--   <th>Total&nbsp;Amount</th> -->
				</tr>
			</thead>
			 <tbody>
			 <?php $total_price = 0; $sprice = 0; $quantity = 0; $total = 0; ?>
			 @if(isset($sales))
				 @if(count($sales) > 0)
					@foreach($sales as $sale)
						<!--<tr><td colspan="5">Purchase Date: {{ $sale->date }}</td></tr>
						<tr><td colspan="5">Supplier: {{ $sale->parties->party_name }}</td></tr>-->												
						<tr>
							@foreach($sale->sale_details as $products)
							<td>{{ date("d/m/Y", strtotime($sale->date)) }}</td>
							<td>{{$sale->invoice_no}}</td>
							<td>{{$sale->parties->party_name}}</td>
							<td>{{ $products->products->product_name }} ({{ $products->products->product_code }})</td>
							
							<td>{{ $products->sale_rate }}</td>
							<td>{{ $products->quantity }}</td>
							<td>{{ $products->sale_amount }}</td>

							
							
							<?php
							$total_price = $total_price + $products->sale_rate;
							// $sprice = $sprice + $products->products->product_price;
							$quantity = $quantity + $products->quantity;
							$total = $total + $products->sale_amount;
							?>
							
							</tr>
							@endforeach
							
					@endforeach
					<tr>
					<td colspan="4"><center><b>Total</b></center></td>
					
					<td>{{$total_price}}</td>
					<td>{{$quantity}}</td>
					<td>{{$total}}</td>
					</tr>
				 @endif	
				 @else
					<tr><td colspan="7" style="color:#FF0000;text-align:center;">No purchases found</td></tr>
				 @endif
			 </tbody>
		</table>
	</div>
</div>
</section>
</div>
</body>
</html>


