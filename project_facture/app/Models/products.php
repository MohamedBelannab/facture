<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $fillable = ['Product_name' , 'section_id' , 'description'];

    public function section()
    {
        return $this->belongsTo('App\Models\section');
    }
}
