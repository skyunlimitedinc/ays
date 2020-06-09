<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
