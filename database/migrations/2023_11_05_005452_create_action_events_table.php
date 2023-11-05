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
        Schema::create('action_events', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('actionable_type');
            $table->integer('actionable_id');
            $table->string('target_type');
            $table->integer('target_id');
            $table->string('model_type');
            $table->integer('model_id');
            $table->string('fields');
            $table->string('status');
            $table->string('exception');
            $table->string('original');
            $table->string('changes');
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
        Schema::dropIfExists('action_events');
    }
};
