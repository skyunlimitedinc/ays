<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

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
