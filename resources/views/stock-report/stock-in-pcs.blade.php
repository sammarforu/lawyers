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
	<div class="panel-heading"><b>All Products Stock</b></div>
	<div class="panel-body">
	<table class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>
				<th>Serial#</th>
				<th>Product&nbsp;Code</th>
				<th>Product&nbsp;Name</th>
				<th>Product&nbsp;Cost</th>
				<th>Stock&nbsp;Cost</th>
				<th>C.Stock</th>  
			</tr>
		</thead>
		<tbody>
			  <?php $sum = 1; $count=1;?>
			   @foreach($product as $catagories)
			 	 <tr>
					<td colspan="4" style="color:green;"><b>CATAGORY NAME:</b> <span style="color:blue;">{{$catagories->catagory_name}}</span><!---&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:green;">TOTAL :</b> <span style="color:blue;">{{$count}}</span></td> -->

				</tr>
			  @foreach($catagories->products as $items)

			  <?php $quantity_purchase = 0; $quantity_sale = 0; $challan = 0; $SReturn = 0; $PReturn = 0; $totalStock=0; $totalcost=0;?>
					@foreach($items->products_detail as $detail)
					<?php $quantity_purchase = $quantity_purchase + $detail->quantity; ?>
					@endforeach
					@foreach($items->sale_detail as $detail)
					<?php $quantity_sale = $quantity_sale + $detail->quantity; ?>
					@endforeach
					@foreach($items->challan_detail as $Challandetail)
					<?php $challan = $challan + $Challandetail->quantity; ?>
					@endforeach
					@foreach($items->sale_return_detail as $SaleReturndetail)
					<?php $SReturn = $SReturn + $SaleReturndetail->quantity; ?>
					@endforeach
					@foreach($items->purchase_return_detail as $PurReturndetail)
					<?php $PReturn = $PReturn + $PurReturndetail->quantity; ?>
					@endforeach
					<?php $totalStock = $quantity_purchase - $quantity_sale - $challan + $SReturn - $PReturn;?>
					@if($totalStock !='0')
					
				
				<tr>

					<td><?php echo $sum; ?></td>
					<td class="center">{{$items->product_code}}</td>
					<td class="center">{{$items->product_name}}</td>
					<td class="center">{{$items->product_cost}}</td>
					<?php $totalcost = $items->product_cost*$totalStock ?>
					<td class="center">{{$totalcost}}</td>
					<td class="center">{{$totalStock}}</td>
				</tr>
				@endif
				<?php $sum = $sum + 1;?>
				<!-- <?php $count = $count+1;?> -->
			  @endforeach
			  @endforeach
			  </tbody>
				<tfoot>
					<tr>
					  <th>Serial#</th>
					  <th>Product&nbsp;Code</th>
					  <th>Product&nbsp;Name</th>
					  <th>Product&nbsp;Cost</th>
					  <th>Stock&nbsp;Cost</th>
					 <th>C.Stock</th>  
					</tr>
				</tfoot>
		</table>
		</div>
	</div>
	</section>
	</div>
</body>
</html>


