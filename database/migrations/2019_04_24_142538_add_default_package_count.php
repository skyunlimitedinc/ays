<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultPackageCount extends Migration
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
                ->smallInteger('package_count', false, true)
                ->default(25)
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
                ->smallInteger('package_count', false, true)
                ->default(null)
                ->change();
        });
    }
}
