<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductSpecsFor2019 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table
                ->float('dim_top', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The dimension of the top of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".'
                )
                ->change();
            $table
                ->float('dim_height', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The dimension of the height of the Product in inches. NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".'
                )
                ->change();
            $table
                ->float('dim_base', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The dimension of the bottom (or base) of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item and often will display as "N/A"; see `item_width` and `item_height`. 0 is "See Template" and -1 is "User Supplied".'
                )
                ->change();
            $table
                ->float('item_width', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The width of the Product. NULL typically means it is _not_ a flat item. One dimension typically means it is a diameter and often will display as "N/A" (e.g., round Coasters). 0 is "See Template" and -1 is "User Supplied".'
                )
                ->change();
            $table
                ->float('item_height', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The height of the Product. NULL typically means it is *not* a flat item. One dimension typically means it is a diameter and often will display as "N/A" (e.g., round Coasters). 0 is "See Template" and -1 is "User Supplied".'
                )
                ->change();
            $table
                ->string('shape_id', 45)
                ->nullable()
                ->after('dim_base')
                ->comment('The Shape of the Product. Foreign key.');
            $table
                ->string('thickness_id', 45)
                ->nullable()
                ->after('shape_id')
                ->comment('The Thickness of the Product. Foreign key.');
            $table
                ->float('area', 8, 5)
                ->unsigned()
                ->nullable()
                ->after('thickness_id')
                ->comment(
                    'The area in square inches of the Product. Currently used only for shaped items. NULL means the area is not used for the Product.'
                );

            // Link this table to `shapes`.
            $table
                ->foreign('shape_id')
                ->references('id')
                ->on('shapes')
                ->onUpdate('cascade')
                ->onDelete('set null');

            // Link this table to `thicknesses`.
            $table
                ->foreign('thickness_id')
                ->references('id')
                ->on('thicknesses')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_shape_id_foreign');
            $table->dropForeign('products_thickness_id_foreign');

            $table->dropColumn('shape_id');
            $table->dropColumn('thickness_id');
            $table->dropColumn('area');

            $table
                ->float('dim_top')
                ->unsigned(true)
                ->comment(
                    'The dimension of the top of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item; see `item_width` and `item_height`.'
                )
                ->change();
            $table
                ->float('dim_height')
                ->unsigned(true)
                ->comment(
                    'The dimension of the height of the Product in inches. NULL typically means it is a flat item; see `item_width` and `item_height`.'
                )
                ->change();
            $table
                ->float('dim_base')
                ->unsigned(true)
                ->comment(
                    'The dimension of the bottom (or base) of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item; see `item_width` and `item_height`.'
                )
                ->change();
            $table
                ->float('item_width')
                ->unsigned(true)
                ->comment(
                    'The width of the Product. NULL typically means it is _not_ a flat item. One dimension typically means it is a diameter (e.g., round Coasters).'
                )
                ->change();
            $table
                ->float('item_height')
                ->unsigned(true)
                ->comment(
                    'The height of the Product. NULL typically means it is *not* a flat item. One dimension typically means it is a diameter (e.g., round Coasters).'
                )
                ->change();
        });
    }
}
