<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorType extends Model
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
     * Color relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    /**
     * Product Line relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productLines()
    {
        return $this->belongsToMany(ProductLine::class)->withTimestamps();
    }
}
