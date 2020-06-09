<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    private $tableName = 'colors';
    private $tableComment = 'Defines _all_ of the Colors available';

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
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Color is active.'
                );
            $table
                ->string('color_type_id', 45)
                ->comment(
                    'Foreign key to denote what type of Color this is (Product, Standard Ink, Foil, etc.).'
                );
            $table
                ->string('short_name', 45)
                ->comment(
                    'The name of the Color. This is mostly used for the small swatches on the Product page. *THERE MAY BE MULTIPLE ENTRIES WITH THE SAME COLOR NAME.* This means that different manufacturers make the same color, but they have different shades. The differentiator will be the closest equivalent Pantone match, which is in the “pantone” column.'
                );
            $table
                ->string('long_name', 250)
                ->comment('The full name of the Color.');
            $table
                ->string('pantone', 32)
                ->nullable()
                ->comment(
                    'The Pantone equivalent to the color name. This will vary from manufacturer to manufacturer.'
                );
            $table
                ->string('hex', 6)
                ->nullable()
                ->comment(
                    'The six-character hexadecimal color code used to represent the color on screen. Mainly used for color swatches.'
                );
            $table->timestamps();

            $table
                ->foreign('color_type_id')
                ->references('id')
                ->on('color_types')
                ->onUpdate('cascade');
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
