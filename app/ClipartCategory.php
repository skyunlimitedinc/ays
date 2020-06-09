<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClipartCategory extends Model
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
     * Clipart Subcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clipartSubcategories()
    {
        return $this->hasMany(ClipartSubcategory::class);
    }
}
