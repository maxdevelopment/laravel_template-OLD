{{ Form::open(array('class' => 'formaddaddress', 'files' => false)) }}
    @if (isset($address))
        {{ Form::hidden('id', $address['id']) }}
    @endif
    
    <div class="row">
        <div class="col-xs-3">
            {{ Form::label('name', 'Name:', array('class' => 'form_label')) }}
            {{ Form::text('name', @$address['name'], array('class' => 'form-control input-sm', 'placeholder' => 'name')) }}
        </div>
        
        <div class="col-xs-3">
            {{ Form::label('surname', 'Surname:', array('class' => 'form_label')) }}
            {{ Form::text('surname', @$address['surname'], array('class' => 'form-control input-sm', 'placeholder' => 'surname')) }}
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4">
            {{ Form::label('address', 'Address:', array('class' => 'form_label')) }}
            {{ Form::text('address', @$address['address'], array('class' => 'form-control input-sm', 'placeholder' => 'address')) }}
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4">
            {{ Form::label('city', 'City:', array('class' => 'form_label')) }}
            {{ Form::text('city', @$address['city'], array('class' => 'form-control input-sm', 'placeholder' => 'city')) }}
        </div>
        <div class="col-xs-2">
            {{ Form::label('state', 'State:', array('class' => 'form_label')) }}
            {{ Form::text('state', @$address['state'], array('class' => 'form-control input-sm', 'placeholder' => 'state')) }}
        </div>    
        <div class="col-xs-2">
            {{ Form::label('zip', 'Zip:', array('class' => 'form_label')) }}
            {{ Form::text('zip', @$address['zip'], array('class' => 'form-control input-sm', 'placeholder' => 'zip')) }}
        </div>    
    </div>    
        
    <div class="row">
        <div class="col-xs-4">    
            {{ Form::label('country', 'Country:', array('class' => 'form_label')) }}
            {{ Form::text('country', @$address['country'], array('class' => 'form-control input-sm', 'placeholder' => 'country')) }}
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-1">
            {{ Form::button('Send', array('class' => 'btn btn-primary btn-xs', 'onclick' => 'AddAddress();')) }}
        </div>
    </div>
    {{ Form::token(), Form::close() }}
    
<div class="erroraddress"></div>