<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggestions extends Model
{
    use HasFactory;


    protected $table = 'suggestions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable=[
        "fio",
        "user_id",
        "category_id",
        "status_id",
        "premium",
        "oneself",
        "economy",
        "subdivision_id",
        "description",
        "file_name",
    ];

    protected $hidden=[
        'deleted_at'
    ];

    public function validate($inputs,$create=true) {

        return \Validator::make($inputs, [

        ]);
    }


    public function category()
    {
        return $this->hasOne(SuggestionsCategory::class, 'id','category_id');
    }

    public function status()
    {
        return $this->hasOne(SuggestionsStatus::class, 'id','status_id');
    }

    public function subdivision()
    {
        return $this->hasOne(SuggestionsSubdivision::class, 'id','subdivision_id');
    }




}
