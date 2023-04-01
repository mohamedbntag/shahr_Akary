<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','pre_number_en','pre_number', 'year','pre_number_year','receipt_number',
        'receipt_date', 'favor_name', 'against_name', 'subject',
        'governorate', 'section', 'side', 'start_date', 'end_date',
    ];


    public function user () {
        $this->belongsTo('App\Models\User');
    }

    public function editors () {
        return $this->hasMany('App\Models\Editor');
    }

    public function Search_editor () {
        return $this->hasMany('App\Models\Search_editor');
    }



}
