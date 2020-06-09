<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFeaturesTable extends Migration
{
    private $tableName = 'product_features';
    private $tableComment = 'Prioritized list of features for various Products.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('' . $this->tableName . '', function (Blueprint $table) {
            $table->smallInteger('id')->comment('PK.
    Also serves as the priority of the feature/option. The higher the priority, the higher on the list it should appear.

    >=29000s: Highest priority stuff.
    280xx: Imprint method count.
    270xx: Individual imprint methods.
    276xx-279xx: Main print method detail.
    273xx: Die methods.
    260xx: Ink & color info.
    250xx: Other Imprint info.
    240xx: Thickness info.
    230xx: Size info.
    220xx: Shape and die-cut info.
    10xx-99xx: Item-specific info.
        9xxx: Material info.
        6xxx-7xxx: Cups.
        30xx: Wraps/Sleeves.
        25xx: Plates.
        20xx: Drink Stirrers et al.
        15xx: Coasters.
        11xx: Napkins: Ply count.
        10xx: Napkins: Other info.
    <1000: Bottom of the list stuff.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Product Feature is active.'
                );
            $table
                ->string('feature')
                ->comment('A feature or option for a Product Line.');
            $table->timestamps();

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
