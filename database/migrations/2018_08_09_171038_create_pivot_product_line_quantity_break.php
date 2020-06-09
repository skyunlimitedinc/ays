<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotProductLineQuantityBreak extends Migration
{
    private $tableName = 'product_line_quantity_break';
    private $tableComment = 'Pivot table for Product Line and Quantity Break.';

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
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Product Line / Quantity combo is active.'
                );
            $table
                ->integer('product_line_id')
                ->unsigned()
                ->comment('Foreign key for the Product Line.');
            $table
                ->integer('quantity_break_id')
                ->unsigned()
                ->comment('Foreign key denoting which Quantity Break to use.');
            $table
                ->float('additional_color_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price for an additional color for the Quantity Break, or NULL if there are no additional color charges for the Product Line.'
                );
            $table
                ->decimal('second_side_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price to imprint the second side of the item, or NULL if the item cannot be printed on a second side.'
                );
            $table
                ->decimal('process_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price for printing using a 4-color process method, or NULL if this Product Line does not charge for 4-color process printing.'
                );
            $table
                ->decimal('bleed_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price for printing full bleed, or NULL if this Product Line does not allow for full bleed printing.'
                );
            $table
                ->decimal('white_ink_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price for printing white ink, or NULL if this Product Line does not allow for white ink printing. Typically only used for Coasters and Beverage Wraps.'
                );
            $table
                ->decimal('hotstamp_charge', 19, 4)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The price for a hotstamp imprint, or NULL if this Product Line does not allow for hotstamping. Typically only used for Coasters and Beverage Wraps.'
                );
            $table->timestamps();

            $table
                ->foreign('product_line_id')
                ->references('id')
                ->on('product_lines')
                ->onUpdate('cascade');
            $table
                ->foreign('quantity_break_id')
                ->references('id')
                ->on('quantity_breaks')
                ->onUpdate('cascade');

            $table->unique(
                ['product_line_id', 'quantity_break_id'],
                'product_line_quantity_break_unique'
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
