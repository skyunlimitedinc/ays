<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClipartSubcategoriesTable extends Migration
{
    private $tableName = 'clipart_subcategories';
    private $tableComment = 'The various Clipart Subcategories available, tied to Clipart Categories.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            // Define the table.
            $table
                ->string('id', 250)
                ->primary()
                ->comment(
                    'PK. The snake_case name of the Clipart Subcategory. Doubles as the local folder name where the actual clipart resides.'
                );
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment('Whether or not the Clipart Subcategory is active.');
            $table
                ->string('clipart_category_id', 45)
                ->comment(
                    'The Clipart Category to which this Subcategory belongs. Foreign key.'
                );
            $table
                ->string('long_name', 250)
                ->default('Unnamed')
                ->comment(
                    'The displayed name for the Clipart Subcategory, complete with spaces and capitalization.'
                );
            $table
                ->tinyInteger('priority')
                ->default(50)
                ->comment(
                    'The order in which the Clipart Subcategories should appear. Lower numbers appear before higher numbers.'
                );
            $table->timestamps();

            // Make the `priority` field unique.
            $table->unique(
                ['priority', 'clipart_category_id'],
                'category_priority_unique'
            );

            // Link this table to `clipart_categories`.
            $table
                ->foreign('clipart_category_id')
                ->references('id')
                ->on('clipart_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // Add a table comment/description.
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
