<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial_id','publication_num','publication_year','editor_type',
        'against_name_editor', 'favor_name_editor', 'statement', 'dept', 'notes',
    ];


    public function testimonial () {
        $this->belongsTo('App\Models\Testimonial');
    }



}
