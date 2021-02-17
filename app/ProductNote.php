<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductNote
 *
 * @property string $id The short name of the text note.
 * @property int $active Boolean value for whether or not the Note is active.
 * @property string|null $title The title of the note. Preferably only 1–5 words. HTML is allowed.
 * @property string|null $body The body of the note that will be displayed on the web page, with HTML structuring.
 * @property int $priority The order in which Notes should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductLine[] $productLines
 * @property-read int|null $product_lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductNote extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productLines()
    {
        return $this->belongsToMany(ProductLine::class)->withTimestamps();
    }
}
