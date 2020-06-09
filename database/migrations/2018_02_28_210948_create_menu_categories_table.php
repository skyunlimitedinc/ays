<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCategoriesTable extends Migration
{
    private $tableName = 'menu_categories';
    private $tableComment = 'Primary menu item names and their order.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->string('id', 45)
                ->comment('The short name of the Menu Category. Ties together with the priority column.');
            $table->tinyInteger('active')
                ->default(1)
                ->comment('Boolean value for whether or not the Menu Category is active (will be shown).');
            $table->string('long_name', 250)
                ->comment('The long name of the Menu Category. i.e., “Stirrers & Piks”.');
            $table->tinyInteger('priority')
                ->comment('Grouping and Priority in one column! This is for the navigation list (usually a navbar), with higher numbers appearing later in the list.');
            $table->timestamps();

            $table->primary('id');
            $table->unique('priority');
        });

        DB::statement("ALTER TABLE {$this->tableName} COMMENT '{$this->tableComment}'");
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
