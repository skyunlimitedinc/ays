<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubheadToProductSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            $table
                ->string('subhead', 250)
                ->after('long_name')
                ->nullable()
                ->default(null)
                ->comment(
                    'The subheading that typically appears immediately after the `long_name`.'
                );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            $table->dropColumn('subhead');
        });
    }
}
