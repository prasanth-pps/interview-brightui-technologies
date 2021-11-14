<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id', 'product_name', 'product_category', 'product_model', 'selling_price', 'cost_price', 'gst', 'cgst', 'sgst', 'product_description', 'created_at', 'updated_at','status'
    ];


    public function productcategory()
    {
        return $this->belongsTo('App\Models\ProductCategory','product_category');
    }

    public function productmodel()
    {
        return $this->belongsTo('App\Models\ProductModel','product_model');
    }

    public function productfile()
    {
        return $this->hasOne('App\Models\ProductFile','product_id','id')->orderBy('id');
    }

}
