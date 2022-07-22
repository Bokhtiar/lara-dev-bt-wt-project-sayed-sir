<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CrudTrait;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $table='products';
    protected $primaryKey='product_id';

    protected $fillable = [
        'name',
        'category',
        'images',
        'generic',
        'body',
        'company',
        'sell_price',
        'discount_percentage',
        'sku'
    ];

    public function scopeValidation($value, $request){
        return Validator::make($request, [
            'name' => 'string | required | max:15 | min:3',
            'generic' => 'required',
            'body' => 'required',
            'company' => 'required',
            'sku' => 'required',
        ])->validate();

    }

    public function scopeImages($value, $request){
        $images = array();
       if ($request->hasFile('images')) {
           foreach ($request->images as $key => $photo) {
               $path = $photo->store('/product/photos');
               array_push($images, $path);
           }
       }
       return $images;
   }

    public function scopeFindId($q, $id)
    {
        return self::find($id);
    }

    protected $casts = [
        'sku' => 'array'
    ];


    public function setSkuAttribute($value)
    {
        $sku = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['id'])) {
                $sku[] = $array_item;
            }
        }

        $this->attributes['sku'] = json_encode($sku);
    }

}
