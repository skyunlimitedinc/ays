<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ColorType
 *
 * @property string $id PK. The snake_case name of the Color Type.
 * @property int $active Boolean value for whether or not the Color Type is active.
 * @property string $long_name The long name of the Color Type. Mostly used for outputting as text to web page.
 * @property int $priority Priority value for sorting the color types. Lower values appear before higher values.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Color[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
