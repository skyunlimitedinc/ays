<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Thickness
 *
 * @property string $id PK. The Thickness. Please use snake_case.
 * @property string $long_name The display name of the Thickness. Symbols and spaces allowed.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thickness whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Thickness extends Model
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
     * Product relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
