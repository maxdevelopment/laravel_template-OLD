@if (isset($addresses))
<br />
    @foreach($addresses as $address)
    <div class="row">
        <div class="col-md-4">
            {{ $address['name'] }}
            {{ $address['surname'] }}
        </div>
        <div class="col-md-4">
            {{ $address['address'] }}
            {{ $address['city'] }}
            {{ $address['state'] }}
            {{ $address['zip'] }}
            {{ $address['country'] }}
        </div>
        <div class="col-md-4">
            {{ Form::button('Edit', array("class"=>"btn btn-success btn-xs", "onclick"=>"UpdateDeleteAddressForm(".$address['id'].");")) }}
            {{ Form::button('Delete', array("class"=>"btn btn-danger btn-xs", "onclick"=>"UpdateDeleteAddressForm(".$address['id'].", 'delete');")) }}
        </div>
    </div>
        <hr>
    @endforeach
@endif

{{ Form::button('Add address ', array('class' => 'btn btn-primary btn-xs', 'onclick' => 'ViewAddressForm();')) }}
    <div class="addaddress"></div>