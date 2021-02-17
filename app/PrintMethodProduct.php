<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PrintMethodProduct
 *
 * @property int $id PK.
 * @property int $active Boolean value for whether or not the Product-Print Method combo is active.
 * @property string $product_id Foreign key of the id of the Product.
 * @property string $print_method_id Foreign key of the Print Method.
 * @property int $package_count Number of Products in a package (usually shrink-wrapped). *1 indicates "individual"*. *0 indicates "bulk"*
 * @property float|null $imprint_width The width of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If there is a value in this column while the imprint_height column is NULL, then it is likely that this number is a diameter. *A value of 0 means "See Template," -1 means "User Supplied," and -2 means "1/8 in. over actual."*
 * @property float|null $imprint_height The height of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If this is NULL while there is a value in the imprint_width column, then it is likely that number is a diameter.
 * @property float|null $imprint_bleed_wrap_width The width of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means that the product does not have a bleed or wrap imprint area possible. *A value of 0 means "See Template," -1 means "User Supplied," and -2 means "1/8 in. over actual."*
 * @property float|null $imprint_bleed_wrap_height The height of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means either the item is a cup and the wrap width is in the "imprint_bleed_wrap_width" field or the number in that field represents a diameter for a flat item. A NULL in *both* fields means the item does not have a bleed nor wrap imprint area.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PrintMethod $printMethod
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereImprintBleedWrapHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereImprintBleedWrapWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereImprintHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereImprintWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct wherePackageCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct wherePrintMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethodProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrintMethodProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'print_method_product';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

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
     * Product relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
