<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PrintMethod
 *
 * @property string $id PK. The short name of the Print Method in snake_case. i.e., “tradition”.
 * @property int $active Boolean value for whether or not the Print Method is active.
 * @property string|null $hex Hexadecimal representing the color associated with the Print Method.
 * @property string|null $long_name The long name of the Print Method. i.e., “American Traditions”.
 * @property string|null $prefix The prefix used in combination with the id of a Product.
 * @property string|null $short_description A short, one-sentence description of the Print Method.
 * @property string|null $long_description A long description of the Print Method; generally one paragraph in length.
 * @property int $priority The order in which Print Methods should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Color[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrintMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrintMethod extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(
                'imprint_width',
                'imprint_height',
                'imprint_bleed_wrap_width',
                'imprint_bleed_wrap_height'
            )
            ->withTimestamps();
    }

    /**
     * Color relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class)->using(
            ColorPrintMethod::class
        );
    }
}
