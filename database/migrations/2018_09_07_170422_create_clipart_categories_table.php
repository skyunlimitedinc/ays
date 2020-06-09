<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClipartCategoriesTable extends Migration
{
    private $tableName = 'clipart_categories';
    private $tableComment = 'The categories of clipart available.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table
                ->string('id', 45)
                ->primary()
                ->comment('PK. The snake_case name of the Clipart Category.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment('Whether or not the Clipart Category is active.');
            $table
                ->tinyInteger('priority')
                ->default(50)
                ->comment(
                    'The order in which the Clipart Categories should appear. Lower numbers appear before higher numbers.'
                );
            $table->timestamps();

            $table->unique('priority');
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
