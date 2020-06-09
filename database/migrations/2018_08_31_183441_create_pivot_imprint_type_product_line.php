<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotImprintTypeProductLine extends Migration
{
    private $tableName = 'imprint_type_product_line';
    private $tableComment = 'Pivot table for which Imprint Types go with which Product Lines.';

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
                ->integer('product_line_id')
                ->unsigned()
                ->comment('FK. Product Line.');
            $table->string('imprint_type_id', 45)->comment('FK. Imprint Type.');
            $table->timestamps();

            // Add foreign key constraints.
            $table
                ->foreign('product_line_id')
                ->references('id')
                ->on('product_lines')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('imprint_type_id')
                ->references('id')
                ->on('imprint_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(
                ['product_line_id', 'imprint_type_id'],
                'product_line_imprint_type_unique'
            );
        });

        // Add a description/comment to the table.
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
