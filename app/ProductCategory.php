<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductCategory
 *
 * @property string $id PK. The short name of the Product Category.
 * @property int $active Boolean value for whether or not the Product Category is active.
 * @property string $long_name The long name of the Product Category.
 * @property string|null $text_notes Text notes (if any) that appear below the “Features & Options” list on the Product page.
 * @property string $menu_category_id Foreign key of the name of the Menu Category to which the Product Category belongs.
 * @property int $priority The order in which Product Categories should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\MenuCategory $menuCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductSubcategory[] $productSubcategories
 * @property-read int|null $product_subcategories_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTextNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCategory extends Model
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
     * MenuCategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    /**
     * ProductSubcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productSubcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }
}
