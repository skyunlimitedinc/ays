<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ClipartCategory
 *
 * @property string $id PK. The snake_case name of the Clipart Category.
 * @property int $active Whether or not the Clipart Category is active.
 * @property int $priority The order in which the Clipart Categories should appear. Lower numbers appear before higher numbers.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ClipartSubcategory[] $clipartSubcategories
 * @property-read int|null $clipart_subcategories_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClipartCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClipartCategory extends Model
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
     * Clipart Subcategory relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clipartSubcategories()
    {
        return $this->hasMany(ClipartSubcategory::class);
    }
}
