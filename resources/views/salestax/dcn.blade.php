<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body onload="window.print();">
	<!-- <body onload="window.print();"> -->
	<!-- <body> -->
			<!-- <span style="float: right;margin-top: -19px;">
				<?php $t=time(); ($t . "<br>"); echo(date("d-m-Y",$t)); ?>
			</span> -->

			<!-- <center><h1><b>{{$company_detail[0]->system_name}}</b></h1></center>
			<center><b><strong>{{$company_detail[0]->address}}</strong></b></br></center> -->
			</br></br></br></br></br></br></br>
			<b style="float:left; margin-left: 40%;"><strong>STRN: {{$company_detail[0]->city}}, NTN: {{$company_detail[0]->state}}</strong></b></br>
			<center><h3><u><strong>DELIVERY CHALLAN</strong></u></h3></center>
			<!-- <center><h3><strong style="border-top-style: dotted;
  border-right-style: solid;
  border-bottom-style: dotted;
  border-left-style: solid; border-radius: 5px;">Sales Tax Invoice</strong></h3></center> -->
  <h4><b><span style="float:right;">DATE: {{date("d/m/Y", Strtotime($newsale_detail[0]->date))}}</span></b></h4></br>
			<h4><b><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUYER NAME:<u>{{$newsale_detail[0]->parties->party_name}}</u></strong><span style="float:right; margin-right:3%;">DC NO: {{$newsale_detail[0]->dcn_no}}</span></b></h4>

			<h4><b><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADDRESS: <u>{{$newsale_detail[0]->parties->address}}, {{$newsale_detail[0]->parties->city}}.</u></strong></b></h4>
			<h4><b><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NTN: <u><b>{{$newsale_detail[0]->parties->ntn}}</b></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STRN: <u><b>{{$newsale_detail[0]->parties->strn}}</b></u></strong></h4>
			
	<!-- <div class="row">
		<div class="col-sm-3">
		<img src="\upload\logo\{{$logo[0]->image}}" style="width: 160px;height: 60px;border-radius: 5px;border-image: solid 2px;" />
		</div>
	<div class="col-sm-6" style="margin-top: -80px;">
		<center><h3><b>{{$company_detail[0]->system_name}}</b></h3>
		<b>{{$company_detail[0]->address}}</b></br>
		<b>GST No.{{$company_detail[0]->city}}, NTN No.{{$company_detail[0]->state}}</b></center>
	</div>
	</div>
	<center><h3><u><strong>Sales Tax Invoice</strong></u></h3></center> -->
<!-- 	<table style="border:2px solid;">
		<tr style="margin-top:30px;">
			<td style="border:1px solid; width: 500px;"><span style="margin-bottom: -20px; padding:20px;">Buyer Name: <b>{{$newsale_detail[0]->parties->party_name}}</b></span></br>
			</td>
			<td style="border:1px solid; width: 250px;"><center style="margin-bottom: -20px;">Invoice No: <b>{{$newsale_detail[0]->invoice_no}}</b></center></br>
			</td>
		</tr>
		<tr style="margin-top:30px;">
			<td style="border:1px solid; width: 500px;"><span style="margin-bottom: -20px; padding:20px;">Address: <b>{{$newsale_detail[0]->parties->address}}</b></span></br>
			</td>
			<td style="border:1px solid; width: 250px;"><center style="margin-bottom: -20px;">Date: <b>{{date("d/m/Y", strtotime($newsale_detail[0]->date))}}</b></center></br>
			</td>
		</tr>

		<tr style="margin-top:30px;">
			<td style="border:1px solid; width: 500px;"><span style="margin-bottom: -20px; padding:20px;">GST: <b>{{$newsale_detail[0]->parties->strn}} | NTN: <b>{{$newsale_detail[0]->parties->ntn}}</b></b></span></br>
			</td>
			<td style="border:1px solid; width: 250px;"><center style="margin-bottom: -20px;">Del Challan: <b>{{$newsale_detail[0]->dcn_no}}</b></center></br>
			</td>
			<td style="border:1px solid; width: 250px;"><center style="margin-bottom: -20px;">Del Date: <b>{{$newsale_detail[0]->invoice_no}}</b></center></br>
			</td>
		</tr>
		<tr style="margin-top:30px;">
			<td style="border:1px solid; width: 500px;"><span style="margin-bottom: -20px; padding:20px;">Phone No: <b>{{$newsale_detail[0]->parties->phone}}</b></span></br>
			</td>
			<td style="border:1px solid; width: 250px;"><center style="margin-bottom: -20px;">Pur Order: <b>{{$newsale_detail[0]->p_order}}</b></center></br>
			</td>
		</tr>
		<tr style="height:60px;"><td style="border:2px solid;" colspan="2"><b><u>TO M/S: {{$newsale_detail[0]->parties->party_name}} ({{$newsale_detail[0]->parties->phone}})</u><b></td></tr>
	</table> --></br>
	<table>
		<tr style="background: grey;">
			<th style="border:2px solid; width:20%;"><center>Sr.#</center></th>
			<th style="border:2px solid; width:70%;"><center>Product&nbsp;Description</center></th>
			<th style="border:2px solid; width:20%;"><center>Qty</center></th>
			<!-- <th style="border:2px solid; width:20px;"><center>Rate</center></th>
			<th style="border:2px solid; width:150px;"><center>Value Exc.Sales Tax</center></th>
			<th style="border:2px solid; width:7%;"><center>S.T%</center></th>
			<th style="border:2px solid; width:100px;"><center>S.T Value</center></th>
			<th style="border:2px solid; width:200px;"><center>Value Inc.ST & Rate</center></th> -->
		</tr>
				<?php $sum = 1; $quantity = 0; $rate = 0; $ValueExcTax = 0; $STValue = 0; $amount = 0; ?>
			@foreach ($newsale_detail[0]->saletax_details as $details)
		<tr style="">
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>{{$sum}}</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>{{$details->products->product_name}}</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center>{{$details->quantity}}</center></td>
<!-- 			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center>{{$details->rate}}</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:100px;"><center>
				<?php ?>
				{{$details->quantity*$details->rate}}</center></td>
				<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:100px;"><center>{{$details->stvalue}}</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:100px;"><center>{{(int)$details->taxvalue}}</center></td>
			
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:100px;"><center>{{(int)$details->total}}</center></td> -->
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
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
			
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center>-</center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:20px;"><center></center></td>
			<td style="border-bottom:1px solid; border-right:2px solid; border-left:2px solid; width:50px;"><center></center></td>
		</tr>
		<tr style="background: grey;">
			<td style="border:2px solid; width:50px;" colspan="2"><center>
			  Total</center></td>

			<!-- <th style="border:2px solid; width:100px;"><center></center></th> -->
			<th style="border:2px solid; width:100px;"><center>{{$quantity}}</center></th>		</tr>

		<!-- <tr style="height:30px; border:2px sold;">
			<td style="border:2px solid;" colspan="3">Remarks</td>
			<td style="" colspan="3">
			<p style="margin-top:10px; margin-left: 10px; margin-bottom:10px; ">Driver Name:</p> </br></hr> 
			<p style="margin-left: 10px;">Vehicle No:</p>
			</td>
		</tr></br> -->
		
	</table></br>	<table>
		<!-- <tr>
			<td style="border:2px solid;     float: right;
    margin-right: -530px; padding: 5px 20px;">Total Tax: {{$STValue}}</td>
			<td style="border:2px solid;     float: right;
    margin-right: -730px; padding: 5px 20px;">Total Amount: {{$amount}} </td>
		</tr> -->
	</table></br></br>
	 <p style="margin-left: 10%;"><strong></strong></p>
	  <p style="margin-top: -28px; margin-left: 30%;"><strong>ISSUED By</strong></p>
	  <p style="margin-top: -28px; margin-left: 60%;"><strong>RECIEVED By</strong></p>
<!--
	<p style="float:right; margin-top: -33px; margin-right: 120px;"><strong>RECEIVED BY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p> --></br>

	<p style="margin-left: 10%;"><strong></strong></p>
	 <p style="margin-top: -28px; margin-left: 30%;"><strong>___________</strong></p>
	 <p style="margin-top: -28px; margin-left: 60%;"><strong>___________</strong></p>
	<!--<p style="float:right; margin-top: -33px; margin-right: 120px;"><strong>_________________</strong></p> --></br>
	

			
	</body>
</br><!-- <b style="float:right; margin-right: 0px;">Develed by <u style="color:blue;">www.itlife.com.pk</u> | 0321 4197290<
