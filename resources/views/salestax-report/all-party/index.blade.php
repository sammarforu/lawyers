<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="/css/bg.css" rel="stylesheet">
</head>
<body onload="window.print();">
	<div class="content-wrapper">
	<section class="content">
	@include("/header.report")	
	<div class="panel panel-default" style="border:2px solid;">
		<div class="panel-heading"><b id="voucherName">All Parties SaleTax Report</b></div>
	<div class="panel-body" style="border-top:2px solid;">
	<!-- <table class="table table-striped table-bordered table-hover dataTables-example" > -->
	<table class="table-bordered">
		<thead>
			<tr>	
			  <th id="tableth" style="width:10%;">Date</th>
			  <th id="tableth" style="width:5%;">Ivn#</th>
			  <th id="tableth" style="width:30%;">Party&nbsp;Name</th>
			  <th id="tableth" style="width:30%;">Product&nbsp;Name</th>
			  <!-- <th>Purchase&nbsp;Price</th> -->
			  <th id="tableth" style="width:10%;">Rate</th>
			  <th id="tableth" style="width:5%;">Qty</th>
			  <th id="tableth" style="width:10%;">Exc.ST</th>
			  <th id="tableth" style="width:10%;">ST%</th>
			  <th id="tableth" style="width:10%;">ST.Val</th>
			  <th id="tableth" style="width:10%;">Total</th>
			</tr>
		</thead>
		 <tbody>
		 <?php $rate = 0; $quantity = 0; $ValExcST=0; $STValue=0; $total = 0; ?>
		 @if(isset($sales))
			 @if(count($sales) > 0)
				@foreach($sales as $sale)											
					@foreach($sale->saletax_details as $products)
					<tr id="datafont">
						<td id="tabledata">{{ date("d/m/Y", strtotime($sale->date)) }}</td>
						<td id="tabledata">{{ $sale->invoice_no}}</td>
						<td id="tabledata">{{$sale->parties->party_name}}</td>
						<td id="tabledata">{{ $products->products->product_name }}</td>
						<!-- <td>{{ $products->products->product_cost }}</td> -->
						<td id="tabledata">{{ $products->rate }}</td>
						<td id="tabledata">{{ $products->quantity }}</td>
						<td id="tabledata">{{ (int)$products->price }}</td>
						<td id="tabledata">{{ (int)$products->stvalue }}</td>
						<td id="tabledata">{{ (int)$products->taxvalue }}</td>
						<td id="tabledata">{{ (int)$products->total }}</td>
					<?php
					//$pprice = $pprice + $products->products->product_cost;
					$rate = $rate + $products->rate;
					$quantity = $quantity + $products->quantity;
					$ValExcST = $ValExcST + $products->price;
					$STValue = $STValue + $products->taxvalue;
					$total = $total + $products->total;
					?>
					</tr>
					@endforeach
						
				@endforeach
				<tr id="datafont">
					<td colspan="4" id="tableth"><center><b>Total</b></center></td>
					<td id="tableth">{{(int)$rate}}</td>
					<td id="tableth">{{$quantity}}</td>
					<td id="tableth">{{(int)$ValExcST}}</td>
					<td id="tableth"></td>
					<td id="tableth">{{(int)$STValue}}</td>
					<td id="tableth">{{(int)$total}}</td>
				</tr>
			 @endif	
			 @else
				<tr><td colspan="7" style="color:#FF0000;text-align:center;">No Sales found</td></tr>
			 @endif
		 </tbody>
	</table>
	</div>
	</div>
</section>
	</div>

	

</body>
</html>


