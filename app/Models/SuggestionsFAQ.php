<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuggestionsFAQ extends Model
{
    use HasFactory;


    protected $table = 'suggestions_faq';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable=[
        "name",
        "description",
    ];

    protected $hidden=[
        'deleted_at'
    ];

    public function validate($inputs,$create=true) {

        return \Validator::make($inputs, [

        ]);
    }
}
