<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLinesTable extends Migration
{
    private $tableName = 'product_lines';
    private $tableComment = 'The combination of Product Subcategories and Print Methods makes for these, Product Lines. Used to be known as "SubcategoriesMethods".';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id')
                ->comment('PK.');
            $table->tinyInteger('active')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combination) is active.');
            $table->integer('product_subcategory_id')
                ->unsigned()
                ->comment('Foreign key of the Product Subcategory.');
            $table->string('print_method_id', 45)
                ->comment('Foreign key of the Print Method.');
            $table->string('coupon_code_id', 45)
                ->comment('Foreign key to denote the Coupon Code for the Product Line (Subcategory/Method combination).');
            $table->tinyInteger('second_side')
                ->default(0)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) has a second side that’s printable. (Called “per panel” for offset napkins.)');
            $table->tinyInteger('wrap')
                ->default(0)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) has the capability to be printed as a wrap (first and second side together).');
            $table->tinyInteger('bleed')
                ->default(0)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) has the capability to be printed as a bleed.');
            $table->tinyInteger('multicolor')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) can be printed with more than one color. (Digital method irrelevant for determining the “per color” tag.)');
            $table->tinyInteger('process')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) can be printed with 4 Color Process. Typically only for Tradition Print Methods.');
            $table->tinyInteger('white_ink')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) has a White Ink surcharge. Typically only for Digitally-printed Coasters and Beverage Wraps.');
            $table->tinyInteger('hotstamp')
                ->default(1)
                ->comment('Boolean value for whether or not the Product Line (Subcategory/Method combo) has a Hotstamp imprint surcharge. Typically only for Coasters and Beverage Wraps.');
            $table->tinyInteger('per_thousand')
                ->default(0)
                ->comment('True/False. True if the prices for this Product Line (Subcategory/Method combo) are measured per thousand.');
            $table->smallInteger('setup_charge')
                ->unsigned()
                ->default(40)
                ->comment('Amount to charge for setup.');
            $table->timestamps();

            $table->foreign('product_subcategory_id')
                ->references('id')->on('product_subcategories')
                ->onUpdate('cascade');
            $table->foreign('print_method_id')
                ->references('id')->on('print_methods')
                ->onUpdate('cascade');
            $table->foreign('coupon_code_id')
                ->references('id')->on('coupon_codes')
                ->onUpdate('cascade');

            $table->unique(['product_subcategory_id', 'print_method_id'], 'product_lines_unique');
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
