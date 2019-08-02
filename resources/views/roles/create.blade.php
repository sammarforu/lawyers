@extends("app")
@section("contents")
      <div class="content-wrapper" style="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Create User
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="/roles"><i class="fa fa-dashboard"></i>Users Management</a></li>
            <li class="active">Create User</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
			<div class="panel panel-default">
				<div class="panel-heading">Create User
				<p style="float: right;"><a href="/roles">Users Management</a></p>
				</div></br>
				@include('errors.validation')
					{!! Form::open(['url' => 'roles/adduser', 'class'=>'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
							@include('roles._form', ['submitbutton' => 'save'])
						{!! Form::close() !!}
			</div>          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@stop	  
