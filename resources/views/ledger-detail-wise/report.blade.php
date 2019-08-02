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
			<!-- <b></b> -->
	<div class="panel panel-default">
		<div class="panel-heading"><b>Ledger(Detail Wise)<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Party Code: {{$party[0]->id}} &nbsp;&nbsp;&nbsp;&nbsp;  Party Name: {{$party[0]->party_name}}</b></div>
	<div class="panel-body">
		
		<!--<a href="/purchase-report/print" class="btn btn-warning" role="button" style="float:right;">
		<i class="fa fa-print"></i><span class="bold">Print</span></a>-->
	<table class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>	
			  <th>V.No</th>
			  <th>Type</th>
			  <th>Date</th>
			  <th>Bank</th>
			  <th>Narration</th>
			  <th>Qty</th>
			  <th>Rate</th>
			  <th>Debit</th>
			  <th>Credit</th>
			  <th>Balance</th>
			</tr>
		</thead>
		 <tbody>
		 <?php $totalDebit = 0; $totalCredit = 0; $sum=0;?>
			 @if(count($items) > 0)
				@foreach($items as $item)
				<?php $sum = $sum + 1?>
				<tr>
					
					<td>{{$item->voucher_no}}</td>
					<td>
						@if ($item->voucher_type == "Cash Purchase")
						{{"PB"}}
						@endif
						@if ($item->voucher_type == "Sale Bill")
						{{"SB"}}
						@endif
						@if ($item->voucher_type == "SalesTax Invoice")
						{{"STV"}}
						@endif
						@if ($item->voucher_type == "Journal Voucher")
						{{"JV"}}
						@endif
						@if ($item->voucher_type == "Cash Receipt")
						{{"CR"}}
						@endif
						@if ($item->voucher_type == "Cash Payment")
						{{"CP"}}
						@endif
						@if ($item->voucher_type == "Bank Receipt")
						{{"BR"}}
						@endif
						@if ($item->voucher_type == "Bank Payment")
						{{"BP"}}
						@endif
						@if ($item->voucher_type == "GRN")
						{{"GR"}}
						@endif
						@if ($item->voucher_type == "Purchase Return")
						{{"PR"}}
						@endif
						@if ($item->voucher_type == "Credit Sale")
						{{"SB | CR"}}
						@endif
						@if ($item->voucher_type == "Cash Sale")
						{{"SB | CASH"}}
						@endif
						@if ($item->voucher_type == "Sale Return")
						{{"SR"}}
						@endif
						@if ($item->voucher_type == "Post Dated Cheque")
						{{"PDC"}}
						@endif

					</td>
					<td>{{ date("d/m/Y", strtotime($item->date)) }}</td>
					<td>@if($item->banks != null)
						{{ $item->banks->name }}
						@endif
					</td>
					<td>
						 @if(($item->products) !=null)
						{{$item->products->product_name}}  {{$item->other}}
						@endif
						@if(($item->products) ==null)
						{{$item->other}}
						@endif
					</td>
					<td>{{ $item->quantity}} </td>
					<td>{{ $item->rate}}</td>
					<td>{{ $item->debit}}</td>
					<td>{{ $item->credit}}</td>
					
					<?php $totalDebit = $totalDebit + $item->debit;
					if ($item->voucher_type != "Cash Sale"){
					$totalCredit = $totalCredit + $item->credit; 
					}?>
					<td>{{ $totalDebit-$totalCredit }}</td>
					
					</tr>
				@endforeach
				<tr>
				<td colspan="9"><center><b style="float:right;">Total</b></center></td>
				<td>{{$totalDebit-$totalCredit}}</td>
				</tr>
			 @else
				<tr><td colspan="10" style="color:#FF0000;text-align:center;">No Records found</td></tr>
			 @endif
		 </tbody>
	</table>
		</div>
	</div>
</section>
	</div>

		
	
		</body>
		</html>


