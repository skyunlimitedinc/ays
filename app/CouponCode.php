<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    /**
     * Indicates if the primary key is an auto-incrementing integer.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Defines the data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * ProductLine relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLines()
    {
        return $this->hasMany(ProductLine::class);
    }
}
