<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ImprintType
 *
 * @property string $id PK. The snake_case name of the Imprint Type.
 * @property int $active Boolean value for whether or not the Imprint Type is actively used.
 * @property string|null $title The name of the Imprint Type. Preferably only 1–5 words. HTML is allowed.
 * @property string|null $body A description of the Imprint Type. This will make up the body of the note that will be displayed on the web page. HTML structuring allowed.
 * @property int $priority The order in which the Imprint Types should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImprintType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImprintType extends Model
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
     * Product Line relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productLines()
    {
        return $this->belongsToMany(ProductLine::class)->withTimestamps();
    }
}
