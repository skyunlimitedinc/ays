<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFeatureProductLineTable extends Migration
{
    private $tableName = 'product_feature_product_line';
    private $tableComment = 'Pivot table for Product Lines and Product Features';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('' . $this->tableName . '', function (Blueprint $table) {
            $table->increments('id')
                ->comment('PK.');
            $table->integer('product_line_id')
                ->unsigned()
                ->comment('Foreign key of the Product Line joining table.');
            $table->smallInteger('product_feature_id')
                ->comment('Foreign key of a Feature/Option associated with the Product Line.');
            $table->timestamps();

            $table->foreign('product_line_id')
                ->references('id')->on('product_lines')
                ->onUpdate('cascade');
            $table->foreign('product_feature_id')
                ->references('id')->on('product_features')
                ->onUpdate('cascade');

            $table->unique(['product_line_id', 'product_feature_id'], 'feature_line_unique');
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
