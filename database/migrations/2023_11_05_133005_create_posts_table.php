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
        Schema::create('posts', function (Blueprint $table) {
            $table->string('id');
            $table->text('name');
            $table->string('phone');
            $table->string('isWhatsApp')->nullable();
            $table->string('status');
            $table->string('active_date');
            $table->string('plan_start_date')->nullable();
            $table->string('plan_end_date')->nullable();
            $table->text('description');
            $table->integer('category_id');
            $table->integer('city_id');
            $table->integer('state_id');
            $table->integer('user_id');
            $table->integer('locality_id')->nullable();
            $table->string('plan');
            $table->string('last_cart_plan')->nullable();
            $table->string('last_order_id')->nullable();
            $table->string('image_path_1')->nullable();
            $table->string('image_path_2')->nullable();
            $table->string('image_path_3')->nullable();
            $table->string('image_path_4')->nullable();
            $table->string('image_path_5')->nullable();
            $table->string('page_view')->nullable();
            $table->string('send_email')->nullable();
            $table->string('phone_view')->nullable();
            $table->string('whatsApp_view')->nullable();
            $table->string('salary_period')->nullable();
            $table->string('education_level')->nullable();
            $table->string('position_type')->nullable();
            $table->string('experience_year')->nullable();
            $table->string('salary_from')->nullable();
            $table->string('salary_to')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('furnishing')->nullable();
            $table->string('listed_by')->nullable();
            $table->string('super_builtup_area')->nullable();
            $table->string('carpet_area')->nullable();
            $table->string('is_bachelors_allowed')->nullable();
            $table->string('total_floor')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('car_parking')->nullable();
            $table->string('facing')->nullable();
            $table->string('price')->nullable();
            $table->string('plot_area')->nullable();
            $table->string('length')->nullable();
            $table->string('breadth')->nullable();
            $table->string('washroom')->nullable();
            $table->string('construction_status')->nullable();
            $table->string('is_meal_included')->nullable();
            $table->string('registration_year')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('km_driven')->nullable();
            $table->string('owner')->nullable();
            $table->string('hp_power')->nullable();
            $table->string('transmission')->nullable();
            $table->string('body_type')->nullable();
            $table->string('vehicle_parts_accessory_type')->nullable();
            $table->string('pet_age')->nullable();
            $table->string('pet_gender')->nullable();
            $table->string('pet_breed')->nullable();
            $table->string('pet_colour')->nullable();
            $table->string('community_age')->nullable();
            $table->string('community_date_from')->nullable();
            $table->string('community_date_to')->nullable();
            $table->string('condition')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
