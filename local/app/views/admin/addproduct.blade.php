@extends('pages.main')

@section('login_or_user')
    @parent
    @include('admin.adminmenu')
@stop

@section('content')
<h2>Add Products</h2>
    {{ Form::open(array('class' => 'addproduct', 'files' => true)) }}
        {{ Form::label('title', 'Product title:', array('class' => 'form_label')) }}
        {{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'product title')) }} <br />

        {{ Form::label('description', 'Product description:', array('class' => 'form_label')) }}
        {{ Form::textarea('description', '', array('name'=>'editor1', 'id'=>'editor1', 'class' => 'form-control', 'placeholder' => 'description')) }} <br />
        <script type="text/javascript">
            CKEDITOR.replace( 'editor1' );
        </script>

        {{ Form::label('amount', 'Product amount:', array('class' => 'form_label')) }}
        {{ Form::text('amount', '', array('class' => 'form-control', 'placeholder' => 'amount')) }} <br />

        {{ Form::label('image', 'Product image:', array('class' => 'form_label')) }}
        {{ Form::file('image') }} <br />
        {{ Form::button('Send', array('class' => 'btn btn-default', 'onclick' => 'AddProduct();')) }}
    {{ Form::token(), Form::close() }}
@stop