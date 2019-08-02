@extends("app")
@section("contents")
<body>
<!-- <body onload="AddRowFunction()"> -->
<div class="container-fluid">
	@if (Session::has('flash_message'))
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
		<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
	@endif
</div>
<h1 class="page-title">Delivery Challan</h1>
<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li> 
	<li><a href="/delivery-challan">Delivery Challan</a></li> 
	<li class="active"><strong>Delivery Challan</strong></li> 
</ol>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h3 class="panel-title">Add Delivery Challan</h3>
				<ul class="panel-tool-options"> 
					<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
					<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
					<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
				</ul>
			</div>
			<div class="panel-body">
			<input id="token" type="hidden" value="{{$encrypted_token}}">
			@include('errors.validation')
			{!! Form::open(['url' => 'delivery-challan', 'class' => 'form-horizontal' ]) !!}
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
						<label class="col-sm-1 control-label">Challan&nbsp;Type</label>  
						<div class="col-sm-3"> 
						{!! Form::select('type', array('Delivery Challan' => 'Delivery Challan'), null, ['id' => 'type', 'class'=>'form-control livesearch']) !!}	
						</div>
						<label class="col-sm-1 control-label">DC No</label>  
						<div class="col-sm-2">
							{!! Form::text('dcn_no', $codes, ['id' => 'dcn_no', 'class'=>'form-control']) !!}
						</div> 							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
						<label class="col-sm-1 control-label">Date</label>  
						<div class="col-sm-3"> 
							<div id="year-view" class="input-group date"> 
								<input id="date" type="date" name="date" value="<?php echo date('Y-m-d');?>" class="form-control"> 
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
							</div>
						</div>
						<label class="col-sm-1 control-label">Outward&nbsp;GPN</label>  
						<div class="col-sm-2">
							{!! Form::text('outward_gpn', null, ['id' => 'outward_gpn', 'class'=>'form-control', 'autofocus' => 'autofocus']) !!}
						</div> 
						<div class="col-sm-2" style="display:none;">
							{!! Form::text('status', 'Pending', ['id' => 'status', 'class'=>'form-control']) !!}
						</div>							
					</div>
				</div>
				<div class="row">
					<div class="form-group" style="margin-left: 1%; margin-right: 1%;"> 
						<label class="col-sm-1 control-label">Account</label>  
						<div class="col-sm-3"> 
						{!! Form::select('party_id', $parties, null, ['id' => 'party_id', 'class'=>'form-control livesearch']) !!}
						</div> 
					</div>
				</div>	
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
 <div class="panel-body">	
  <div class="form-group">
   <table  id="myTable">
    <div class="container-fluid">
     <div class="row">
      <tr> 
								
		{!! Form::hidden('product_id', null, ['id' => 'product_id','class'=>'form-control']) !!}
<div class="col-md-1" style="margin-left: 1%; margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="Code" class="control-label">Code</label>
		{!! Form::text('product_code', null, ['id' => 'product_code', 'class'=>'form-control']) !!}
	</div>
</div> 
<div class="col-md-3" style="margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="Name" class="control-label">Product Name</label> 
		{!! Form::select('product_name', $products, null, ['id' => 'product_name',  'onchange' => 'productMouseUp($(this).val().split("_").pop(), $(this).val().split("_")[0]);','class'=>'form-control livesearch']) !!}
	</div> 
</div>  
<div class="col-md-1" style="margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="Name" class="control-label">Unit</label> 
		{!! Form::select('uom_id', $uoms, null, ['id' => 'uom_id', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-1" style="margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Quantity</label> 
		{!! Form::text('quantity', 1, ['id' => 'quantity', 'onkeyup' => 'QuantityKeyUp($(this).val())', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-2" style="margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Cost Rate</label> 
		{!! Form::text('price', null, ['id' => 'price','onkeyup' => 'PriceKeyUp($(this).val())', 'class'=>'form-control']) !!}
	</div> 
</div>
<div class="col-md-2" style="margin-right: 1%;"> 
	<div class="form-group"> 
		<label for="password" class="control-label">Amount</label> 
		{!! Form::text('total', null, ['id' => 'total','onkeyup' => 'AddGridData()', 'class'=>'form-control']) !!}
	</div> 
</div>

</tr>
<div id="myData">

</div>
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
						  <div class="col-xs-3" style="">  </div>
						 <!--  <div class="col-xs-3" style="">  </div> -->
						  <div class="col-xs-3" style=""> <b>Total Rate</b> <input type="text" id="TotalRate" name="TotalRate" disabled	> </div>
						  <div class="col-xs-3"> <b>Total Amount</b> <input type="text" id="TotalAmount" name="TotalAmount" disabled> </div>
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
		</div>
	</div>
				<center><div class="form-actions">
			  <button type="button" class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
			</div></center>		
			<!-- <div class="col-lg-3">
				<button type="button" onclick="AddRowFunction()" class="btn btn-success"><i class="fa fa-plus"></i> </button>
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
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/js/plugins/select2/select2.full.min.js"></script>
<script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	var sum=0;


function LedgerValues(){
	 $value = $("#purchase_type").val();
	 if($value == "Cash Purchase"){
	 	$('#ledgerRow').hide();
	 }
	  if($value == "Credit Purchase"){
   $('#ledgerRow').show();
}
}

function QuantityKeyUp(quantity){
			var price = document.getElementById('price').value;
			//var tax = document.getElementById('tax_id').value.split("_").pop();
			//var taxvalue = tax/100*price*quantity;
			//total = (quantity * price) + taxvalue;
			total = (quantity * price);
			document.getElementById('total').value = total;
		}
function PriceKeyUp(price){
			var quantity = document.getElementById('quantity').value;
			//var tax = document.getElementById('tax_id').value.split("_").pop();
			//var taxvalue = tax/100*price*quantity;
			//total = (quantity * price) + taxvalue;
			total = (quantity * price);
			document.getElementById('total').value = total;
		}
		function CalculateTax(tax){
			
			var quantity = document.getElementById('quantity').value;
			var price = document.getElementById('price').value;
			var taxvalue = tax/100*price*quantity;
			total = (quantity * price) + taxvalue;
			document.getElementById('total').value = total;
		}
		

	function TotalRecords() {
		var rowCount = document.getElementById('myTable').rows.length;
		alert("Total Number of Records Are: " + rowCount);
	}

	function myDeleteFunction(row) {
		if(confirm("Are you sure you want to delete this row?"))
		{
			$(row).remove();
		}
	}

		// Code Mouse Up 
	function codeMouseUp(code, rowIndex){
		$.ajax({
			type: "GET",
			url: "/codemouseup-ajax?entered_code=" + code,
			success: function(result) {
				if(result.length > 0)
				{
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('0')").find('input').val(result[0].id);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('2')").find('input').val(result[0].product_name);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('5')").find('input').val(result[0].product_cost);
					// $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('2')").find('input').val(result[0].product_name);
					
					var tax = $('tr:eq(' + rowIndex +')', myTable).find("td:eq('3')").find('select').val().split("_").pop();
					var quantity = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('4')").find('input').val();
					//quantity = (quantity == "" || quantity == null) ? 0.00 : quantity;
					var cost = $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('5')").find('input').val();
					var totalcost = (quantity*cost) + ((tax/100)*quantity*cost);
					$('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val(parseInt(totalcost));
					 // if(parseInt(cost) == 0 && parseFloat(totalcost) > 0)
					 // {
					 // 	totalcost = parseInt(totalcost).toFixed(2);
					 // }
					 // $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('6')").find('input').val(parseInt(totalcost));
					 // $('tr:eq(' + rowIndex + ')', myTable).find("td:eq('4')").find('input').val(totalPrice);		
				//}
				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}

	function productMouseUp(productName, productID){
		$.ajax({
			type: "GET",
			url: "/dcproductmouseup-ajax?product_id=" + productID,
			success: function(result) {
				if(result.length > 0)
				{
				$('#product_code').val(result[0].product_code);
				$('#uom').val(result[0].uom);
				$('#product_id').val(result[0].id);
				$('#price').val(result[0].unit_cost);
				var price = $("#price").val();
				var quantity = $("#quantity").val();
				var total = price * quantity;
				document.getElementById('total').value = total;
				}	
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}				
		});
}

		function AddGridData(){
		var ProductId = document.getElementById('product_id').value;
		var ProductCode = document.getElementById('product_code').value;
		var ProductID = document.getElementById('product_name').value.split("_")[0];
		var ProductName = document.getElementById('product_name').value.split("_").pop();
		var UOMID = document.getElementById('uom_id').value.split("_")[0];
		var UOM = document.getElementById('uom_id').value.split("_").pop();
		var Quantity = document.getElementById('quantity').value;
		var CostRate = document.getElementById('price').value;
		var Amount = document.getElementById('total').value;
		document.getElementById('TotalRate').value = CostRate;
		document.getElementById('TotalAmount').value = Amount;
		
		var tableHtml = '<tr>';
		//tableHtml += '<td style="display:none;">'+ ProductId +'</td>';
		//0
		tableHtml += `<td style="display:none;"><input id="test" value="${ProductId}" type="text" class="form-control" disabled></td>`;
		//tableHtml += '<td>'+ ProductCode +'</td>';
		//1
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ProductCode}" type="text" class="form-control" style="margin-left: 7%; width: 51%;" disabled></td>`;
		//tableHtml += '<td>'+ ProductName +'</td>';
		//2
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${ProductName}" type="text" class="form-control" style="margin-left: -35%; width: 156%;" disabled></td>`;
		//3
		tableHtml += `<td style="display:none;"><input id="test" value="${UOMID}" type="text" class="form-control"  disabled></td>`;
		//4
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${UOM}" type="text" class="form-control" style="margin-left: 27%; width: 52%;" disabled></td>`;

		//tableHtml += '<td>'+ Quantity +'</td>';
		//5
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${Quantity}" type="text" class="form-control" style="margin-left: -15%; width: 52%;" disabled></td>`;
		//tableHtml += '<td>'+ CostRate +'</td>';
		//6
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${CostRate}" type="text" class="form-control" style="margin-left: -56%; width: 103%;" disabled></td>`;
		//tableHtml += '<td>'+ Amount +'</td>';
		//7
		tableHtml += `<td style="padding-top:20px;"><input id="test" value="${Amount}" type="text" class="form-control" style="margin-left: -46%; width: 103%;" disabled></td>`;
		//8
		tableHtml += '<td><button class="btn btn-red" type="button" style="    margin-left: -150%;"> <i onclick="javascript:myDeleteFunction($(this).closest(\'tr\'));" class="icon-trash" title="Delete Row"></i></button></td>';
		tableHtml += '</tr>';
		$('#myData').append(tableHtml);
	}

$("#btnSave").click(function()
{
	alertify.confirm("Are you sure you want add Sale Bill?", function (e) {
	if (e)
	{
	var grn = new Object();
	grn.party_id = $("#party_id").val();
	grn.date = $("#date").val();
	grn.dcn_no = $("#dcn_no").val();
	grn.type = $("#type").val();
	grn.outward_gpn = $("#outward_gpn").val();
	grn.status = $("#status").val();
	var GRNDetails = [];
	$.each($("#myData tr"), function(index, row){
		var columns = $(row).find("td");
		var details = new Object();
		//details.challan_id = $(columns[1]).text();
		details.product_id = $(columns[0]).find("input").val();
		details.uom_id = $(columns[3]).find("input").val();
		// product.tax_id = $(columns[3]).find("select").val().split("_")[0];
		// product.tax_id = $(columns[9]).text();
		details.quantity = $(columns[5]).find("input").val();
		details.rate = $(columns[6]).find("input").val();
		details.amount = $(columns[7]).find("input").val();

		//Code & product only for validation, not insertion
		//product.code = $(columns[1]).find("input").val();
		//product.product_name = $(columns[2]).find("input").val();
		// if($(columns[1]).find("input").val()=="" || $(columns[2]).find("input").val()==""){
		// 	alert('Fill the Code & Product Correctly First!');
  //          e.preventdefault();
		// 	}
		//validation
		// if($(columns[3]).find("input").val() =="" || $(columns[4]).find("input").val() =="" | $(columns[5]).find("input").val() =="" || $(columns[6]).find("input").val() ==""){
		// 	alert('Fill the Fields Correctly First!');
  //          e.preventdefault();
		// 	}
		GRNDetails.push(details);
	});
	var $_token = jQuery('#token').val();
	jQuery.ajax({
		method: "POST",
		cache: false,
		headers: { 'X-XSRF-TOKEN' : $_token },
		data: {grn: JSON.stringify(grn), details_data:GRNDetails},
		url: "/delivery-challan",
		
		success: function(result) {
			if(parseInt(result) > 0)
			{
				alert("Delivery Challan successfully saved.");
				//window.open("/grn/print/"+result);
				window.location.href = "/delivery-challan/create";
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