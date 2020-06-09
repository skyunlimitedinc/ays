<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLine extends Model
{
    public $additional_attributes = ['name'];

    /**
     * Create an accessor to substitute in for the `id`.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->productSubcategory->product_category_id}-{$this
            ->productSubcategory->short_name}-{$this->print_method_id}";
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * ProductSubcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productSubcategory()
    {
        return $this->belongsTo(ProductSubcategory::class);
    }

    /**
     * PrintMethod relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function printMethod()
    {
        return $this->belongsTo(PrintMethod::class);
    }

    /**
     * CouponCode relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

    /**
     * ProductFeature relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productFeatures()
    {
        return $this->belongsToMany(ProductFeature::class)->withTimestamps();
    }

    /**
     * ProductNote relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productNotes()
    {
        return $this->belongsToMany(ProductNote::class)->withTimestamps();
    }

    /**
     * QuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quantityBreaks()
    {
        return $this->belongsToMany(QuantityBreak::class)
            ->withPivot(
                'additional_color_charge',
                'second_side_charge',
                'process_charge',
                'bleed_charge',
                'white_ink_charge',
                'hotstamp_charge'
            )
            ->withTimestamps();
    }

    /**
     * ACS Prices relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function acsPrices()
    {
        return $this->hasManyThrough(
            AcsPrice::class,
            ProductLineQuantityBreak::class
        );
    }

    /**
     * ProductLineQuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLineQuantityBreaks()
    {
        return $this->hasMany(ProductLineQuantityBreak::class);
    }

    /**
     * Color Type relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colorTypes()
    {
        return $this->belongsToMany(ColorType::class)->withTimestamps();
    }

    /**
     * Imprint Type relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function imprintTypes()
    {
        return $this->belongsToMany(ImprintType::class)->withTimestamps();
    }
}
