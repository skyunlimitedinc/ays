<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

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
