<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotPrintMethodProduct extends Migration
{
    private $tableName = 'print_method_product';
    private $tableComment = 'Pivot table for Product Lines and Product Features.';

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
                    'Boolean value for whether or not the Product-Print Method combo is active.'
                );
            $table
                ->string('product_id', 45)
                ->comment('Foreign key of the id of the Product.');
            $table
                ->string('print_method_id', 45)
                ->comment('Foreign key of the Print Method.');
            $table
                ->smallInteger('package_count')
                ->unsigned()
                ->comment(
                    'Number of Products in a package (usually shrink-wrapped). *1 indicates "individual"*. *0 indicates "bulk"*'
                );
            $table
                ->float('imprint_width', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The width of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If there is a value in this column while the imprint_height column is NULL, then it is likely that this number is a diameter. *A value of 0 means "See Template."*'
                );
            $table
                ->float('imprint_height', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The height of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If this is NULL while there is a value in the imprint_width column, then it is likely that number is a diameter.'
                );
            $table
                ->float('imprint_bleed_wrap_width', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The width of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means that the product does not have a bleed or wrap imprint area possible. *A value of 0 means "See Template."*'
                );
            $table
                ->float('imprint_bleed_wrap_height', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The height of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means either the item is a cup and the wrap width is in the "imprint_bleed_wrap_width" field or the number in that field represents a diameter for a flat item. A NULL in *both* fields means the item does not have a bleed nor wrap imprint area.'
                );
            $table->timestamps();

            $table
                ->foreign('print_method_id')
                ->references('id')
                ->on('print_methods')
                ->onUpdate('cascade');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade');

            $table->unique(
                ['print_method_id', 'product_id'],
                'product_method_unique'
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
