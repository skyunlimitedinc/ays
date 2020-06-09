<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
     * Product Subcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productSubcategory()
    {
        return $this->belongsTo(ProductSubcategory::class);
    }

    /**
     * Shape relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }

    /**
     * Thickness relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thickness()
    {
        return $this->belongsTo(Thickness::class);
    }

    /**
     * Print Method relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function printMethods()
    {
        return $this->belongsToMany(PrintMethod::class)
            ->withPivot(
                'imprint_width',
                'imprint_height',
                'imprint_bleed_wrap_width',
                'imprint_bleed_wrap_height'
            )
            ->withTimestamps();
    }

    /**
     * Color relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class)
            ->withPivot('priority')
            ->withTimestamps();
    }

    /**
     * ProductLineQuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productLineQuantityBreaks()
    {
        return $this->belongsToMany(
            ProductLineQuantityBreak::class,
            'acs_prices'
        )
            ->withPivot('price')
            ->withTimestamps();
        //            ->orderBy('priority', 'asc');
    }

    /**
     * AcsPrice relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acsPrices()
    {
        return $this->hasMany(AcsPrice::class);
    }
}
