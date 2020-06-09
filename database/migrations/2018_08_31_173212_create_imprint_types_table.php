<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImprintTypesTable extends Migration
{
    private $tableName = 'imprint_types';
    private $tableComment = 'The various imprint types available for a Product Line.';

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
                ->comment('PK. The snake_case name of the Imprint Type.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Imprint Type is actively used.'
                );
            $table
                ->string('title', 250)
                ->nullable()
                ->comment(
                    'The name of the Imprint Type. Preferably only 1–5 words. HTML is allowed.'
                );
            $table
                ->text('body')
                ->nullable()
                ->comment(
                    'A description of the Imprint Type. This will make up the body of the note that will be displayed on the web page. HTML structuring allowed.'
                );
            $table
                ->tinyInteger('priority')
                ->default(100)
                ->unique()
                ->comment(
                    'The order in which the Imprint Types should be listed when displayed to the user, from low to high. (Lower numbers appear earlier.)'
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
