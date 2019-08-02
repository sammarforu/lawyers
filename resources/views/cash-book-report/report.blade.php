<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body onload="window.print();">
	<body>
		<div class="content-wrapper">
        <section class="content">
		@include("/header.report")
			
	<div class="panel panel-default">
		<div class="panel-heading"><b>Cash Book Report</b></div>
	<div class="panel-body">
		
		<!--<a href="/purchase-report/print" class="btn btn-warning" role="button" style="float:right;">
		<i class="fa fa-print"></i><span class="bold">Print</span></a>-->
	<table class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>	
			  <th>Date</th>
			  <th>Voucher&nbsp;No</th>
			  <th>Voucher&nbsp;Type</th>
			  <th>Party&nbsp;Name</th>
			  <!-- <th>Amount</th> -->
			  <th>In</th>
			  <th>Out</th>
			  <th>Balance</th>
			</tr>
		</thead>
		 <tbody>
		 <?php $totalDebit = 0; $totalCredit = 0;?>
		 @if(isset($Payment))
			 @if(count($Payment) > 0)
				@foreach($Payment as $Payments)
				@if($Payments->v_type!= "Credit Sale" && $Payments->v_type!= "Bank Payment" && $Payments->v_type!= "Bank Receipt" && $Payments->v_type!= "Journal Voucher" && $Payments->party_name!= "CASH IN HAND")
				<tr>
					<td>{{ date("d/m/Y", strtotime($Payments->date)) }}</td>
					<td>{{$Payments->voucher_no}}</td>
					<td>{{$Payments->v_type}}</td>
					<td>{{$Payments->party_name}}</td>

					@if($Payments->v_type=="Cash Payment" || $Payments->v_type=="Bank Payment")
					<td></td>
					<td>{{$Payments->debit}}</td>
					<?php $totalDebit = $totalDebit + (int)$Payments->debit; ?>
					@endif

					@if($Payments->v_type=="Cash Receipt" || $Payments->v_type=="Bank Receipt" || $Payments->v_type=="Cash Sale")
					<td>{{$Payments->credit}}</td>
					<td></td>
					<?php $totalCredit = $totalCredit + (int)$Payments->credit; ?>
					@endif
					<!-- <td>{{$Payments->credit}}</td> -->
					
					<td>{{$totalCredit-$totalDebit}}</td>
					</tr>
					@endif
				@endforeach
				<tr>
				<td colspan="4"><center><b style="float:right;">Total</b></center></td>
				<!-- <td>{{$totalDebit}}</td> -->
				<td>{{(int)$totalCredit}}</td>
				<td>{{(int)$totalDebit}}</td>
				<td>{{(int)$totalCredit-$totalDebit}}</td>
				</tr>
			 @endif	
			 @else
				<tr><td colspan="7" style="color:#FF0000;text-align:center;">No Records found</td></tr>
			 @endif
		 </tbody>
	</table>
		</div>
	</div>
</section>
	</div>

		
	
		</body>
		</html>


