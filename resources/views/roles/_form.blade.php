<div class="form-group">
	{!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
		{!! Form::text('name', null, ['id' => 'name', 'class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
		{!! Form::text('address', null, ['id' => 'address','class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('phone', 'Phone', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
		{!! Form::text('phone', null, ['id' => 'phone','class'=>'form-control']) !!}
	</div>
</div><div class="form-group">
	{!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
		{!! Form::text('email', null, ['id' => 'email','class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
	<input type="password" id="password" name="password" style="width: 529px; height: 34px; border: 1px solid #ccc;">
	</div>
</div>
<!-- <div class="form-group">
	{!! Form::label('image', 'Upload Image', ['class' => 'col-md-4 control-label']) !!} 
	<div class="col-md-6">
		<input type="file" name="image" id="image" style="border: 1px solid;border-color: #d2d6de;;border-radius: 5px;">
	</div>
</div> -->
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit($submitbutton, ['class' => 'btn btn-primary']) !!}
	</div>
</div>
							
							


						
						