@include("/include.config")

@extends("app")
@section("head")
<link href="/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
@stop
@section("contents")
<div class="container-fluid">
	@if (Session::has('flash_message'))
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
		<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
	@endif
</div>
<div class="page-heading clearfix">
	<h1 class="page-title pull-left">Purchases Tax</h1><a href="purchase-tax/create" class="btn btn-primary btn-sm btn-add" role="button">Add Purchase Tax Invoice</a>
</div>
<!--
<div class="btn-group" style="float: right; margin-top: -32px;">
	<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">Excel</a>
	<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">PDF</a>
	<a href="parties/create" class="btn btn-primary btn-sm btn-add" role="button">Print</a>
</div>
--->
<!-- Breadcrumb -->
<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="
	/dashboard"><i class="fa fa-home"></i>Home</a></li> 
	<!-- <li><a href="/sales">Sales</a></li>  -->
	<li class="active"><strong>Purchases Tax</strong></li> 
</ol>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h3 class="panel-title">Manage Purchases Tax</h3>
		<!-- <ul class="panel-tool-options"> 
			<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
			<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
			<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
		</ul> -->
	</div>
	<div class="panel-body">
		<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
		<tr>
			<th>Sr#</th>
			 <th>Date</th>
			  <th>Invoice&nbsp;No</th>
			  <th>Tax&nbsp;Value</th>
			  <th>Ex.Tax&nbsp;Value</th>
			  <th>Total</th>
			  <th>Grand Total</th>
			   <th>Party</th>
			  <th>Party&nbsp;NTN</th>
			  <th>Print</th>
			  <th>Actions</th>
		</tr>
		</thead>
		 <tbody>
		<?php $sum = 0; ?>
	 	@foreach($purchases as $purchase)
	    <?php $sum = $sum + 1; ?>
		<tr><td class="center">{{$sum}}</td>
			<td class="center">{{date("m/d/Y", strtotime($purchase->date))}}</td>
			<td class="center">{{$purchase->invoice_no}}</td>

			<?php $total = 0; $discount = 0; $tax = 0; $extratax = 0; 
			$grandtotal = 0; ?>
			@foreach($purchase->purchasetax_details as $details)
				<?php $total = $total + $details->price * $details->quantity;
				     
					  //$discount = $discount + (($details->discount/100)*$details->quantity*$details->unit_cost);
					  $tax = $tax + $details->taxvalue;
					  $extratax = $extratax + $details->extraTaxValue;
					  $grandtotal = $grandtotal + $details->total;
				?>
				
			@endforeach
			<td class="center">{{(int)$tax}}</td>
			<td class="center">{{(int)$extratax}}</td>
			<td class="center">{{(int)$total}}</td>
			<!-- <td class="center">{{$discount}}</td> -->
			<td class="center">{{(int)$grandtotal}}</td>
			<td class="center">{{$purchase->parties->party_name}}</td>
			<td class="center">{{$purchase->parties->ntn}}</td>
			<td><a href="/purchase-tax/print/{{$purchase->id}}" target="__blank"
				 style="color:white;">
				<button class="btn btn-info" type="button"> <i class="icon-print" title="Print Invoice"></i></button></a>
			</td>
			<td class="size-80 text-center">
				<div class="row">
					<a href="/purchase-tax/{{$purchase->id}}/edit" style="color:white;">
					<button class="btn btn-black" type="button"> <i class="fa fa-paste" title="Edit Invoice"></i></button></a>
					<a href="javascript:checkDelete({{ $purchase->id }}, '/purchase-tax/{{ $purchase->id }}/destroy', '/purchase-tax');" target="__blank">
					<button class="btn btn-red" type="button"> <i class="icon-trash" title="Delete Invoice"></i></button></a>
				</div>
				 <!-- <div class="dropdown">
					<a class="more-link" data-toggle="dropdown" href="#/"><i class="icon-dot-3 ellipsis-icon"></i></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="/sales/{{$purchase->id}}" target="__blank">Invoice</a></li>
						<li><a href="/sales/print/{{$purchase->id}}" target="__blank">Print Invoice</a></li>
						<li><a href="/sales/{{$purchase->id}}/edit">Edit</a></li>
						<li><a href="javascript:checkDelete({{ $purchase->id }}, '/sales/{{ $purchase->id }}/destroy', '/sales');">Delete</a> </li>
					</ul>
				</div> -->
			</td>
		</tr>
	  
	  @endforeach
	  </tbody>
			<tfoot>
				<tr><th>Sr#</th>
					  <th>Date</th>
					  <th>Invoice No</th>
					  <!-- <th>Biller</th> -->
					  <!-- <th>Sale&nbsp;Type</th> -->
					  <th>Tax&nbsp;Value</th>
					  <th>Ex.Tax&nbsp;Value</th>
					  <th>Total</th>
					  <!--<th>Product Tax</th>-->
					  <th>Grand Total</th>
					   <th>Party</th>
					  <th>Party&nbsp;NTN</th>
					  <th>Print</th>
					  <th>Actions</th>
				</tr>
			</tfoot>
		</table>
		</div>
	</div>
	</div>
</div>
</div>
@stop

@section("scripts")
<script src="/js/jquery.min.js"></script>
<!--<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="/js/plugins/blockui-master/jquery.blockUI.js"></script>
<script src="/js/functions.js"></script>
--->
<script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="/js/plugins/datatables/jszip.min.js"></script>
<script src="/js/plugins/datatables/pdfmake.min.js"></script>
<script src="/js/plugins/datatables/vfs_fonts.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>

@stop