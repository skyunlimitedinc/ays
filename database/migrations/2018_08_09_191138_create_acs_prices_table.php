<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcsPricesTable extends Migration
{
    private $tableName = 'acs_prices';
    private $tableComment = 'Combines Product and ProductLineQuantityBreak to create a tertiary pivot table, along with the pricing for each combination thereof.';

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
                ->string('product_id', 45)
                ->comment('Foreign key of the Product.');
            $table
                ->integer('product_line_quantity_break_id')
                ->unsigned()
                ->comment(
                    'Foreign key of the combined Product Line and Quantity Break.'
                );
            $table
                ->decimal('price', 19, 4)
                ->unsigned()
                ->default(0)
                ->comment(
                    'The price for a particular item (Product, Product Line, and Quantity Break.'
                );
            $table->timestamps();

            $table->unique(
                ['product_id', 'product_line_quantity_break_id'],
                'product_quantity_unique'
            );

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade');
            $table
                ->foreign('product_line_quantity_break_id')
                ->references('id')
                ->on('product_line_quantity_break')
                ->onUpdate('cascade');
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
