<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeTypesTable extends Migration
{
    private $tableName = 'charge_types';
    private $tableComment = 'The type of additional charge that will be used for a Product, Product Line, and/or Quantity Break.';

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
                ->comment(
                    'PK. The unique identifier for this Charge Type in snake_case.'
                );
            $table
                ->string('short_name', 45)
                ->comment(
                    'The snake_case short name which can also be used to identify the Charge Type.'
                );
            $table
                ->string('long_name', 250)
                ->comment(
                    'The long name used to display the Charge Type to the user.'
                );
            $table->timestamps();
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
