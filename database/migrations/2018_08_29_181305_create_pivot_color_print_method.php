<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotColorPrintMethod extends Migration
{
    private $tableName = 'color_print_method';
    private $tableComment = 'Pivot table associating each actual Color with a given Print Method.';

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
                ->string('print_method_id', 45)
                ->comment('Foreign key for the Print Method in snake_case.');
            $table
                ->integer('color_id')
                ->unsigned()
                ->comment('Foreign key for the Color.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Color and Print Method combination are in active use.'
                );
            $table
                ->tinyInteger('priority')
                ->unsigned()
                ->default(100)
                ->comment(
                    'Sort priority. Lower-numbered items appear before higher-numbered ones.'
                );
            $table->timestamps();

            // Set Primary Key (in this case, composite keys).
//            $table->primary(['print_method_id', 'color_id']);

            // Add Foreign Key constraints.
            $table
                ->foreign('print_method_id')
                ->references('id')
                ->on('print_methods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Add a unique constraint for the foreign key fields.
            $table->unique(
                ['print_method_id', 'color_id'],
                'color_print_method_unique'
            );
        });

        // Add a table comment.
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
