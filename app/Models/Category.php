<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\CrudTrait;

class Category extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $table='categories';
    protected $primaryKey='category_id';

    protected $fillable = [
        'category_id',
        'name',
        'image'
    ];

    public function scopeValidation($value, $request){
        return Validator::make($request, [
            'name' => 'string | required | max:15 | min:3',
        ])->validate();

    }

    public function scopeImage($value, $request){
        $image=$request->file('image');
            if ($image){
            $image_name=Str::random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='category/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
                if ($success) {
                    return $image_url;
                    }
                }
    }


    public function scopeFindId($q, $id)
    {
        return self::find($id);
    }
}
