<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotProductLineProductNote extends Migration
{
    private $tableName = 'product_line_product_note';
    private $tableComment = 'Pivot table for Product Lines and Product Notes';

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
                ->comment('Foreign key of the Product Line joining table.');
            $table
                ->string('product_note_id', 45)
                ->comment(
                    'Foreign key of the Product Note associated with the Product Line.'
                );
            $table->timestamps();

            $table
                ->foreign('product_line_id')
                ->references('id')
                ->on('product_lines')
                ->onUpdate('cascade');
            $table
                ->foreign('product_note_id')
                ->references('id')
                ->on('product_notes')
                ->onUpdate('cascade');

            $table->unique(
                ['product_line_id', 'product_note_id'],
                'line_note_unique'
            );
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
