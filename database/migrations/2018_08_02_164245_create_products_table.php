<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    private $tableName = 'products';
    private $tableComment = 'Pivot table for Product Lines and Product Features';

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
                ->comment('PK. The short name of the Product in snake_case.');
            $table
                ->tinyInteger('active')
                ->default(1)
                ->comment(
                    'Boolean value for whether or not the Product is active.'
                );
            $table
                ->integer('product_subcategory_id')
                ->unsigned()
                ->comment(
                    'Foreign key of the Product Subcategory to which this Product belongs.'
                );
            $table
                ->string('name', 45)
                ->comment(
                    'The item number (or name) as shown in the catalog WITHOUT the Print Method prefix.'
                );
            $table
                ->string('description', 250)
                ->comment(
                    'Description of the Product as shown in the catalog.'
                );
            $table
                ->integer('case_quantity')
                ->unsigned()
                ->nullable()
                ->comment('Number of Products in a case (or box).');
            // If need be, these "case" fields can (hopefully) be increased to SMALLINT later on.
            $table
                ->tinyInteger('case_weight')
                ->unsigned()
                ->nullable()
                ->comment('The weight of the Product case in pounds.');
            $table
                ->tinyInteger('case_dim_weight')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The "Dimensional Weight" of the Product case in pounds. (Not the _actual_ weight.)'
                );
            $table
                ->tinyInteger('case_length')
                ->unsigned()
                ->nullable()
                ->comment('Length of the Product case.');
            $table
                ->tinyInteger('case_width')
                ->unsigned()
                ->nullable()
                ->comment('Width of the Product case.');
            $table
                ->tinyInteger('case_height')
                ->unsigned()
                ->nullable()
                ->comment('Height of the Product case.');
            // If need be, these "dimension" fields can (hopefully) be changed to DECIMAL later on.
            $table
                ->float('dim_top', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The dimension of the top of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item; see `item_width` and `item_height`.'
                );
            $table
                ->float('dim_height', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The dimension of the height of the Product in inches. NULL typically means it is a flat item; see `item_width` and `item_height`.'
                );
            $table
                ->float('dim_base', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The dimension of the bottom (or base) of the Product in inches. (Usually a diameter.) NULL typically means it is a flat item; see `item_width` and `item_height`.'
                );
            $table
                ->float('item_width', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The width of the Product. NULL typically means it is _not_ a flat item. One dimension typically means it is a diameter. (e.g., round Coasters)'
                );
            $table
                ->float('item_height', 8, 5)
                ->unsigned()
                ->nullable()
                ->comment(
                    'The height of the Product. NULL typically means it is *not* a flat item. One dimension typically means it is a diameter. (e.g., round Coasters)'
                );
            $table
                ->smallInteger('pallet_quantity')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The number of Product cases (boxes) that ship on a single pallet.'
                );
            $table
                ->tinyInteger('pallet_length')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The length of the pallet in inches when fully loaded with Product cases.'
                );
            $table
                ->tinyInteger('pallet_width')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The width of the pallet in inches when fully loaded with Product cases.'
                );
            $table
                ->tinyInteger('pallet_height')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The height of the pallet in inches when fully loaded with Product cases.'
                );
            $table
                ->smallInteger('pallet_weight')
                ->unsigned()
                ->nullable()
                ->comment(
                    'The weight of the pallet in pounds when fully loaded with Product cases.'
                );
            $table
                ->smallInteger('class_code')
                ->unsigned()
                ->comment('The class code of the Product.');
            $table->timestamps();

            // Set the table's Primary Key.
            $table->primary('id');

            // Set the table's Foreign Key(s).
            $table
                ->foreign('product_subcategory_id')
                ->references('id')
                ->on('product_subcategories')
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
