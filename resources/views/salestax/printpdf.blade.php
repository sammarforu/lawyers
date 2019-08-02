<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body style="margin-top: 100px;">
			</br></br></br></br></br></br></br>
			<b style="float:left; margin-left: 40%;"><strong>STRN: {{$company_detail[0]->city}}, NTN: {{$company_detail[0]->state}}</strong></b></br>
			<!-- <center><img src="\upload\logo\selestaxes.png"></img></center> -->
			<h2><center><b>SALESTAX&nbsp;INVOICE</b></center></h2>
			<table style="width:100%;">
   			<tr style="width:100%; margin-bottom: 100px;">
   				<td style="width:50%;"></td>
   				<td style="width:31%;"></td>
   				<td style="width:19%; float:right; margin-right: 10px;"><span>DATE: {{date("d/m/Y", Strtotime($newsale_detail[0]->date))}}</span></td>
   			</tr>
   			<tr style="width:100%; margin-bottom: 100px;">
   				<td style="width:50%;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUYER NAME:</strong><u>{{$newsale_detail[0]->parties->party_name}}</u></td>
   				<td style="width:31%;"></td>
   				<td style="width:19%; float:right; margin-right: 10px;"><span>INVOICE NO: {{$newsale_detail[0]->invoice_no}}</span></td>
   			</tr>
   			<tr style="width:100%; margin-top:-20%;">
   				<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADDRESS:</strong> <u>{{$newsale_detail[0]->parties->address}}, {{$newsale_detail[0]->parties->city}}.</u></td>
   			</tr>
   			<tr style="width:100%; margin-top:-20%;">
   				<td style="width:10%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NTN:</strong> <u>{{$newsale_detail[0]->parties->ntn}}</u></td>
   				<td style="width:10%;"><strong>STRN:</strong> <u>{{$newsale_detail[0]->parties->strn}}</u></td>
   				<td style="width:19%;"><span><strong>P ORDER#:</strong> {{$newsale_detail[0]->p_order}}</span></td>
   			</tr>
   		</table>
			</br>
	<table style="width:100%;">
		<tr style="background: grey;">
			<th style="border:2px solid; width:50px;"><center>Qty</center></th>
			<th style="border:2px solid; width:200px;"><center>Product&nbsp;Description</center></th>
			<th style="border:2px solid; width:50px;"><center>Rate</center></th>
			<th style="border:2px solid; width:100px;"><center>Value Exc.ST</center></th>
			<th style="border:2px solid; width:50px;"><center>S.T%</center></th>
			<th style="border:2px solid; width:100px;"><center>S.T Value</center></th>
			<th style="border:2px solid; width:100px;"><center>Value Inc.ST</center></th>
		</tr>
		<?php $sum = 1; $quantity = 0; $rate = 0; $ValueExcTax = 0; $STValue = 0; $amount = 0; ?>
			@foreach ($newsale_detail[0]->saletax_details as $details)
		<tr>
		    <td style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>{{$details->quantity}}</center></td>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center>{{$details->products->product_name}}</center></td>
			
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center>{{$details->rate}}</center></td>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center>
				<?php ?>
				{{$details->quantity*$details->rate}}</center></td>
				<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center>{{$details->stvalue}}</center></td>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center>{{(int)$details->taxvalue}}</center></td>
			
			<td style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center>{{(int)$details->total}}</center></td>
		</tr>
		<?php 
		
		$quantity = $quantity + $details->quantity;
		$rate = $rate + $details->price;
		$ValueExcTax = $ValueExcTax + $details->quantity*$details->rate;
		$STValue = $STValue + $details->taxvalue;
		$amount = $amount + $details->total;
		$sum = $sum + 1;
		?>
		@endforeach
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>
		<tr>
		    <th style="border-bottom:1px dashed; border-right:1px solid; border-left:2px solid; width:50px;"><center>-</center></th>
			<td style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:200px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:50px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:1px solid; border-left:1px solid; width:100px;"><center></center></th>
			<th style="border-bottom:1px dashed; border-right:2px solid; border-left:1px solid; width:100px;"><center></center></th>
		</tr>

		
		
		
		<tr style="background: grey;">
		    <th style="border:2px solid; width:50px;"><center>{{$quantity}}</center></th>
			<td style="border:2px solid; width:200px;"><center>Total</center></th>
			<th style="border:2px solid; width:50px;"><center>{{$rate}}</center></th>
			<th style="border:2px solid; width:100px;"><center>{{$ValueExcTax}}</center></th>
			<th style="border:2px solid; width:50px;"><center></center></th>
			<th style="border:2px solid; width:100px;"><center>{{$STValue}}</center></th>
			<th style="border:2px solid; width:100px;"><center>{{$amount}}</center></th>
		</tr>

		<!-- <tr style="height:30px; border:2px solid;">
			<td style="border:2px solid;" colspan="3">Remarks</td>
			<td style="" colspan="3">
			<p style="margin-top:10px; margin-left: 10px; margin-bottom:10px; ">Driver Name:</p> </br></hr> 
			<p style="margin-left: 10px;">Vehicle No:</p>
			</td>
		</tr></br> -->
		
	</table></br>
	<table style="margin-top: 20px;">
		 <tr>
			<td style="border:2px solid;float: right;
    margin-right: -130px; padding: 5px 20px;">Total Tax: {{$STValue}}</td>
			<td style="border:2px solid;     float: right;
    margin-right: -330px; padding: 5px 20px;">Total Amount: {{$amount}} </td>
		</tr>
	</table></br></br>
	 <p style="float:right; margin-right: 100px; margin-top: -33px;"><strong>Signature</strong></p>
	<!-- <p><center style="margin-top: -28px;"><strong>Approved By</strong></center></p> -->
</br></br></br>
	<!-- <p style="float:right; margin-top: -33px; margin-right: 50px;"><strong>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p></br> -->

	<!-- <p style="margin-left: 120px;"><strong>___________</strong></p> -->
	<!-- <p><center style="margin-top: -28px;"><strong>___________</strong></center></p> -->
 <p style="float:right; margin-right: -100px; margin-top: 50px;"><strong>_________________</strong></p></br>
	

			
	</body>
</html>
</br>
<!-- <b style="float:right; margin-right: 0px;">Developed by <u style="color:blue;">www.itlife.com.pk</u> | 0321 4197290</b> -->
