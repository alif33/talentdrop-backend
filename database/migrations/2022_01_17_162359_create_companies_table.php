<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('website_url')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('crunchbase_url')->nullable();
            $table->string('founded_date')->nullable();
            $table->bigInteger('timezone_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('social_id')->unsigned();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('timezone_id')->references('id')->on('timezones')->onDelete('cascade');
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
