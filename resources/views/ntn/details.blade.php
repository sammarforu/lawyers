@extends("app")
@section("head")
<link href="/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/bg.css" rel="stylesheet">
@stop
@section("contents")
	<!-- /main header -->
	
	

	
	<!-- Main content -->
	<div class="main-content" style="padding: 0px 20px;">
		<div class="header-secondary row">
		<div class="col-lg-12">
			<div class="page-heading clearfix">
				<h1 class="page-title" id="detailheader">NTN Detail</h1>
				<b id="createdby">CREATED BY: {{$data[0]->biller->name}}</b><!-- <button class="btn btn-danger btn-sm btn-add">Add New</button> -->
			</div>
		</div>
	</div>
		<!-- Card grid view -->
		<div class="cards-container grid-view">
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>ID</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent" class="uppercase">{{$data[0]->voucher_no}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>NTN</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->ntn}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>OFFICE</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent" class="uppercase">{{$data[0]->office->catagory_name}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>CLIENT NAME</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent" class="uppercase">{{$data[0]->client_name}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>BUSINESS NAME</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent" class="uppercase">{{$data[0]->business_name}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>CELL NO</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->cell_no}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>CNIC</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->cnic}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>EMAIL</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->email}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>PASSWORD</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->password}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>IRIS ID</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->iris_id}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>IRIS PASSWORD</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->iris_password}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>IRIS PIN</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->iris_pin}}</p>
						</div>
					</div>
				</div>
			</div>
	<!-- 		<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>STATUS</b></span></h5></center>
							</div>
						</div>
						<div class="card-content">
							<p id="detailcontent">{{$data[0]->status}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>ATTACHMENT</b></span></h5></center>
							</div>
						</div>
						<div class="card-content">
							@if($data[0]->attachment!=null)
							<p id="detailcontent"><a href="{{url('upload/files/')}}/{{$data[0]->attachment}}"><button class="btn"><i class="fa fa-download"></i>Download</button></a></p>
							@else
							<p id="detailcontent">NO ATTACHMENT FOUND!</p>
							@endif
						</div>
					</div>
				</div>
			</div> -->
			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<div class="card primary-view">
						<div class="card-header">
							<div class="">
								<center><h5><span class="user-name"><b>DOWNLOAD ATTACHMENT</b></span></h5></center>
								<!-- <p class="uppercase">Agent</p> -->
							</div>
						</div>
						<div class="card-content">
							@if($data[0]->attachment!=null)
							<p id="detailcontent"><a href="{{url('upload/ntn/')}}/{{$data[0]->attachment}}"><button class="btn"><i class="fa fa-download"></i>DOWNLOAD</button></a></p>
							@else
							<p id="detailcontent">NO ATTACHMENT FOUND!</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>		
	  </div>
	  <!-- /main content -->
@stop

