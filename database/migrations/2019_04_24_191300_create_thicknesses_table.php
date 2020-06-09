<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThicknessesTable extends Migration
{
    private $tableName = 'thicknesses';
    private $tableComment = 'The possible Thickness values for the specifications of a Product.';

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
                ->comment('PK. The Thickness. Please use snake_case.');
            $table
                ->string('long_name', 250)
                ->comment(
                    'The display name of the Thickness. Symbols and spaces allowed.'
                );
            $table->timestamps();

            // Set the table's Primary Key.
            $table->primary('id');
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
