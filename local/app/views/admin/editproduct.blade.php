{{ Form::open(array('class' => 'addproduct', 'files' => true)) }}
    {{ Form::hidden('id', $product['id']);}}
    {{ Form::label('title', 'Product title:', array('class' => 'form_label')) }}
    {{ Form::text('title', $product['title'], array('class' => 'form-control', 'placeholder' => 'product title')) }} <br />
    
    {{ Form::label('description', 'Product description:', array('class' => 'form_label')) }}
    {{ Form::textarea('description', $product['description'], array('name'=>'editor1', 'id'=>'editor1', 'class' => 'form-control', 'placeholder' => 'description')) }} <br />
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1' );
    </script>
    
    
    {{ Form::label('amount', 'Product amount:', array('class' => 'form_label')) }}
    {{ Form::text('amount', $product['amount'], array('class' => 'form-control', 'placeholder' => 'amount')) }} <br />
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('image', 'Product image:', array('class' => 'form_label')) }}
            {{ Form::file('image') }} <br />
            {{ Form::button('Send', array('class' => 'btn btn-default', 'onclick' => 'AddProduct();')) }}
        </div>
        <div class="col-md-6">
            {{ HTML::image(Config::get('image.upload_dir').$product['image'], $product['title'], array('class'=>'img-thumbnail')) }}
        </div>
    </div>
{{ Form::token(), Form::close() }}