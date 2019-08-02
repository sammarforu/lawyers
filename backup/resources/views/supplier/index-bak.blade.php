@extends("app")
@section("contents")
	<!-- start: Content -->
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="/parties">Parties</a></li>
				<h3><span class="label label-default" style="float:right;margin-top: -40px;background: #060606;width: 120px;height: 30px;border-radius: 10px;" ><span ><a href="/parties/create" style="font-size: 18px;font-family: arial;color:white;"> <center style=" margin-top: 10px;">Add Party</center></a></span></h3>
			</ul>
			<div class="container-fluid">
				@if (Session::has('flash_message'))
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="margin-right: 20px;margin-top: 15px;">&times;</button>
					<div class="alert alert-success"> {{ Session::get('flash_message') }} </div>
				@endif
			</div>
			
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Manage Parties</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						
						  <thead>
							  <tr>
								  <th>Serial #</th>
								  <th>Party Name</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php $sum = 1; ?>
						  @foreach($party as $parties)

							<tr>
								<td><?php echo $sum; ?></td>
								<td class="center">{{$parties->party_name}}</td>
								</td>
								<td class="center">
									<a class="btn btn-info" href="parties/{{$parties->id}}/edit" title="Edit">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="javascript:checkDelete({{ $parties->id }}, '/parties/{{ $parties->id }}/destroy', '/parties');" title="Delete">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<?php $sum = $sum + 1;?>
						  @endforeach
						  </tbody>
						  
					  </table>            
					</div>
				</div><!--/span-->
			
@stop
	@section("scripts") 
	<script src="//code.jquery.com/jquery.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
