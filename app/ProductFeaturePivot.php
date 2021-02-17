<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductFeaturePivot
 *
 * @property int $id PK.
 * @property int $parent_id Foreign key of the id of the parent Product Feature from the same table.
 * @property int $feature_id Foreign key that represents a sub-feature.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeaturePivot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductFeaturePivot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_features_pivot';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function productFeatures()
    {
        $this->belongsTo(ProductFeature::class);
    }
}
