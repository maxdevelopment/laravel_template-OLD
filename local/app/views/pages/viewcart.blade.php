<?php
$sum = (float)0;
?>
@foreach ($products as $product)
<div class="row">
    <div class="col-md-8">
        <ul class="list-inline">
            <li>{{ $product['title'] }}</li>
            <li>{{ HTML::image(Config::get('image.upload_dir').$product['image'], $product['title']) }}</li>
            <li><mark>{{ $product['amount'] }} руб.</mark></li>
        </ul>   
    </div>
    <div class="col-md-4">
        <div class="row"><br /><br />
            <div class="row">
                {{ Form::open(array('class' => 'changecounter_'.$product['id'], 'files' => false)) }}
                    {{ Form::hidden('id', $product['id']) }}
                    <div class="col-xs-4">
                        {{ Form::input('number', 'many', $product['count'], array('class' => 'form-control')) }}
                    </div>
                    {{ Form::button("Update", array("class" => "btn btn-success btn-xs", "onclick" => "ChangeCounter(".$product['id'].");")) }}
                    {{ Form::button("Delete", array("class" => "btn btn-danger btn-xs", "onclick" => "ChangeCounter(".$product['id'].",'delete');")) }}
                {{ Form::token(), Form::close() }}
            </div>
            <?php $sum = $sum + $product['sum']; ?>
            <div class="row">
                Total: {{ $product['sum'] }} руб.
            </div>
        </div>
    </div>
</div>
<hr>
@endforeach
<div class="row">
    <div class="col-md-6 col-md-offset-3"><mark>Total price: {{ $sum }} руб.</mark></div>
    {{ Form::button('Processing', array('class' => 'btn btn-primary', 'onclick' => 'Processing();')) }}
</div>