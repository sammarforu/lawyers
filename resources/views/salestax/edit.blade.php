@extends("app")
@section("contents")
<!-- <body onload="AddRowFunction()"> -->
<body>
<div class="container-fluid">
	@if (Session::has('flash_message'))
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
		<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
	@endif
</div>
<!-- <h1 class="page-title">Add Sale</h1>
<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
	<li><a href="/sales">Sales</a></li> 
	<li class="active"><strong>Add Sale</strong></li> 
</ol> -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h2 class="panel-title"><b>Sales Tax Invoice</b></h2>
				<ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul>
			</div>
		<div class="panel-body">
			<input id="token" type="hidden" value="{{$encrypted_token}}">
			@include('errors.validation')
			{!! Form::open(['url' => 'sales', 'class' => 'form-horizontal' ]) !!}
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
						<label class="col-sm-1 control-label">Date</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								<!-- <input id="date" type="date" name="date" value="<?php echo date('Y-m-d');?>" class="form-control"> -->  
								{!! Form::date('date', $edit->date, ['id' => 'date', 'placeholder' => 'Description','class'=>'form-control']) !!}
								<!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> --> 
							</div>
						</div>
						<label class="col-sm-1 control-label">Sale&nbsp;Type</label>  
						<div class="col-sm-2"> 
							<select class="form-control" onchange="LedgerValues();" id="sale_type" name="sale_type">
								<option value="SalesTax Invoice">SalesTax Invoice</option>
								<!-- <option value="Credit Sale">Credit Sale</option> -->
							</select>
						</div> 							
					</div>
				</div>
				<div class="row" id="ledgerRow" style="display:none;">
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Due&nbsp;Date</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								<input id="due_date" type="date" name="due_date" class="form-control"> 
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							</div>
						</div>
					
						<label class="col-sm-1 control-label"></label>  
						<div class="col-sm-2">
							{!! Form::text('particulars', null, ['id' => 'particulars', 'placeholder' => 'Description','class'=>'form-control']) !!}
						</div> 							
					</div>
				</div>
				<div class="row">
				<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-1 control-label">Invoice&nbsp;No#</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								{!! Form::text('invoice_no', $edit->invoice_no, ['id' => 'invoice_no','class'=>'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!} 
							</div>
						</div>
						<label class="col-sm-1 control-label">DC&nbsp;No</label>  
						<div class="col-sm-2"> 
							<!-- <select class="form-control" onchange="LedgerValues();" id="localExport" name="localExport">
								<option value="Local">Local</option>
								<option value="Export">Export</option>
							</select> -->
							{!! Form::select('dcn_no', $DeliveryChallan,  $edit->dcn_no, ['id' => 'dcn_no', 'onchange' => 'DCMouseUp($(this).val());', 'class'=>'form-control livesearch']) !!}
						</div>  
						<label class="col-sm-1 control-label">P&nbsp;Order</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								{!! Form::text('p_order', $edit->p_order, ['id' => 'p_order','class'=>'form-control', 'required' => 'required']) !!} 
							</div>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-1 control-label">Biller</label>  
					<div class="col-sm-5"> 
					  <select name="biller" id="biller" class="form-control" disabled>
						<option value="{{ Auth::user()->id }}">{{ Auth::user()->name}}</option>
					  </select>
					</div> 
				</div>
			</div>
			<div class="row">
				<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
					<label class="col-sm-1 control-label">Select&nbsp;Party</label> 
						{!! Form::hidden('party_id', $edit->party_id, ['id' => 'party_id', 'class'=>'form-control']) !!} 
					<div class="col-sm-2"> 
						<div id="year-view" class="input-group date"> 
							{!! Form::select('party_name', $customers, $edit->party_id, ['id' => 'party_name',  'onchange' => 'javascript:PartyKeyUp($(this).val());','class'=>'form-control', 'required' => 'required', 'placeholder' => 'Start Typing......']) !!} 

						</div>
					</div> 
					<div class="col-sm-4"> 	
						{!! Form::text('address', null, ['id' => 'address','class'=>'form-control', 'placeholder' => 'Address', 'disabled' => 'disabled']) !!} 
					</div>
					<div class="col-sm-2"> 
						{!! Form::text('ntn', null, ['id' => 'ntn','class'=>'form-control', 'placeholder' => 'NTN', 'disabled' => 'disabled']) !!} 
					</div>
				</div>
			</div>	
 <div class="panel panel-default">
	<div class="panel-body">	
	<div class="form-group">
		<table  id="myTable">
			<div class="container-fluid">
					<div class="row">
					<tr> 
					

		{!! Form::hidden('product_id', null, ['id' => 'product_id','class'=>'form-control']) !!}

<div class="col-md-1"> 
	<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
		<label for="H.S" class="control-label">H.S Code</label>
		{!! Form::text('product_code', null, ['id' => 'product_code', 'class'=>'form-control']) !!}
	</div>
</div> 
<div class="col-md-2"> 
	<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
		<label for="Name" class="control-label">Product Name</label> 
		{!! Form::select('product_name', $products, null, ['id' => 'product_name',  'onchange' => 'ProductKeyUp($(this).val().split("_").pop(), $(this).val().split("_")[0]);','class'=>'form-control livesearch']) !!}
	</div> 
</div>
<!-- <div class="col-sm-1" style="display:none;"> 
	<div class="form-group" style="margin-right: 1%;"> 
		<label for="password" class="control-label">P.T</label> 
		{!! Form::text('packing_type', null, ['id' => 'packing_type','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div> --> 
<!-- <div class="col-md-2"> 
	<div class="form-group"> 
		<label for="password" class="control-label">U.O.M</label> 
		{!! Form::text('uom', null, ['id' => 'uom','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div>  -->
<div class="col-md-1"> 
	<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
		<label for="Name" class="control-label">Unit</label> 
		{!! Form::select('uom_id', $uoms, null, ['id' => 'uom_id', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1%;margin-left: 1%;"> 
		<label for="password" class="control-label">Quantity</label> 
		{!! Form::text('quantity', 1, ['id' => 'quantity', 'onkeyup' => 'QuantityKeyUp($(this).val())', 'class'=>'form-control']) !!}
	</div> 
</div>

<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1%;width: 100%;margin-left: 1%;"> 
		<label for="password" class="control-label">Price</label> 
		{!! Form::text('price_per_unit', null, ['id' => 'price_per_unit', 'onkeyup' => 'SaleRateKeyUpForm($(this).val())','class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1%;width: 100%;margin-left: 1%;"> 
		<label for="password" class="control-label">S.T%</label> 
		{!! Form::text('stvalue', null, ['id' => 'stvalue','class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1%;width: 100%;margin-left: 1%;"> 
		<label for="password" class="control-label">Tax Value</label> 
		{!! Form::text('taxvalue', null, ['id' => 'taxvalue','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1px; margin-left: 1px;"> 
		<label for="password" class="control-label">Extra%</label> 
		{!! Form::text('extratax', null, ['id' => 'extratax', 'onkeyup' => 'ExtraTaxkeyup($(this).val());','class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1px; margin-left: 1px;"> 
		<label for="password" class="control-label">ExtraVal</label> 
		{!! Form::text('extraTaxValue', null, ['id' => 'extraTaxValue', 'onkeyup' => 'AddGridData()', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1px; margin-left: 1px;"> 
		<label for="password" class="control-label">Val ExTax</label> 
		{!! Form::text('ValueExTax', null, ['id' => 'ValueExTax','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1px; margin-left: 1px;"> 
		<label for="password" class="control-label">IncTax</label> 
		{!! Form::text('amount', null, ['id' => 'amount','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div>
<!-- <div class="col-md-1"> 
	<div class="form-group" style="margin-right: 1px; margin-left: 1px;"> 
		<label for="password" class="control-label">Balance</label> 
		{!! Form::text('balance', null, ['id' => 'balance','class'=>'form-control', 'disabled' => 'disabled']) !!}
	</div> 
</div> -->
</tr>
<table id="myData">
<?php $totalPrice = 0; $totalTax = 0; $totalExTax = 0; $totalIncTax = 0; ?>
		@foreach($edit->saletax_details as $saleDetail) 
		<tr>
		<td style="display:none;">
			<input id="test" value="{{$saleDetail->product_id}}" type="text" class="form-control" disabled>
		</td>
		<td style="padding-top:20px;">
			<input id="test" value="{{$saleDetail->products->product_code}}" type="text" class="form-control"style="margin-left: 14%; width: 65%;" disabled>
		</td> 
		<td style="padding-top:20px;">
			<input id="test" value="{{$saleDetail->products->product_name}}" type="text" class="form-control" style="margin-left: 7%; width: 153%;" disabled>
		</td>
		<td style="display:none;">
			<input id="test" value="{{$saleDetail->uoms->id}}" type="text" class="form-control" style="margin-left: -25%;
	    	width: 120%;" disabled>
		</td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->uoms->uom}}" type="text" class="form-control" style="margin-left: 88%; width: 65%;;" disabled>
		</td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->quantity}}" type="text" class="form-control" style="margin-left: 80%;width: 65%;" disabled>
	    </td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->rate}}" type="text" class="form-control" style="margin-left:72%; width: 65%;" disabled>
	    </td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->stvalue}}" type="text" class="form-control" style="margin-left:64%; width: 65%;" disabled>
	    </td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->taxvalue}}" type="text" class="form-control" style="margin-left:56%; width: 65%;" disabled>
		</td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->extratax}}" type="text" class="form-control" style="margin-left:47%; width: 65%;" disabled>
	    </td>
	    <td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->extraTaxValue}}" type="text" class="form-control" style="margin-left:39%; width: 65%;" disabled>
		</td>
		<td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->price}}" type="text" class="form-control" style="margin-left:29%; width: 65%;" disabled>
		</td>
		<td style="padding-top:20px;">
	    	<input id="test" value="{{$saleDetail->total}}" type="text" class="form-control" style="margin-left:21%; width: 65%;" disabled>
		</td>
		<td style="display: none;">
	    	<input id="test" value="{{$saleDetail->other}}" type="text" class="form-control" style="margin-left:21%; width: 65%;" disabled>
		</td>
	    <!-- <td style="padding-top:20px;"><button class="btn btn-red" type="button"> <i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-trash" title="Delete Row"></i></button></td> -->
	    <?php $totalPrice = $totalPrice + $saleDetail->rate; ?>
	    <?php $totalTax = $totalTax + $saleDetail->taxvalue; ?>
	    <?php $totalExTax = $totalExTax + $saleDetail->price; ?>
	    <?php $totalIncTax = $totalIncTax + $saleDetail->total; ?>
		</tr> 
		@endforeach
</table>
</div>
<div class="row">
<tr> 
<div class="col-md-3"> 
	<div class="form-group"> 
		
	</div> 
</div>


</tr>
</div>
</div>
		</table></br></br>
	</div>
	</div>
</div>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="container">
						  <div class="col-xs-3" style=""><b>Total Price</b> <input type="text" id="TotalRate" name="TotalRate" value="{{$totalPrice}}" disabled	>  </div>
						  <div class="col-xs-3" style=""><b>Total Tax</b> <input type="text" id="TotalRate" name="TotalRate" value="{{$totalTax}}" disabled>  </div>
						  <div class="col-xs-3" style=""> <b>Value Ex.Tax</b> <input type="text" id="TotalRate" name="TotalRate" value="{{$totalExTax}}" disabled> </div>
						  <div class="col-xs-3" style="background-color:lavenderblush;"> <b>Value Inc.Tax</b> <input type="text" id="TotalAmount" name="TotalAmount" value="{{$totalIncTax}}" disabled> </div>
						</div> 
					</div>
					<!-- <div class="panel-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead> 
									<tr> 
										<th>Dlt</th>  
										<th>Product&nbsp;ID</th>  
										<th>Code</th>  
										<th>Product&nbsp;Name</th> 
										<th>Cost</th> 
										<th>Quantity</th>
										<th>Cost&nbsp;Amount</th>
										
										<th>Sale&nbsp;Rate</th> 
										<th>Sale&nbsp;Amount</th>  
									</tr> 
								</thead> 
								<tbody id="GridTable"> 
									<div class="row">
									</div> 
								</tbody> 
							</table>
						</div>
					</div> -->
				</div>
			</div>
		</div>
			<center><div class="form-actions">
			  <button type="button" class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
			</div></center>		
			<!-- <div class="col-lg-3">
				 <button type="button" onclick="AddRowFunction()" class="btn btn-success"><i class="fa fa-plus"></i> </button>
				<button type="button" onclick="AddGridData()" class="btn btn-success"><i class="fa fa-plus"></i> </button>
				<button type="button" onclick="TotalRecords()" class="btn btn-success">Total Records</button>
			</div> -->			
			{!! Form::close() !!}		
		</div>
	</div>
</div>
</div>
</body>
@stop
@section("scripts")
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script src="/js/plugins/nouislider/nouislider.min.js"></script>
<!-- Input Mask-->
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Select2-->
<script src="/js/plugins/select2/select2.full.min.js"></script>
<!--Bootstrap ColorPicker-->
<script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!--Bootstrap DatePicker-->
<script src="/js/plugins/datepicker/bootstrap-datepicker.js"></script>


<script type="text/javascript">

	function AddGridData(){
		var date = document.getElementById('date').value;
		var InvoiceNo = document.getElementById('invoice_no').value;
		var ProductId = document.getElementById('product_id').value;
		var ProductCode = document.getElementById('product_code').value;
		var ProductID = document.getElementById('product_name').value.split("_")[0];
		var ProductName = document.getElementById('product_name').value.split("_").pop();
		var UOM = document.getElementById('uom_id').value.split("_").pop();
		var UOMID = document.getElementById('uom_id').value.split("_")[0];
		var Quantity = document.getElementById('quantity').value;
		var Price = document.getElementById('price_per_unit').value;
		var STValue = document.getElementById('stvalue').value;
		var TaxValue = document.getElementById('taxvalue').value;
		var ExtraTax = document.getElementById('extratax').value;
		var ExtraTaxValue = document.getElementById('extraTaxValue').value;
		var ValueExTax = document.getElementById('ValueExTax').value;
		var Amount = document.getElementById('amount').value;
		var TotalTax = parseInt(TaxValue) + parseInt(ExtraTaxValue);
		var tableHtml = '<tr>';
		// tableHtml += '<td class="text-center"><i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-cancel icon-larger red-color" title="Delete Row"></i> </td>';
		//tableHtml += '<td>'+ ProductId +'</td>';
		//0
		tableHtml += `<td style="display:none;"><input id="test" value="${ProductId}" type="text" class="form-control" disabled></td>`;
		//tableHtml += '<td>'+ ProductCode +'</td>';
		//1
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ProductCode}" type="text" class="form-control" style="margin-left: 14%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ ProductName +'</td>';
		//2
		// tableHtml += `<td style="display:none;"><input id="test" value="${ProductID}" type="text" class="form-control" disabled></td>`;
		//3
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ProductName}" type="text" class="form-control" style="margin-left: 7%; width: 153%;" disabled></td>`;
		//tableHtml += '<td>'+ PackingType +'</td>';
		//tableHtml += '<td>'+ UOM +'</td>';
		//4
		tableHtml += `<td style="display:none;"><input id="test" value="${UOMID}" type="text" class="form-control" disabled></td>`;
		//5
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${UOM}" type="text" class="form-control" style="margin-left: 88%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ Quantity +'</td>';
		//6
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${Quantity}" type="text" class="form-control" style="    margin-left: 80%;width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ Price +'</td>';
		//7
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${Price}" type="text" class="form-control" style="margin-left:72%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ STValue +'</td>';
		//8
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${STValue}" type="text" class="form-control" style="margin-left:64%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ TaxValue +'</td>';
		//9
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${TaxValue}" type="text" class="form-control" style="margin-left:56%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ ExtraTax +'</td>';
		//10
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ExtraTax}" type="text" class="form-control" style="margin-left:47%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ ExtraTaxValue +'</td>';
		//11
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ExtraTaxValue}" type="text" class="form-control" style="margin-left:39%; width: 65%;" disabled></td>`;
		//12
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ValueExTax}" type="text" class="form-control" style="margin-left:29%; width: 65%;" disabled></td>`;
		//tableHtml += '<td>'+ Amount +'</td>';
		//13
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${Amount}" type="text" class="form-control" style="margin-left:21%; width: 65%;" disabled></td>`;
		//14
		tableHtml += `<td style="display:none;"><input id="test" value="${TotalTax}" type="text" class="form-control" style="margin-left:21%; width: 65%;" disabled></td>`;
		tableHtml += '</tr>';
		$('#myData').append(tableHtml);
	}

function LedgerValues(){
	 $value = $("#sale_type").val();
	 if($value == "Cash Sale"){
	 	$('#ledgerRow').hide();
	 }
	  if($value == "Credit Sale"){
   $('#ledgerRow').show();
}
}


	function TotalRecords() {
		var rowCount = document.getElementById('myTable').rows.length;
		alert("Total Number of Records Are: " + rowCount);
	}

function DCMouseUp(value){
$.ajax({
	type: "GET",
	url: "/dcmouseup-ajax?dc_no=" + value,
	success: function(data){
		if(data.length > 0)
		{

		var partyID = data[0].party_id;
		var partyName = data[0].party_name;
		var partyAddress = data[0].address;
		var partyNTN = data[0].ntn;
		document.getElementById("party_id").value = partyID;
		document.getElementById("party_name").value = partyName;
		document.getElementById("address").value = partyAddress;
		document.getElementById("ntn").value = partyNTN;

		$.each(data, function(key, value){
		var newRow =
 '<tr>'+
	// '<td class="text-center"><i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-cancel icon-larger red-color" title="Delete Row"></i> </td>'+
	 //'<td>' + data[key].product_id + '</td>'+
	 '<td style="display:none;"><input id="test" value="${ProductId}" type="text" class="form-control" disabled></td>'+
	 //'<td>' + data[key].product_code + '</td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${ProductCode}" type="text" class="form-control" style="margin-left: 14%; width: 65%;" disabled></td>'+
	 //'<td>' + data[key].product_name + '</td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${ProductName}" type="text" class="form-control" style="margin-left: 7%; width: 153%;" disabled></td>'+
	 '<td style="display:none;"><input id="test" value="${UOMID}" type="text" class="form-control" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${UOM}" type="text" class="form-control" style="margin-left: 88%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${Quantity}" type="text" class="form-control" style="    margin-left: 80%;width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${Price}" type="text" class="form-control" style="margin-left:72%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${STValue}" type="text" class="form-control" style="margin-left:64%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${TaxValue}" type="text" class="form-control" style="margin-left:56%; width: 65%;" disabled></td>'+

	 '<td style="padding-top:20px;"><input id="test" value="${ExtraTax}" type="text" class="form-control" style="margin-left:47%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${ExtraTaxValue}" type="text" class="form-control" style="margin-left:39%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${ValueExTax}" type="text" class="form-control" style="margin-left:29%; width: 65%;" disabled></td>'+
	 '<td style="padding-top:20px;"><input id="test" value="${Amount}" type="text" class="form-control" style="margin-left:21%; width: 65%;" disabled></td>'+


	 //'<td style="display:none;">' + data[key].rate + '</td>'+
	 //'<td style="display:none;">' + data[key].rate + '</td>'+
	 //'<td style="display:none;">' + data[key].uom + '</td>'+
	 //'<td id="quantity">' + data[key].quantity + '</td>'+
	 //'<td style="display:none;">' + data[key].amount + '</td>'+
	 //'<td><input type="text" onkeyup="SaleRateKeyUp($(this).val(), $(this).closest(\'tr\').index())"></td>'+
	 //'<td><input type="text" onkeyup="TaxValueKeyUp($(this).val(), $(this).closest(\'tr\').index())"></td>'+
	 //'<td></td>'+
	 //'<td style="display:none;"><input type="text" onkeyup="ExtraTaxValueKeyUp($(this).val(), $(this).closest(\'tr\').index())"></td>'+
	 //'<td style="display:none;"></td>'+
	 //'<td></td>'+
	 // '<td style="display:none;">' + data[0].tax_id + '</td>'+
	
  '</tr>';
		$('#myData').append(newRow);
                              
        });
		}
	}
})

}

function SaleRateKeyUp(SaleRate, RowIndex){

	var quantity = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('6')").text();
	var tax = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('9')").val();
	// alert(tax)

}

	function QuantityKeyUp(quantity){
			var tax = document.getElementById('stvalue').value;
			var extratax = document.getElementById('extratax').value;
			var price = document.getElementById('price_per_unit').value;
			var totaltax = (price/100*tax) * quantity;
			var extratax = (price/100*extratax) * quantity;
			document.getElementById('taxvalue').value = totaltax;
			document.getElementById('extraTaxValue').value = extratax;
			var valueWithoutTax = quantity * price;
			document.getElementById('ValueExTax').value = valueWithoutTax;
			total = (quantity * price) + totaltax + extratax;
			document.getElementById('amount').value = total;
		}

	function SaleRateKeyUpForm(price){
		var quantity = document.getElementById('quantity').value;
		var stvalue = document.getElementById('stvalue').value;
		//tax value
		var tax = (stvalue/100*price)*quantity;
		document.getElementById('taxvalue').value = tax;
		
		//extra tax value
		var extrataxvalue = document.getElementById('extratax').value;
		var extratax = (extrataxvalue/100*price)*quantity;
		document.getElementById('extraTaxValue').value = extratax;

		var total = quantity*price;
		var totalValue = total + tax + extratax;
		document.getElementById('ValueExTax').value = total;
		document.getElementById('amount').value = totalValue;

	}

		function ExtraTaxkeyup(taxvalue){

			var quantity = document.getElementById('quantity').value;
			var price = document.getElementById('price_per_unit').value;
			var stvalue = document.getElementById('stvalue').value;
			var tax = (stvalue/100*price)*quantity;
			var extratax = (taxvalue/100*price)*quantity;

			document.getElementById('extraTaxValue').value = extratax;
			var total = quantity*price;
			var totalValue = total + tax + extratax;
			document.getElementById('ValueExTax').value = total;
			document.getElementById('amount').value = totalValue;

		}

function TaxValueKeyUp(TaxValue, RowIndex)
{
var quantity = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('6')").text();
var price = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('8')").find('input').val();
var ExtraTax = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('11')").find('input').val();

var TotalTax = parseInt(TaxValue/100*price*quantity);
var TotalExtraTax = parseInt(ExtraTax/100*price*quantity);
var TotalValue = price*quantity;
var InclusiveValue = TotalTax + TotalValue;
 $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('10')").text(TotalTax);
 $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('12')").text(TotalExtraTax);
 $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('13')").text(InclusiveValue);

}

// function ExtraTaxValueKeyUp(ExtraTax, RowIndex)
// {
// 	var quantity = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('6')").text();

// 	var price = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('8')").find('input').val();
// 	var TaxValue = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('9')").find('input').val();
	
// 	var TotalTax = parseInt(TaxValue/100*price*quantity);
// 	var TotalExtraTax = parseInt(ExtraTax/100*price*quantity);
// 	var TotalValue = price*quantity;
// 	var InclusiveValue = TotalTax + TotalValue + TotalExtraTax;
// 	// var TotalAmount = InclusiveValue + TotalExtraTax;
//  $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('10')").text(TotalTax);
//  $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('12')").text(TotalExtraTax);
//  $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('13')").text(InclusiveValue);
// }



// on javascript onclick on product dropdown 
	function CodeKeyUp(codeValue){
		$.ajax({
			type: "GET",
			url: "/saletab-ajax?code=" + codeValue,
			success: function(result) {
				if(result.length > 0)
				{
					$('#product_name').val(result[0].product_name);
					$('#product_id').val(result[0].id);
					$("#packing_type").val(result[0].catagory_name);
					$("#price_per_unit").val(result[0].price_per_unit);
					$("#uom").val(result[0].uom);
					$("#stvalue").val(result[0].stvalue);

					var price = $("#price_per_unit").val();
					var quantity = $("#quantity").val();
					var stvalue = $("#stvalue").val();
					var tax = parseInt((stvalue/100*price)*quantity);
					
					document.getElementById('taxvalue').value = tax;
					valueWithoutTax = quantity * price;
					document.getElementById('value').value = valueWithoutTax;
					var total = price * quantity;
					var grand = tax + total;
					document.getElementById('amount').value = grand;
					document.getElementById('grand_total').value = grand;
				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}

	// on javascript onclick on product dropdown 
	function ProductKeyUp(ProductName, ProductID){
		$.ajax({
			type: "GET",
			url: "/taxproductkeyup-ajax?product_ID=" + ProductID,
			success: function(result) {
				if(result.length > 0)
				{
					$('#product_code').val(result[0].product_code);
					$('#product_id').val(result[0].id);
					$("#packing_type").val(result[0].catagory_name);
					$("#price_per_unit").val(result[0].price_per_unit);
					$("#uom").val(result[0].uom);
					$("#stvalue").val(result[0].tax);
				

					var price = $("#price_per_unit").val();
					var quantity = $("#quantity").val();
					var stvalue = $("#stvalue").val();
					var extratax = $("#extratax").val();
					var tax = parseInt((stvalue/100*price)*quantity);
					var extratax = parseInt((extratax/100*price)*quantity);
					document.getElementById('taxvalue').value = tax;
					document.getElementById('extraTaxValue').value = extratax;
					var total = price * quantity;
					var grand = tax + extratax + total;
					document.getElementById('value').value = total;
					document.getElementById('amount').value = grand;
				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}


	

	function PartyKeyUp(partyID){

		$.ajax({
			type: "GET",
			url: "/taxpartyonchange-ajax?party_ID=" + partyID,
			success:function(result)
			{
				if(result.length > 0){
					$('#party_id').val(result[0].id);
					$('#address').val(result[0].address);
					$('#strn').val(result[0].strn);
					$('#ntn').val(result[0].ntn);
				}
			}
		})
	}


	//on product Mouse up 
	function productMouseUp(productName, rowIndex){
		$.ajax({
			type: "GET",
			url: "/productonchange-ajax?product_name=" + productName,
			success: function(result) {
				if(result.length > 0)
				{
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('0')").find('input').val(result[0].id);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('1')").find('input').val(result[0].product_code);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('3')").find('input').val(result[0].remaining_quantity);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('5')").find('input').val(result[0].unit_cost);

					var salePrice = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val();

					var discount = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('4')").find('select').val().split("_").pop();
					var quantity = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('3')").find('input').val();
					var price = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val();
					var grand = (price * quantity) - (((discount/100))*price * quantity);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('7')").find('input').val(grand);

				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}

function salepriceMouseUp(salePrice, rowIndex){
	var quantity = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('3')").find('input').val();
	var saleprice = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val();
	var grand = quantity*saleprice;
	$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('7')").find('input').val(grand);
}
		
	$("#product_codess").keyup(function(){
			if($("#product_code").val() != "0")
			{
				$.ajax({
					type: "GET",
					url: "/getfirstProduct-ajax?saletab_id=" + $("#product_code").val(),
					success: function(result) {
						if(result.length > 0)
						{
						$("#product_id").val(result[0].id);
						$("#product_name").val(result[0].product_english);
						$("#unit_cost").val(result[0].product_price);
						
							var quantity = document.getElementById('quantity').value;
							var cost = document.getElementById('unit_cost').value;
							var discount = document.getElementById('discount_id').value.split("_").pop();
							//var tax = document.getElementById('tax_id').value.split("_").pop();
							var totalDiscount = ((discount/100)*quantity*cost);
							var total = quantity * cost;
							document.getElementById('total_cost').value = total - totalDiscount;
							
						}	
					},
					error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.status);
						alert(thrownError);
					}				
				});				
			}		
		});
	

	function myDeleteFunction(row) {
		if(confirm("Are you sure you want to delete this Record?"))
		{
			$(row).remove();
		}
	}


	function DiscountNew(discount, rowIndex){
		var quantity = $('tr:eq(' + rowIndex +')', myTable).find("td:eq('3')").find('input').val();
		var discountnew = $('tr:eq(' + rowIndex +')', myTable).find("td:eq('4')").find('select').val().split("_").pop();		
		var price = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('5')").find('input').val();
		var totalDiscount = ((discountnew/100)*quantity*price);
		var total = quantity * price;
		//document.getElementById('total_costnew').value = totalDiscount;
		$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val(total-totalDiscount);
		///if(parseFloat(tax) > 0)
		//{
			//var grand = (quantity*unitPrice) - discount;
			
		//}
		//else
		//{
			//$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('5')").find('input').val(unitPrice);
		//}	
				
}

// on javascript onclick on product dropdown
	function quantityMouseUp(quantity, rowIndex){	
		

		var code = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('1')").find('input').val();
		alert(code);
		var remainingquantity = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('8')").find('input').val();
		if (quantity > remainingquantity) {
		    alert("Invalid! Your Remaining Stock is: " + quantity);
		   e.preventdefault();
		}
		var price = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val();
		var discount = $('tr:eq(' + rowIndex +')', myTable).find("td:eq('4')").find('select').val().split("_").pop();
		
		var totalDiscount = ((discount/100)*quantity*price);
		var total = quantity * price;
		$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('7')").find('input').val(total-totalDiscount);
		//if(parseInt(quantity) > 0)
		//{	
			//$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('4')").find('input').val(grand);
		//}
		//else
		//{
			//$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('4')").find('input').val(price);
		//}	
				
}

$("#btnSave").click(function()
{
	alertify.confirm("Are you sure you want add Sale Bill?", function (e) {
	if (e)
	{
	 var purchase = new Object();
	 purchase.party_id = $("#party_id").val();
	 purchase.date = $("#date").val();
	 purchase.sale_type = $("#sale_type").val();
	//  if($("#due_date").val() != ""){
	//  purchase.due_date = $("#due_date").val();
	//  purchase.particulars = $("#particulars").val();
	// }
	purchase.invoice_no = $("#invoice_no").val();
	purchase.dcn_no = $("#dcn_no").val();
	purchase.p_order = $("#p_order").val();
	purchase.biller = $("#biller").val();
	
	var products = [];
	$.each($("#myData tr"), function(index, row){
		var columns = $(row).find("td");
		var product = new Object();
		product.party_id = $("#party_id").val();
		product.product_id = $(columns[0]).find("input").val();
		product.uom_id = $(columns[3]).find("input").val().split("_")[0];
		product.quantity = $(columns[5]).find("input").val();
		product.rate = $(columns[6]).find("input").val();
		product.stvalue = $(columns[7]).find("input").val();
		product.taxvalue = $(columns[8]).find("input").val();
		product.extratax = $(columns[9]).find("input").val();
		product.extraTaxValue = $(columns[10]).find("input").val();
		product.excvalue = $(columns[11]).find("input").val();
		product.incvalue = $(columns[12]).find("input").val();
		product.TotalTax = $(columns[13]).find("input").val();
		products.push(product);
	});

	var $_token = jQuery('#token').val();
	jQuery.ajax({
		method: "PATCH",
		cache: false,
		headers: { 'X-XSRF-TOKEN' : $_token },
		data: {purchase: JSON.stringify(purchase), product_data:products},
		url: "/salestax/<?php echo $edit->id ?>",
		success: function(result) {
			//if(result == "inserted")
			if(parseInt(result) > 0)
			{
			window.open("/salestax/print/"+result);
			window.location.href = "/salestax/create";
			//window.open("/sales/print/"+result);
			//alert("Sale successfully saved.");
			//Session::flash('flash_message', 'Sale Added Successfully!');
			//window.location.href = "/sales";	
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$("#spanWait").hide();
			alert(xhr.status);
			alert(thrownError);
		}
	});
	} else {
		        alertify.alert("Not Saved!");
		    }
		});
});

		// $('#date').datepicker({
		// 			startView: 0,
		// 			keyboardNavigation: false,
		// 			forceParse: false,
		// 			format: "dd/mm/yyyy"
		// 		});



</script>
@stop