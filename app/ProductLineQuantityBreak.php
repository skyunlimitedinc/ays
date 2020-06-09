<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLineQuantityBreak extends Model
{
    public $additional_attributes = ['product_line_quantity'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the combination of ProductLine and QuantityBreak as a string.
     *
     * @return string
     */
    public function getProductLineQuantityAttribute()
    {
        return "{$this->productLine->name} @ {$this->quantityBreak->id}";
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_line_quantity_break';

    /**
     * ProductLine relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productLine()
    {
        return $this->belongsTo(ProductLine::class);
    }

    /**
     * QuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quantityBreak()
    {
        return $this->belongsTo(QuantityBreak::class);
    }

    /**
     * Product relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'acs_prices')
            ->withPivot('price')
            ->withTimestamps();
    }

    /**
     * AcsCharge relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acsCharges()
    {
        return $this->hasMany(AcsCharge::class);
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
