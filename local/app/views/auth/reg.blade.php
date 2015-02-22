@extends('pages.main')
@section('login_or_user')
    <div class="myform">
        {{ Form::open(array('route' => 'auth')) }}
            {{ Form::label('username', 'User name:', array('class' => 'form_label')) }}
            {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'username')) }} <br />

            {{ Form::label('email', 'E-Mail Address:', array('class' => 'form_label')) }}
            {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'email')) }} <br />

            {{ Form::label('password', 'Password:', array('class' => 'form_label')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'password')) }} <br />
            {{ Form::submit('send', array('class' => 'btn btn-default')) }}
        {{ Form::token(), Form::close() }}
    </div>
    @if ($errors)
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error: </span>
                    {{ $err }}
            </div>
        @endforeach
    @endif
@stop