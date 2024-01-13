<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('parent_id');
            $table->string('slug');
            $table->string('status');
            $table->string('hierarchical_ids')->nullable();
            $table->string('home_description')->nullable();
            $table->string('description')->nullable();
            $table->string('h1_title');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword')->nullable();
            $table->string('image');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
