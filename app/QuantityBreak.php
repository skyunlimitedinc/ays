<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuantityBreak
 *
 * @property int $id PK. Quantity breakpoint.
 * @property int $active Boolean value for whether or not the Quantity Break is active.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuantityBreak whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuantityBreak extends Model
{
    /**
     * Indicates if the primary key is an auto-incrementing integer.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * ProductLine relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productLines()
    {
        return $this->belongsToMany(ProductLine::class)
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
}
