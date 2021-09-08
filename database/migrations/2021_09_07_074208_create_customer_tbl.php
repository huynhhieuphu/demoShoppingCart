<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('email')->unique();
            $table->string('first_name', 120)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('last_name', 120)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('address', 200)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('phone', 20);
            $table->tinyInteger('status')->default(1);
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
