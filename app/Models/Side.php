<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Side extends Model
{
    use HasFactory;
    protected $fillable = ['section_id', 'side'];

}
