<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
