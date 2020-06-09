<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductPriority extends Migration
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
                ->tinyInteger('priority')
                ->after('description')
                ->nullable()
                ->default(null)
                ->comment(
                    'The order in which the Products should appear. Lower numbers appear before higher numbers.'
                );

            // Make the `priority` field unique.
            $table->unique(
                ['priority', 'product_subcategory_id'],
                'subcategory_priority_unique'
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
