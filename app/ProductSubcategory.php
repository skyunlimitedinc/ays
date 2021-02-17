<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductSubcategory
 *
 * @property int $id PK.
 * @property int $active Boolean value for whether or not the Product Subcategory is active.
 * @property string $product_category_id The foreign key of the main Product Category to which this Subcategory belongs.
 * @property string $short_name The short name of the Product Subcategory.
 * @property string $long_name The long name of the Product Subcategory.
 * @property string|null $subhead The subheading that typically appears immediately after the `long_name`.
 * @property int $priority The order in which Product Subcategories should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ProductCategory $productCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereSubhead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSubcategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductSubcategory extends Model
{
    /**
     * ProductCategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * ProductLine relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productLines()
    {
        return $this->hasMany(ProductLine::class);
    }

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
