<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ClipartSubcategory
 *
 * @property string $id PK. The snake_case name of the Clipart Subcategory. Doubles as the local folder name where the actual clipart resides.
 * @property int $active Whether or not the Clipart Subcategory is active.
 * @property string $clipart_category_id The Clipart Category to which this Subcategory belongs. Foreign key.
 * @property string $long_name The displayed name for the Clipart Subcategory, complete with spaces and capitalization.
 * @property int $priority The order in which the Clipart Subcategories should appear. Lower numbers appear before higher numbers.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ClipartCategory $clipartCategory
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereClipartCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartSubcategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClipartSubcategory extends Model
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
     * Clipart Category relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clipartCategory()
    {
        return $this->belongsTo(ClipartCategory::class);
    }
}
