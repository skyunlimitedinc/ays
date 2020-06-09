<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubcategoriesTable extends Migration
{
    private $tableName = 'product_subcategories';
    private $tableComment = 'Secondary Categories under which the Products fall.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')
                ->comment('PK.');
            $table->tinyInteger('active')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Subcategory is active.');
            $table->string('product_category_id', 45)
                ->comment('The foreign key of the main Product Category to which this Subcategory belongs.');
            $table->string('short_name', 45)
                ->comment('The short name of the Product Subcategory.');
            $table->string('long_name', 250)
                ->comment('The long name of the Product Subcategory.');
            $table->tinyInteger('priority')
                ->comment('The order in which Product Subcategories should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)');
            $table->timestamps();

            $table->foreign('product_category_id')
                ->references('id')->on('product_categories')
                ->onUpdate('cascade');
            $table->unique(['product_category_id', 'short_name'], 'product_subcategories_unique');
            $table->unique(['product_category_id', 'priority'], 'priority_unique');
        });

        DB::statement("ALTER TABLE {$this->tableName} COMMENT '{$this->tableComment}'");
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
