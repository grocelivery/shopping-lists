<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateConversationsTable
 */
class CreateConversationsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shopping_list_id');
            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists');
            $table->uuid('contractor_id');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
