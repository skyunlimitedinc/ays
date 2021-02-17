<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Color
 *
 * @property int $id PK.
 * @property int $active Boolean value for whether or not the Color is active.
 * @property string $color_type_id Foreign key to denote what type of Color this is (Product, Standard Ink, Foil, etc.).
 * @property string $short_name The name of the Color. This is mostly used for the small swatches on the Product page. *THERE MAY BE MULTIPLE ENTRIES WITH THE SAME COLOR NAME.* This means that different manufacturers make the same color, but they have different shades. The differentiator will be the closest equivalent Pantone match, which is in the “pantone” column.
 * @property string $long_name The full name of the Color.
 * @property string|null $pantone The Pantone equivalent to the color name. This will vary from manufacturer to manufacturer.
 * @property string|null $hex The six-character hexadecimal color code used to represent the color on screen. Mainly used for color swatches.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ColorType $colorType
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PrintMethod[] $printMethods
 * @property-read int|null $print_methods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereColorTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color wherePantone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    public $additional_attributes = ['name'];

    /**
     * Accessor which combines the `ColorType` and `long_name` into a db-friendly name
     *
     * @return string The db-friendly name combination of the ColorType and long_name
     */
    public function getNameAttribute()
    {
        return $this->color_type_id .
            '_' .
            strtolower(
                str_replace(
                    [' / ', ' ', '*', '(', ')'],
                    ['_', '_', '', '', ''],
                    $this->long_name . '_' . $this->pantone
                )
            );
    }

    /**
     * Color Type relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorType()
    {
        return $this->belongsTo(ColorType::class);
    }

    /**
     * Product relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('priority')
            ->withTimestamps();
    }

    /**
     * Print Method relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function printMethods()
    {
        return $this->belongsToMany(PrintMethod::class)->using(
            ColorPrintMethod::class
        );
    }
}
