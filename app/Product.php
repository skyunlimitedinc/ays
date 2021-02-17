<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property string $id PK. The short name of the Product in snake_case.
 * @property int $active Boolean value for whether or not the Product is active.
 * @property int $product_subcategory_id Foreign key of the Product Subcategory to which this Product belongs.
 * @property string $name The item number (or name) as shown in the catalog WITHOUT the Print Method prefix.
 * @property string $description Description of the Product as shown in the catalog.
 * @property int|null $priority The order in which the Products should appear. Lower numbers appear before higher numbers.
 * @property int $case_quantity Number of Products in a case (or box).
 * @property int $case_weight The weight of the Product case in pounds.
 * @property int $case_dim_weight The "Dimensional Weight" of the Product case in pounds. (Not the _actual_ weight.)
 * @property int $case_length Length of the Product case.
 * @property int $case_width Width of the Product case.
 * @property int $case_height Height of the Product case.
 * @property float|null $dim_top The dimension of the top of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".
 * @property float|null $dim_height The dimension of the height of the Product in inches. NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".
 * @property float|null $dim_base The dimension of the bottom (or base) of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".
 * @property string|null $shape_id The Shape of the Product. Foreign key.
 * @property string|null $thickness_id The Thickness of the Product. Foreign key.
 * @property float|null $area The area in square inches of the Product. Currently used only for shaped items. NULL means the area is not used for the Product.
 * @property float|null $item_width The width of the Product. NULL typically means it is _not_ a flat item. One dimension typically means it is a diameter and often will display as "N/A" (e.g., round Coasters). 0 is "See Template" and -1 is "User Supplied".
 * @property float|null $item_height The height of the Product. NULL typically means it is *not* a flat item. One dimension typically means it is a diameter and often will display as "N/A" (e.g., round Coasters). 0 is "See Template" and -1 is "User Supplied".
 * @property int $pallet_quantity The number of Product cases (boxes) that ship on a single pallet.
 * @property int $pallet_length The length of the pallet in inches when fully loaded with Product cases.
 * @property int $pallet_width The width of the pallet in inches when fully loaded with Product cases.
 * @property int $pallet_height The height of the pallet in inches when fully loaded with Product cases.
 * @property int $pallet_weight The weight of the pallet in pounds when fully loaded with Product cases.
 * @property int|null $class_code The class code of the Product.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AcsPrice[] $acsPrices
 * @property-read int|null $acs_prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Color[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PrintMethod[] $printMethods
 * @property-read int|null $print_methods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLineQuantityBreak[] $productLineQuantityBreaks
 * @property-read int|null $product_line_quantity_breaks_count
 * @property-read \App\ProductSubcategory $productSubcategory
 * @property-read \App\Shape|null $shape
 * @property-read \App\Thickness|null $thickness
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseDimWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCaseWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereItemHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereItemWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePalletHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePalletLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePalletQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePalletWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePalletWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShapeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThicknessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
