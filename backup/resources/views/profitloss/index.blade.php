@extends("app")
@section("contents")
	<!-- 		<div class="container-fluid">
				@if (Session::has('flash_message'))
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
					<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
				@endif
			</div> -->
			<div class="page-heading clearfix">
				<h1 class="page-title pull-left">Profit&nbsp;&&nbsp;Loss&nbsp;Account</h1><!-- <a href="catagories/create" class="btn btn-primary btn-sm btn-add" role="button">Add New</a> -->
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
				<!-- <li><a href="/parties">Catagories</a></li> --> 
				<li class="parties"><strong>Profit&nbsp;&&nbsp;Loss&nbsp;Account</strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Profit&nbsp;&&nbsp;Loss&nbsp;Account</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" >
									<thead>
										<tr>
											<th><h3><b>Particulars</b></h3></th>
										    <th><h3><b>Amount</b></h3></th>
											<th><h3><b>Particulars</b></h3></th>
										    <th><h3><b>Amount</b></h3></th>
										</tr>
									</thead>
									 <tbody>
						  <?php $sum = 1; ?>
						
							<tr>
								<td><h4><b>Purchases</b></h4></td>
								<td class="center"><h4><b>{{$purchases}}</b></h4></td>
								<td class="center"><h4><b>Sales</b></h4></td>
								<td class="center"><h4><b>{{$sales}}</b></h4></td>
							</tr>
							<tr>
								<td><h3><b>Gross Profit</h3></b></td>
								<?php $GrossProfit = $sales - $purchases;?>
								<td class="center"><h3><b>{{$GrossProfit}}</h3></b></td>
							</tr>
							<tr>
								<td><h3><b>Total Sale</h3></b></td>
								<td class="center"><h3><b>{{$sales}}</h3></b></td>
								<td><h3><b></b></h3></td>
								<td class="center"><h3><b>{{$sales}}</h3></b></td>
							</tr>
							<tr>
								<td><h3><b>Expenses</h3></b></td>
								<td class="center"><h3><b>{{$expenses}}</h3></b></td>
							</tr>
							<tr>
								<td><h3><b>Net Profit</h3></b></td>
								<?php $NewProfit = $GrossProfit - $expenses;?>
								<td class="center"><h3><b>{{$NewProfit}}</h3></b></td>
							</tr>
						  </tbody>
									<!-- <tfoot>
										<tr>
											<th>Serial #</th>
										    <th>Catagory Code</th>
											<th>Catagory Name</th>
										    <th>Actions</th>
										</tr>
									</tfoot> -->
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