@extends("app")
@section("head")


<!-- Site favicon -->
<link rel='/shortcut icon' type='image/x-icon' href='images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="/css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="/css/plugins/select2/select2.css" rel="stylesheet">
<link href="/css/mouldifi-forms.css" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->
@stop
@section("contents")
	
	<!-- Secondary header -->
	<div class="header-secondary row">
		<div class="col-lg-12">
			<div class="page-heading clearfix">
				<h1 class="page-title pull-left">
				{{$parties->party_name}}</h1><a href="/parties" class="btn btn-primary btn-sm btn-add" role="button">Home</a>
			</div>
		</div>
	</div>
	<!-- /secondary header -->

		
		<div class="row">
			<div class="col-md-12">
			
				<!-- Card grid view -->
				<div class="cards-container box-view grid-view">
					<div class="row">						
						<div class="col-lg-12 col-sm-6 ">
						
							<!-- Card -->
							<div class="card">
							
								<!-- Card header -->
								<div class="card-header">
									<div class="card-short-description">
										<h5><span class="user-name"><a href="#/">{{$parties->company}}</a></span></h5>
									</div>
								</div>
								<!-- /card header -->
								
								<!-- Card content -->
								<div class="card-content">
									<strong>Email : </strong>{{$parties->email}}</br>
									<strong>Phone : </strong>{{$parties->phone}}</br>
									<strong>Company : </strong>{{$parties->company}}</br>
									<strong>Address : </strong>{{$parties->address}}</br>
									<strong>City : </strong>{{$parties->city}}</br>
									<strong>State : </strong>{{$parties->state}}</br>
									<strong>Country : </strong>{{$parties->country}}</br>
									<strong>Sales Tax : </strong>{{$parties->sales_tax}}</br>
									<strong>National Tax : </strong>{{$parties->national_tax}}</br>
									
								</div>
								<!-- /card content -->
								
								<!-- Card footer -->
								<div class="card-footer clearfix">
									<ul class="list-inline">
										<li><a href="/parties/{{$parties->id}}/edit"><i class="icon-pencil" title="Edit"></i></a></li>
										<li><a href="javascript:checkDelete({{ $parties->id }}, '/parties/{{ $parties->id }}/destroy', '/parties');"><i class="icon-trash" title="Delete"></i></a></li>
										<li class="pull-right dropup">
											<a href="#/" data-toggle="dropdown"><i class="icon-dot-3 icon-more"></i></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#">Change Setting</a></li>
												<li><a href="#">View Profile</a></li>
												<li><a href="#">Send Message</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<!-- /card footer -->
								
							</div>
							<!-- /card -->
							
						</div>

					</div>

				</div>
				<!-- /card grid view -->
				
			</div>
		</div>	
@stop
