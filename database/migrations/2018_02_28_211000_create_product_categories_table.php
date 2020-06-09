<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    private $tableName = 'product_categories';
    private $tableComment = 'Primary Categories that the Products fall under.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->string('id', 45)
                ->comment('PK. The short name of the Product Category.');
            $table->tinyInteger('active')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Category is active.');
            $table->string('long_name', 250)
                ->comment('The long name of the Product Category.');
            $table->text('text_notes')
                ->nullable()
                ->comment('Text notes (if any) that appear below the “Features & Options” list on the Product page.');
            $table->string('menu_category_id', 45)
                ->comment('Foreign key of the name of the Menu Category to which the Product Category belongs.');
            $table->tinyInteger('priority')
                ->comment('The order in which Product Categories should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('menu_category_id')
                ->references('id')->on('menu_categories')
                ->onUpdate('cascade');
            $table->unique(['menu_category_id', 'priority'], 'priority_unique');
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
