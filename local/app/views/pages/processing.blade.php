<?php
$sum = (float)0;
?>
hello
@foreach ($products as $product)
<div class="row">
    <div class="col-md-6"><h4>{{ $product['title'] }}</h4></div>
    <div class="col-md-6"><h4>{{ $product['amount'] }} руб. x {{ $product['count'] }} = {{ $product['sum'] }}</h4></div>
    <?php $sum = $sum + $product['sum']; ?>
</div>
<hr>
@endforeach

<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <h3>Total price: {{ $sum }} руб.</h3>
    </div>
</div>

<div class="row">
@if (!Auth::check())
    <h3><p class="text-uppercase text-center bg-info">you need enter to select address</p></h3>
@else
<br />
    @if ((User::find(Auth::id())->addresses->count()) > 0)
        @foreach (User::find(Auth::id())->addresses as $address)
            <?php $addr[] = $address['name'].' '.$address['surname'].' '.$address['address'].' '.$address['city'].' '.$address['state'].' '.$address['zip'].' '.$address['country']; ?>
        @endforeach
        <div class="col-xs-6">
            Shipping address: {{ Form::select('name', $addr, 'key', array('class' => 'form-control')) }}
        </div>
    @else
        <p class="text-center">{{ Form::button('Please, add address!', array('class' => 'btn btn-warning', 'onclick' => 'ViewAddress();')) }}</p>
    @endif
@endif
</div>
    <br />
<div class="row">
    <div class="col-md-6">
        {{ Form::button('Back', array('class' => 'btn btn-primary', 'onclick' => 'ViewCart();')) }}
    </div>
    <div class="col-md-6 text-right">
        {{ Form::button('Send to Merchant Account', array('class' => 'btn btn-default')) }}
    </div>
</div>