{{ Form::open(array('route' => 'login')) }}

  {{ Form::label('username', 'Username/Email:', array('class' => 'form_label')) }}
  {{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'username')) }}<br />
  
  {{ Form::label('password', 'Password:', array('class' => 'form_label')) }}
  {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'password')) }}<br />
  
  {{ Form::token(), Form::submit('login', array('class' => 'btn btn-default')) }}
{{ Form::close() }}