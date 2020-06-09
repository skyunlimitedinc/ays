<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotColorTypeProductLine extends Migration
{
    private $tableName = 'color_type_product_line';
    private $tableComment = 'Pivot table for Color Type and Product Line.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Define the table.
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')
                ->comment('PK.');
            $table->integer('product_line_id')
                ->unsigned()
                ->comment('Foreign key to the Product Line.');
            $table->string('color_type_id', 45)
                ->comment('Foreign key to the Color Type.');
            $table->timestamps();

            // Add foreign key constraints.
            $table
                ->foreign('product_line_id')
                ->references('id')
                ->on('product_lines')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('color_type_id')
                ->references('id')
                ->on('color_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add a unique constraint on the two foreign keys.
            $table->unique(
                ['product_line_id', 'color_type_id'],
                'color_type_product_line_unique'
            );
        });

        // Add a description to the table.
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
