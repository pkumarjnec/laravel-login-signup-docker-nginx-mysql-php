<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('login_at')->nullable();

            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->string('name',100);
            $table->string('emailid',100)->unique();
            $table->string('mobile_no',20)->unique()->nullable();
            $table->string('password',100);
            $table->string('status',10);
            $table->string('access_token',40);
            $table->string('document',2000);
            $table->rememberToken();
            $table->index(['emailid','access_token','status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
