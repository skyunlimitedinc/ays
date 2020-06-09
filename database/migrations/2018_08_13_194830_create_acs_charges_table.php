<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcsChargesTable extends Migration
{
    private $tableName = 'acs_charges';
    private $tableComment = 'Additional Charges for every Product Line and Quantity Break. Acts as a pivot table for ChargeType and ProductLineQuantityBreak.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')->comment('PK.');
            $table
                ->integer('product_line_quantity_break_id')
                ->unsigned()
                ->comment(
                    'The Product Line / Quantity Break foreign key for which an additional Charge will be applied.'
                );
            $table
                ->string('charge_type_id', 45)
                ->comment(
                    'The Charge Type foreign key for the Product Line / Quantity Break combo in snake_case.'
                );
            $table
                ->decimal('amount', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment('The amount of the additional Charge in Decimal format.');
            $table->timestamps();

            $table
                ->foreign('product_line_quantity_break_id')
                ->references('id')
                ->on('product_line_quantity_break')
                ->onUpdate('cascade');
            $table
                ->foreign('charge_type_id')
                ->references('id')
                ->on('charge_types')
                ->onUpdate('cascade');

            $table->unique(
                ['product_line_quantity_break_id', 'charge_type_id'],
                'charge_unique'
            );
        });

        DB::statement(
            "ALTER TABLE {$this->tableName} COMMENT '{$this->tableComment}'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
