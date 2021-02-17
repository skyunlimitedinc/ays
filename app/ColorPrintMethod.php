<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\ColorPrintMethod
 *
 * @property int $id PK.
 * @property string $print_method_id Foreign key for the Print Method in snake_case.
 * @property int $color_id Foreign key for the Color.
 * @property int $active Boolean value for whether or not the Color and Print Method combination are in active use.
 * @property int $priority Sort priority. Lower-numbered items appear before higher-numbered ones.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Color $colors
 * @property-read \App\PrintMethod $printMethods
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod wherePrintMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorPrintMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ColorPrintMethod extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Print Method relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function printMethods()
    {
        return $this->belongsTo(PrintMethod::class);
    }

    /**
     * Color relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colors()
    {
        return $this->belongsTo(Color::class);
    }
}
