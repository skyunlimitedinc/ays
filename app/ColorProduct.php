<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ColorProduct
 *
 * @property int $id PK.
 * @property string $product_id Foreign Key of the Product in the `products` table.
 * @property int $color_id Foreign Key of the Color in the `colors` table.
 * @property int $priority Priority. Used to display the Colors for a Product in a specific order. Lower numbers are higher in priority, so they should appear before higher (lower-priority) numbers.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Color $color
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ColorProduct extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'color_product';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Color relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
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
