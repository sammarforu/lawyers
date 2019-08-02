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
				<h2 class="panel-title"><b>Add Return Sale</b></h2>
				<ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul>
			</div>
		<div class="panel-body">
			<input id="token" type="hidden" value="{{$encrypted_token}}">
			@include('errors.validation')
			{!! Form::open(['url' => 'sales-return', 'class' => 'form-horizontal' ]) !!}
			<!------Row right left setting---->
			<!-- <div class="row">
					<div class="form-group"> 
						  
						<div class="col-sm-2">
						<label class="col-sm-3 control-label">Date</label> 
							<div id="year-view" class="input-group date"> 
								<input id="date" type="date" name="date" class="form-control" required autofocus> 
								 
							</div>
						</div>
						  <div class="col-sm-8"> 
							
						</div>
						<div class="col-sm-2"> 
							<label class="col-sm-1 control-label">Sale&nbsp;Type</label>
							<select class="form-control" onchange="LedgerValues();" id="sale_type" name="sale_type">
								<option value="Cash Sale">Cash Sale</option>
								<option value="Credit Sale">Credit Sale</option>
							</select>
						</div> 							
					</div>
				</div> -->
				<div class="row">
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Date</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								<input id="date" type="date" name="date" value="<?php echo date('Y-m-d');?>" class="form-control" required> 
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<label class="col-sm-1 control-label">Sale&nbsp;Type</label>  
						<div class="col-sm-2"> 
							<select class="form-control livesearch" onchange="LedgerValues();" id="sale_type" name="sale_type">
								<option value="Cash Sale">Cash Sale</option>
								<option value="Credit Sale">Credit Sale</option>
							</select>
						</div> 							
					</div>
				</div>
				<div class="row" id="ledgerRow" style="display:none;">
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Due&nbsp;Date</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								<input id="due_date" type="date" value="<?php echo date('Y-m-d');?>" name="due_date" class="form-control"> 
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							</div>
						</div>
					
						<label class="col-sm-1 control-label"></label>  
						<div class="col-sm-2">
							{!! Form::text('particulars', null, ['id' => 'particulars', 'placeholder' => 'Description','class'=>'form-control']) !!}
						</div> 							
					</div>
				</div>
				<div class="form-group"> 
					<label class="col-sm-3 control-label">Bill No#</label>  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								{!! Form::text('invoice_no', $codes, ['id' => 'invoice_no','class'=>'form-control', 'required' => 'required', 'autofocus'=>'autofocus']) !!} 
							</div>
						</div>
						<label class="col-sm-1 control-label">Local&nbsp;or&nbsp;Export?</label>  
						<div class="col-sm-2"> 
							<select class="form-control livesearch" onchange="LedgerValues();" id="localExport" name="localExport">
								<option value="Local">Local</option>
								<option value="Export">Export</option>
							</select>
						</div>  
				</div>
				<div class="form-group" style="display:none;"> 
					<label class="col-sm-3 control-label">Biller</label>  
					<div class="col-sm-5"> 
					  <select name="biller" id="biller" class="form-control" disabled>
						<option value="{{ Auth::user()->id }}">{{ Auth::user()->name}}</option>
					  </select>
					</div> 
				</div>
				<div class="row">
					<div class="form-group"> 
						<label class="col-sm-3 control-label">Sale Type</label>
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								{!! Form::select('sale_list', array('Sale Return' => 'Sale Return', 'Sample Return' => 'Sample Return'), null, ['id' => 'sale_list', 'onchange' => 'SampleDescription($(this).val());', 'class'=>'form-control livesearch']) !!}
							</div>
						</div>
						<label class="col-sm-1 control-label">DC No</label>  
						<div class="col-sm-2">
							{!! Form::select('dcn_no', $DeliveryChallan, null, ['id' => 'dcn_no', 'onchange' => 'DCMouseUp($(this).val());', 'class'=>'form-control livesearch', 'disabled' => 'disabled']) !!}
						</div> 							
					</div>
				</div>
				 <div class="form-group" id="sample_div" style="display:none;">
					<label class="col-sm-3 control-label">Sample Description</label>  
					<div class="col-sm-5"> 
					{!! Form::text('sample_description', null, ['id' => 'sample_description', 'class'=>'form-control']) !!}
					</div> 
				</div>
				<div class="form-group">  
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
							</div>
						</div>
						<label class="col-sm-1 control-label">Select&nbsp;Party</label> 
						<!-- <div class="col-sm-2"> 
							<div id="year-view" class="input-group date">  -->
								{!! Form::hidden('party_id', null, ['id' => 'party_id', 'class'=>'form-control']) !!} 
							<!-- </div>
						</div> -->
						<div class="col-sm-2"> 
							<div id="year-view" class="input-group date"> 
								{!! Form::select('party_name', $customers, null, ['id' => 'party_name',  'onchange' => 'javascript:PartyKeyUp($(this).val());','class'=>'form-control livesearch', 'required' => 'required', 'placeholder' => 'Start Typing......']) !!} 

							</div>
						</div> 
						<div class="col-sm-3"> 
							
								{!! Form::text('address', null, ['id' => 'address','class'=>'form-control', 'placeholder' => 'Address', 'disabled' => 'disabled']) !!} 
							
						</div>
						<div class="col-sm-2"> 
							
								{!! Form::text('ntn', null, ['id' => 'ntn','class'=>'form-control', 'placeholder' => 'NTN', 'disabled' => 'disabled']) !!} 
							
						</div>
				</div>	
			<div class="panel panel-default">
				<div class="panel-body">	
				<div class="form-group">
					<table  id="myTable">
						<div class="container-fluid">
								<div class="row">
								<tr> 
								
<!-- <div class="col-md-3"> 
	<div class="form-group"> 
		<label for="H.S" class="control-label">Id</label> -->
		{!! Form::hidden('product_id', null, ['id' => 'product_id','class'=>'form-control']) !!}
	<!-- </div>
</div>  -->
<div class="col-md-1"> 
	<div class="form-group"> 
		<label for="H.S" class="control-label">Code</label>
		{!! Form::text('product_code', null, ['id' => 'product_code', 'onkeyup' => 'CodeKeyUp($(this).val());', 'class'=>'form-control']) !!}
	</div>
</div> 
<div class="col-md-3"> 
	<div class="form-group"> 
		<label for="Name" class="control-label">Product Name</label> 
		{!! Form::select('product_name', $products, null, ['id' => 'product_name',  'onchange' => 'ProductKeyUp($(this).val());','class'=>'form-control livesearch']) !!}
	</div> 
</div> 
<div class="col-md-1"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Cost</label> 
		<input type="checkbox" id="checkbox7" checked="checked">
		{!! Form::text('product_cost', null, ['id' => 'product_cost', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Quantity</label> 
		{!! Form::text('quantity', 1, ['id' => 'quantity', 'onkeyup' => 'QuantityKeyUp($(this).val())', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-2"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Cost Amount</label> 
		{!! Form::text('cost_amount', null, ['id' => 'cost_amount', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-2"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Sale Rate</label> 
		{!! Form::text('price_per_unit', null, ['id' => 'price_per_unit', 'onkeyup' => 'SaleRate($(this).val())','class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-2"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Sale Amount</label> 
		{!! Form::text('balance', null, ['id' => 'balance', 'onkeyup' => 'AddGridData()', 'class'=>'form-control']) !!}
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
						<h3 class="panel-title">Invoice Grid</h3>
						<!-- <ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul> -->
					</div>
					<div class="panel-body">
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
										
										<!-- <th scope="row">1</th> 
										<td>Mark</td> 
										<td>Otto</td> 
										<td>@mdo</td> 
										<td>Mark</td> 
										<td>Otto</td> 
										<td>@mdo</td> 
										<td>Mark</td> 
										<td>Otto</td> 
										<td>@mdo</td> 
										<td>Mark</td> 
										<td>Otto</td>  -->
									</div> 
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<center><div class="form-actions">
			  <button type="button" class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
			</div></center>		
			<div class="col-lg-3">
				<!-- <button type="button" onclick="AddRowFunction()" class="btn btn-success"><i class="fa fa-plus"></i> </button> -->
				<!-- <button type="button" onclick="AddGridData()" class="btn btn-success"><i class="fa fa-plus"></i> </button>
				<button type="button" onclick="TotalRecords()" class="btn btn-success">Total Records</button> -->
			</div>			
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

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
	$(".livesearch").chosen();
</script> -->

<script type="text/javascript">

	function AddGridData(){
		var date = document.getElementById('date').value;
		var InvoiceNo = document.getElementById('invoice_no').value;
		var ProductId = document.getElementById('product_id').value;
		var ProductCode = document.getElementById('product_code').value;
		var ProductName = document.getElementById('product_name').value;
		var Cost = document.getElementById('product_cost').value;
		var Quantity = document.getElementById('quantity').value;
		var CostAmount = document.getElementById('cost_amount').value;
		var Price = document.getElementById('price_per_unit').value;
		var Amount = document.getElementById('balance').value;
		var tableHtml = '<tr>';
		tableHtml += '<td class="text-center"><i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-cancel icon-larger red-color" title="Delete Row"></i> </td>';
		tableHtml += '<td>'+ ProductId +'</td>';
		tableHtml += '<td>'+ ProductCode +'</td>';
		tableHtml += '<td>'+ ProductName +'</td>';
		tableHtml += '<td>'+ Cost +'</td>';
		tableHtml += '<td>'+ Quantity +'</td>';
		tableHtml += '<td>'+ CostAmount +'</td>';
		// tableHtml += '<td>'+ Price +'</td>';
		 tableHtml += `<td><input id="test" value="${Price}" type="text" disabled></td>`;
		// document.getElementById('test').value=Price;
		tableHtml += '<td>'+ Amount +'</td>';
		tableHtml += '</tr>';
		$('#GridTable').append(tableHtml);
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

function SampleDescription(val){
	// alert(val)
	// $value = $("#sale_list").val();
	// alert(value)
	if(val == "Sample"){
	 	$('#sample_div').show();
	 }
	 if(val == "Sale Bill" || val == "Sale Invoice"){
	 	$('#sample_div').hide();
	 }
}


	function DCMouseUp(value){
	$.ajax({
		type: "GET",
		url: "/dcmouseup-ajax?dc_no=" + value,
		success: function(data){
			if(data.length > 0)
			{
				$.each(data, function(key, value){
					var newRow = '<tr>'+
									'<td class="text-center"><i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-cancel icon-larger red-color" title="Delete Row"></i> </td>'+
									 '<td>' + data[key].product_id + '</td>'+
									 '<td>' + data[key].product_code + '</td>'+
									 '<td>' + data[key].product_name + '</td>'+
									 '<td>' + data[key].rate + '</td>'+
									 '<td id="quantity">' + data[key].quantity + '</td>'+
									 '<td>' + data[key].amount + '</td>'+
									 '<td><input type="text" onkeyup="SaleKeyUp($(this).val(), $(this).closest(\'tr\').index())"></td>'+
									 '<td></td>'+
									 // '<td style="display:none;">' + data[0].tax_id + '</td>'+
									
								  '</tr>';
      					$('#GridTable').append(newRow);
                    // $("#GridTable tr").append("<td>" +
                    //                     "ID :" + value.pr_no +
                    //                     "Name :"+ value.pr_no +
                    //                     "Age :" + value.pr_no + 
                    //                     "</td>");
                                      
                });
			}
		}
	})

}

function SaleKeyUp(SaleValue, RowIndex)
{
var quantity = $('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('5')").text();
// alert(quantity)
var total = SaleValue * quantity;
$('tr:eq(' + RowIndex + ')', GridTable).find("td:eq('8')").text(total);

}

function SaleKeyUpOne(SaleValue)
{
	alert(SaleValue)
}


	function TotalRecords() {
		var rowCount = document.getElementById('myTable').rows.length;
		alert("Total Number of Records Are: " + rowCount);
	}

// on javascript onclick on product dropdown 
// 	function CodeKeyUp(codeValue){
// 		$.ajax({
// 			type: "GET",
// 			url: "/saletab-ajax?code=" + codeValue,
// 			success: function(result) {
// 				if(result.length > 0)
// 				{
// 					$('#product_name').val(result[0].product_name);
// 					$('#product_id').val(result[0].id);
// 					$("#packing_type").val(result[0].catagory_name);
// 					$("#price_per_unit").val(result[0].price_per_unit);
// 					$("#uom").val(result[0].uom);
// 					$("#stvalue").val(result[0].stvalue);

// 					var price = $("#price_per_unit").val();
// 					var quantity = $("#quantity").val();
// 					var stvalue = $("#stvalue").val();
// 					var tax = parseInt((stvalue/100*price)*quantity);
					
// 					document.getElementById('taxvalue').value = tax;
// 					valueWithoutTax = quantity * price;
// 					document.getElementById('value').value = valueWithoutTax;
// 					var total = price * quantity;
// 					var grand = tax + total;
// 					document.getElementById('amount').value = grand;
// 					document.getElementById('grand_total').value = grand;
// 				}	
// 			},
// 			error: function (xhr, ajaxOptions, thrownError) {
// 				alert(xhr.status);
// 				alert(thrownError);
// 			}				
// 		});
// }

	// on javascript onclick on product dropdown 
	function ProductKeyUp(ProductID){
		$.ajax({
			type: "GET",
			url: "/productkeyup-ajax?prodID=" + ProductID,
			success: function(result) {
				if(result.length > 0)
				{
					$('#product_code').val(result[0].product_code);
					$('#product_id').val(result[0].id);
					$("#product_cost").val(result[0].unit_cost);
					$("#price_per_unit").val(result[0].price_per_unit);

					var price = $("#price_per_unit").val();
					var quantity = $("#quantity").val();
					var cost = $("#product_cost").val();
					var CostAmount= cost * quantity;
					var SaleAmount = price * quantity;
					document.getElementById('cost_amount').value = CostAmount;
					document.getElementById('balance').value = SaleAmount;
				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}

		function SaleRate(salerate){
			var quantity = document.getElementById('quantity').value;
			var price = document.getElementById('price_per_unit').value;
			var total = quantity*salerate;
			document.getElementById('balance').value = total;

		}

		function QuantityKeyUp(quantity){
			var price = document.getElementById('price_per_unit').value;
			var cost = document.getElementById('product_cost').value;
			var CostAmount = quantity * cost;
			document.getElementById('cost_amount').value = CostAmount;
			total = (quantity * price);
			document.getElementById('balance').value = total;
		}

	function PartyKeyUp(partyId){
		$.ajax({
			type: "GET",
			url: "/partyonchange-ajax?party_id=" + partyId,
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
	
	var test = $("#party_id").val();
	var purchase = new Object();
	purchase.date = $("#date").val();
	if($("#due_date").val() != ""){
	purchase.due_date = $("#due_date").val();
	purchase.particulars = $("#particulars").val();
	}
	purchase.party_id = $("#party_id").val();
	purchase.sale_type = $("#sale_type").val();
	purchase.sale_list = $("#sale_list").val();
	purchase.sample_description = $("#sample_description").val();
	purchase.dcn_no = $("#dcn_no").val();
	purchase.invoice_no = $("#invoice_no").val();
	purchase.localExport = $("#localExport").val();
	purchase.biller = $("#biller").val();
	 
	
	var products = [];
	debugger;
	$.each($("#GridTable tr"), function(index, row){
		var columns = $(row).find("td");
		var product = new Object();
		product.party_id = $("#party_id").val();
		product.product_id = $(columns[1]).text();
		product.product_cost = $(columns[4]).text();
		product.quantity = $(columns[5]).text();
		product.cost_amount = $(columns[6]).text();
		product.sale_rate = $(columns[7]).find("input").val();
		product.balance = $(columns[8]).text();
		products.push(product);
	});
	
	var $_token = jQuery('#token').val();
	jQuery.ajax({
		method: "POST",
		cache: false,
		headers: { 'X-XSRF-TOKEN' : $_token },
		data: {purchase: JSON.stringify(purchase), product_data:products},
		url: "/sales-return",
		
		success: function(result) {
			//if(result == "inserted")
			if(parseInt(result) > 0)
			{
				//window.open("/sales-return/print/"+result);
				window.location.href = "/sales-return/create";
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
});

		// $('#date').datepicker({
		// 			startView: 0,
		// 			keyboardNavigation: false,
		// 			forceParse: false,
		// 			format: "dd/mm/yyyy"
		// 		});



</script>
@stop