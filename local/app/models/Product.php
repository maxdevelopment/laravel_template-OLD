<?php

class Product extends Eloquent {
    protected $table = 'products';
    protected $fillable = array('title', 'description', 'image', 'amount', 'created_at', 'updated_at');
}
