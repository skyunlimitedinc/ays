<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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
     * MenuCategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    /**
     * ProductSubcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }
}
