<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductLineQuantityBreak
 *
 * @property int $id PK.
 * @property int $active Boolean value for whether or not the Product Line / Quantity combo is active.
 * @property int $product_line_id Foreign key for the Product Line.
 * @property int $quantity_break_id Foreign key denoting which Quantity Break to use.
 * @property string|null $additional_color_charge The price for an additional color for the Quantity Break, or NULL if there are no additional color charges for the Product Line.
 * @property string|null $second_side_charge The price to imprint the second side of the item, or NULL if the item cannot be printed on a second side.
 * @property string|null $process_charge The price for printing using a 4-color process method, or NULL if this Product Line does not charge for 4-color process printing.
 * @property string|null $bleed_charge The price for printing full bleed, or NULL if this Product Line does not allow for full bleed printing.
 * @property string|null $white_ink_charge The price for printing white ink, or NULL if this Product Line does not allow for white ink printing. Typically only used for Coasters and Beverage Wraps.
 * @property string|null $hotstamp_charge The price for a hotstamp imprint, or NULL if this Product Line does not allow for hotstamping. Typically only used for Coasters and Beverage Wraps.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AcsCharge[] $acsCharges
 * @property-read int|null $acs_charges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AcsPrice[] $acsPrices
 * @property-read int|null $acs_prices_count
 * @property-read string $product_line_quantity
 * @property-read \App\ProductLine $productLine
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\QuantityBreak $quantityBreak
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereAdditionalColorCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereBleedCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereHotstampCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereProcessCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereProductLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereQuantityBreakId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereSecondSideCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLineQuantityBreak whereWhiteInkCharge($value)
 * @mixin \Eloquent
 */
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
