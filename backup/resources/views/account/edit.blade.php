@extends("app")
@section("contents")
@include("/include.config")

<?php
	$que="select * from users where id = $id";
	$run=@mysql_query($que);

	$row=@mysql_fetch_array($run);
	$password = $row['password']; 
	
?>

   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- Left column -->
            <div class="col-md-6" style="border: 1px solid;">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" style="color:#00a65a;">Profile Management</h3>
                </div><!-- /.box-header -->
                <!-- form start -->					
				{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['AccountSettingController@update', $edit->id], 'class' => 'form-horizontal', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                  <div class="box-body">
                    <div class="form-group has-success">
                      <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
						{!! Form::text('name', null, ['id' => 'name', 'class'=>'form-control']) !!}
					  </div>
                    </div>
                    <div class="form-group has-success">
                      <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        {!! Form::text('email', null, ['id' => 'email', 'class'=>'form-control']) !!}
                      </div>
                    </div>
					<div class="form-group has-success">
                      <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <img src="D:/wamp/www/mouldifi/storage/users/{{(Auth::user()->image) }}" style="width: 120px;height: 140px;border-radius: 5px;border-image: solid 2px;border: solid 3px;border-color: #00a65a;" />
                      </div>
                    </div>
					<div class="form-group has-success">
                      <label for="inputPassword3" class="col-sm-2 control-label">Update&nbsp;Image</label>
                      <div class="col-sm-10">
                        <span class="btn btn-default btn-file"><span></span><input type="file" name="image" id="image"/></span>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" id="profile" name="profile" value="profile" class="btn btn-info pull-right">Update Profile</button>
                  </div><!-- /.box-footer --></br>
                {!!Form::close() !!}
              </div><!-- /.box -->
            </div><!--/.col (right) -->
			
			  <!-- right column -->
            <div class="col-md-6" style="border: 1px solid;">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title" style="color:#00a65a;">Change Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->	
				{!! Form::model($edit, ['method' => 'PATCH', 'action' => ['AccountSettingController@update', $edit->id], 'class' => 'form-horizontal']) !!}
				  <div class="box-body">
                    <div class="form-group has-success">
                      <label for="inputEmail3" class="col-sm-2 control-label">Current&nbsp;Password</label></br></br>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="current_password" name="current_password">
                      </div>
                    </div>
                    <div class="form-group has-success">
                      <label for="inputPassword3" class="col-sm-2 control-label">New&nbsp;Password</label></br></br>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                    </div>
					<div class="form-group has-success">
                      <label for="inputPassword3" class="col-sm-2 control-label">Confirm&nbsp;Password</label></br></br>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                      </div>
                    </div></br></br>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" id="PasswordSubmit" name="PasswordSubmit" value="PasswordSubmit" onclick="return verify()"; class="btn btn-info pull-right">Update Password</button>
                  </div><!-- /.box-footer --></br>
                {!!Form::close() !!}
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@stop

@section("scripts")
<script type="text/javascript">
	function verify()
	{
		/*
		var a = document.getElementById("password").value;
		var b = document.getElementById("current_password").value;
		var c = document.getElementById("new_password").value;
		var d = document.getElementById("confirm_password").value;
		
		if(c!=d){
		alert("password not match!");
		}
		
		if(c == "" || d == "")
		alert("Please fill both fields correctly!");
		*/
	}
	
</script>
@stop