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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('website_url')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('crunchbase_url')->nullable();
            $table->string('founded_date')->nullable();
            $table->bigInteger('timezone_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->enum('status',['APPLY', 'APPROVE', 'VERIFY', 'ACTIVE'])->default('APPLY');
            $table->timestamps();
            $table->foreign('timezone_id')->references('id')->on('timezones')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
