<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImprintAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_method_product', function (Blueprint $table) {
            $table
                ->float('imprint_width', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The width of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If there is a value in this column while the imprint_height column is NULL, then it is likely that this number is a diameter. *A value of 0 means "See Template," -1 means "User Supplied," and -2 means "1/8 in. over actual."*'
                )
                ->change();
            $table
                ->float('imprint_height', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The height of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If this is NULL while there is a value in the imprint_width column, then it is likely that number is a diameter.'
                )
                ->change();
            $table
                ->float('imprint_bleed_wrap_width', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The width of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means that the product does not have a bleed or wrap imprint area possible. *A value of 0 means "See Template," -1 means "User Supplied," and -2 means "1/8 in. over actual."*'
                )
                ->change();
            $table
                ->float('imprint_bleed_wrap_height', 8, 5)
                ->unsigned(false)
                ->comment(
                    'The height of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means either the item is a cup and the wrap width is in the "imprint_bleed_wrap_width" field or the number in that field represents a diameter for a flat item. A NULL in *both* fields means the item does not have a bleed nor wrap imprint area.'
                )
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_method_product', function (Blueprint $table) {
            $table
                ->float('imprint_width')
                ->unsigned(true)
                ->comment(
                    'The width of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If there is a value in this column while the imprint_height column is NULL, then it is likely that this number is a diameter. *A value of 0 means "See Template."*'
                )
                ->change();
            $table
                ->float('imprint_height')
                ->unsigned(true)
                ->comment(
                    'The height of the imprint area. NULL typically means it is an unprinted item, such as a lid or straw. If this is NULL while there is a value in the imprint_width column, then it is likely that number is a diameter.'
                )
                ->change();
            $table
                ->float('imprint_bleed_wrap_width')
                ->unsigned(true)
                ->comment(
                    'The width of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means that the product does not have a bleed or wrap imprint area possible. *A value of 0 means "See Template."*'
                )
                ->change();
            $table
                ->float('imprint_bleed_wrap_height')
                ->unsigned(true)
                ->comment(
                    'The height of the "bleed" imprint area on a flat item or "wrap" imprint area of a cup. NULL typically means either the item is a cup and the wrap width is in the "imprint_bleed_wrap_width" field or the number in that field represents a diameter for a flat item. A NULL in *both* fields means the item does not have a bleed nor wrap imprint area.'
                )
                ->change();
        });
    }
}
