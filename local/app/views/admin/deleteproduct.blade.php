@extends('pages.main')

@section('login_or_user')
    @parent
    @include('admin.adminmenu')
@stop

@section('content')
    @foreach ($products->all() as $product)
    <span class="{{ $product['id'] }}">
        <div class="col-md-4">
        <a href="javascript:void(0);" onclick = "EditProduct({{ $product['id']}});">edit</a>
            &nbsp;{{ $product['title'] }}
        </div>
        
        <div class="col-md-4">
        @if($product['isActive'] == 0)
            <a class="bg-danger" href="javascript:void(0);" onclick = "MakeActive({{ $product['id']}});">hide</a>
        @elseif($product['isActive'] == 1)
            <a class="bg-success" href="javascript:void(0);" onclick = "MakeActive({{ $product['id']}});">active</a>
        @endif
        </div>
        
        <div class="col-md-4">
        {{ Form::button('Delete', array("class"=>"btn btn-danger btn-xs", "onclick"=>"DeleteProduct(".$product['id'].");")) }}
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="edit_place"></div>
            </div>
        </div>
    </span>    
    @endforeach
@stop