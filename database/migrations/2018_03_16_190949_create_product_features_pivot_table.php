<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFeaturesPivotTable extends Migration
{
    private $tableName = 'product_features_pivot';
    private $tableComment = 'Pivot table to reference which items in the Product Features table are parents of other Product Features.';

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
            $table->smallInteger('parent_id')
                ->comment('Foreign key of the id of the parent Product Feature from the same table.');
            $table->smallInteger('feature_id')
                ->comment('Foreign key that represents a sub-feature.');
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')->on('product_features')
                ->onUpdate('cascade');
            $table->foreign('feature_id')
                ->references('id')->on('product_features')
                ->onUpdate('cascade');

            $table->unique(['parent_id', 'feature_id'], 'product_features_pivot_unique');
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
