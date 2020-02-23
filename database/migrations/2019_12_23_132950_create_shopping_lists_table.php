<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateShoppingListsTable
 */
class CreateShoppingListsTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->string('name');
            $table->text('description');
            $table->dateTime('end_date');
            $table->string('location_id');
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_lists');
    }
}
