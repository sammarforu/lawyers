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
		<div class="panel-heading"><b>Trial Balance</b></div>
	<div class="panel-body">
		<table class="table table-bordered" >
			<thead>
				<tr>	
				  <th>Account Name</th>
				  <th>Debit</th>
				  <th>Credit</th>
				  
				</tr>
			</thead>
			 <tbody>
			 	<div class="col-sm-12">
			 <?php  $Debittotal = 0; $Credittotal=0; ?>
			 @if(isset($debit))
				 @if(count($debit) > 0)
					@foreach($debit as $debits)			
						<tr>
						<th colspan="3">{{$debits->name}}</th>	
						</tr>
						
						@foreach($debits->parties as $party)
						<tr>
							<td>{{$party->party_name}}</td>
							<?php $Debit = 0; $credit = 0; ?>
							@foreach($party->general_vouchers as $last)
								<?php $Debit = $Debit + $last->debit?>
								<?php $credit = $credit + $last->credit?>
								<?php $Debittotal = $Debittotal + $last->debit?>
								<?php $Credittotal = $Credittotal + $last->credit?>
							@endforeach
							<td>{{$Debit}}</td>
							<td>{{$credit}}</td>
						@endforeach
							
							
						</tr>
						<!-- <tr>
							<td>Total</td>
							<td>{{$Debittotal}}</td>
							<td>{{$Credittotal}}</td>
						</tr> -->
					@endforeach
					
					<tr style="color:blue;">
					<td><b>Total</b></td>
					<td><b>{{$Debittotal}}</b></td>
					<td><b>{{$Credittotal}}</b></td>
					</tr>

					 <tr style="color:red;">
					<td colspan="2"><b>Grand Total</b></td>
					<td><b>{{$Debittotal-$Credittotal}}</b></td>
					</tr>
				 @endif	
				 @else
					<tr><td colspan="7" style="color:#FF0000;text-align:center;">No Records found</td></tr>
				 @endif
				</div>
			 </tbody>
		</table>
		</div>
	</div>
</section>
</div>

</body>
	</html>


