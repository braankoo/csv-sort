<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model {

    use HasFactory;

    protected $fillable = [ 'category_id', 'first', 'second', 'time', 'final_1', 'final_2', 'draw' ];
}
