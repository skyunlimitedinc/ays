<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductFeature
 *
 * @property int $id PK.
 *                 Also serves as the priority of the feature/option. The higher the priority, the higher on the list it should appear.
 *                 
 *                 29000s and up: Highest priority stuff.
 *                 28000s: Imprint method count.
 *                 27000s: Individual imprint methods.
 *                     27600-28000: First, main print method detail.
 *                     27300s: Die methods.
 *                 26000s: Ink & color info.
 *                 25000s: “Optional” info.
 *                 10000-12000: Number of colors possible.
 *                 1000-10000: Item-specific info.
 *                     1000-2999: Napkins.
 *                         2000s: Ply count.
 *                         1000s: Other info.
 *                     3000s: Coasters.
 *                     4000s: Drink Stirrers, Food Piks, & Ice Cream Spoons.
 *                     5000s: Plates.
 *                     6000-7999: Cups.
 *                     <1000: Bottom of the list stuff.
 * @property int $active Boolean value for whether or not the Product Feature is active.
 * @property string $feature A feature or option for a Product Line.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductFeaturePivot[] $productFeaturesPivot
 * @property-read int|null $product_features_pivot_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereFeature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductFeature extends Model
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
        return $this->belongsToMany(ProductLine::class)->withTimestamps();
    }

    /**
     * ProductFeaturePivot relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productFeaturesPivot()
    {
        return $this->hasMany(ProductFeaturePivot::class, 'feature_id', 'id');
    }
}
