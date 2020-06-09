<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
