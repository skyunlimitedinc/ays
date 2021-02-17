<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcsCharge
 *
 * @property int $id PK.
 * @property int $product_line_quantity_break_id The Product Line / Quantity Break foreign key for which an additional Charge will be applied.
 * @property string $charge_type_id The Charge Type foreign key for the Product Line / Quantity Break combo in snake_case.
 * @property string|null $amount The amount of the additional Charge in Decimal format.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ChargeType $chargeType
 * @property-read \App\ProductLineQuantityBreak $productLineQuantityBreak
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereChargeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereProductLineQuantityBreakId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcsCharge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcsCharge extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * ChargeType relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chargeType()
    {
        return $this->belongsTo(ChargeType::class);
    }

    /**
     * ProductLineQuantityBreak relationship setup.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productLineQuantityBreak()
    {
        return $this->belongsTo(ProductLineQuantityBreak::class);
    }
}
