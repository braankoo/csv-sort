<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Category extends Model {

    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [ 'name', 'url', 'bookie_id' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
