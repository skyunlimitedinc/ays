<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MenuCategory
 *
 * @property string $id The name of the Menu Category. Ties together with the priority column.
 * @property int $active Boolean value for whether or not the Menu Category is active (will be shown).
 * @property string $long_name
 * @property int $priority Grouping and Priority in one column! This is for the navigation list (usually a navbar), with higher numbers appearing later in the list.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductCategory[] $productCategories
 * @property-read int|null $product_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MenuCategory extends Model
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
     * ProductCategory relationship setup.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }
}
