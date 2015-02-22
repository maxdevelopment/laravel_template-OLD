<?php

class Address extends Eloquent {
    protected $table = 'addresses';
    protected $fillable = array('user_id', 'name', 'surname', 'address', 'city', 'state', 'zip', 'country');
}

