<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotColorProduct extends Migration
{
    private $tableName = 'color_product';
    private $tableComment = 'Pivot table joining Color and Product. Includes a priority for sorting.';

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
                ->comment(
                    'Foreign Key of the Product in the `products` table.'
                );
            $table
                ->integer('color_id')
                ->unsigned()
                ->comment('Foreign Key of the Color in the `colors` table.');
            $table
                ->tinyInteger('priority')
                ->unsigned()
                ->default(100)
                ->comment(
                    'Priority. Used to display the Colors for a Product in a specific order. Lower numbers are higher in priority, so they should appear before higher (lower-priority) numbers.'
                );
            $table->timestamps();

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade');
            $table
                ->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onUpdate('cascade');

            $table->unique(['product_id', 'color_id'], 'product_color_unique');
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
