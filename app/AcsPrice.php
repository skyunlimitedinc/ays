<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcsPrice
 *
 * @property int $id PK.
 * @property string $product_id Foreign key of the Product.
 * @property int $product_line_quantity_break_id Foreign key of the combined Product Line and Quantity Break.
 * @property string $price The price for a particular item (Product, Product Line, and Quantity Break.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @property-read \App\ProductLineQuantityBreak $productLineQuantityBreak
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice whereProductLineQuantityBreakId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcsPrice extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Product relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * ProductLineQuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productLineQuantityBreak()
    {
        return $this->belongsTo(ProductLineQuantityBreak::class);
    }
}
