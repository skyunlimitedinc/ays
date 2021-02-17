<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductLine
 *
 * @property int $id PK.
 * @property int $active Boolean value for whether or not the Product Line (Subcategory/Method combination) is active.
 * @property int $product_subcategory_id Foreign key of the Product Subcategory.
 * @property string $print_method_id Foreign key of the Print Method.
 * @property string $coupon_code_id Foreign key to denote the Coupon Code for the Product Line (Subcategory/Method combination).
 * @property int $second_side Boolean value for whether or not the Product Line (Subcategory/Method combo) has a second side that’s printable. (Called “per panel” for offset napkins.)
 * @property int $wrap Boolean value for whether or not the Product Line (Subcategory/Method combo) has the capability to be printed as a wrap (first and second side together).
 * @property int $bleed Boolean value for whether or not the Product Line (Subcategory/Method combo) has the capability to be printed as a bleed.
 * @property int $multicolor Boolean value for whether or not the Product Line (Subcategory/Method combo) can be printed with more than one color. (Digital method irrelevant for determining the “per color” tag.)
 * @property int $process Boolean value for whether or not the Product Line (Subcategory/Method combo) can be printed with 4 Color Process. Typically only for Tradition Print Methods.
 * @property int $white_ink Boolean value for whether or not the Product Line (Subcategory/Method combo) has a White Ink surcharge. Typically only for Digitally-printed Coasters and Beverage Wraps.
 * @property int $hotstamp Boolean value for whether or not the Product Line (Subcategory/Method combo) has a Hotstamp imprint surcharge. Typically only for Coasters and Beverage Wraps.
 * @property int $per_thousand True/False. True if the prices for this Product Line (Subcategory/Method combo) are measured per thousand.
 * @property int $setup_charge Amount to charge for setup.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AcsPrice[] $acsPrices
 * @property-read int|null $acs_prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ColorType[] $colorTypes
 * @property-read int|null $color_types_count
 * @property-read \App\CouponCode $couponCode
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ImprintType[] $imprintTypes
 * @property-read int|null $imprint_types_count
 * @property-read \App\PrintMethod $printMethod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductFeature[] $productFeatures
 * @property-read int|null $product_features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLineQuantityBreak[] $productLineQuantityBreaks
 * @property-read int|null $product_line_quantity_breaks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductNote[] $productNotes
 * @property-read int|null $product_notes_count
 * @property-read \App\ProductSubcategory $productSubcategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\QuantityBreak[] $quantityBreaks
 * @property-read int|null $quantity_breaks_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereBleed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereCouponCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereHotstamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereMulticolor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine wherePerThousand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine wherePrintMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereProductSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereSecondSide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereSetupCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereWhiteInk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLine whereWrap($value)
 * @mixin \Eloquent
 */
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
