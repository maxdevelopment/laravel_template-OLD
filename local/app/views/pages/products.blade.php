@extends('pages.main')

@section('content')
<br />
    @foreach ($products->all() as $product)
    <div class="row">
        <div class="col-md-8">
            <h4>{{ $product['title'] }}</h4>
            <p class="text-justify">{{ $product['description'] }}</p><br />
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#{{ $product['id'] }}">view</button>
            
            
            
        </div>

        <div class="col-md-4">
            {{ HTML::image(Config::get('image.upload_dir').$product['image'], $product['title'], array('class'=>'img-thumbnail')) }}
            <p class="text-right"><mark>от <strong>{{ $product['amount'] }}</strong> руб.</mark></p>
            
            {{ Form::open(array('class' => 'addtocart_'.$product['id'], 'files' => false)) }}
                {{ Form::input('number', 'many') }}
                {{ Form::hidden('product_id', $product['id']) }}
                {{ Form::button('add to cart', array('class' => 'btn btn-success btn-xs', 'onclick' => 'AddToCart('.$product['id'].');')) }}
            {{ Form::token(), Form::close() }}
        </div>
    </div>
    <hr>
    <!-- Modal -->
    <div class="modal fade" id="{{ $product['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{ $product['title'] }}</h4>
          </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        {{ $product['description'] }}
                    </div>
                    <div class="col-md-4">
                        {{ HTML::image(Config::get('image.upload_dir').$product['image'], $product['title'], array('class'=>'img-thumbnail')) }}
                    </div>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    {{ $products->links() }}
@stop