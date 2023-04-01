<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search_editor extends Model
{
    use HasFactory;
    protected $fillable = [
        'testimonial_id','search_year','recording_numbers','subjects', 'add_notes',
    ];

    public function testimonial () {
        $this->belongsTo('App\Models\Testimonial');
    }

}
