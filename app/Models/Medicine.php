<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\CrudTrait;


class Medicine extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $table='medicines';
    protected $primaryKey='medicine_id';

    protected $fillable = [
        'medicine_id',
        'category_id',
        'category_name',
        'name',
        'generic',
        'body',
        'company'
    ];

    public function scopeValidation($value, $request){
        return Validator::make($request, [
            'name' => 'string | required | max:15 | min:3',
            'category_id' => 'required',
            'generic' => 'required',
            'body' => 'required',
            'company' => 'required'
        ])->validate();

    }

    public function scopeFindId($q, $id)
    {
        return self::find($id);
    }
}
