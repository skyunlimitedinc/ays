<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantityBreaksTable extends Migration
{
    private $tableName = 'quantity_breaks';
    private $tableComment = 'All of the various Quantity Breaks used for pricing purposes. Mostly needed as an ENUM of sorts, and used in the pricing table of the Product page.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table
                ->integer('id')
                ->unsigned()
                ->primary()
                ->comment('PK. Quantity breakpoint.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Quantity Break is active.'
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
