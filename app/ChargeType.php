<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ChargeType
 *
 * @property string $id PK. The unique identifier for this Charge Type in snake_case.
 * @property string $short_name The snake_case short name which can also be used to identify the Charge Type.
 * @property string $long_name The long name used to display the Charge Type to the user.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AcsCharge[] $acsCharges
 * @property-read int|null $acs_charges_count
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType whereLongName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChargeType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChargeType extends Model
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
     * AcsCharge relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function acsCharges()
    {
        return $this->hasMany(AcsCharge::class);
    }
}
