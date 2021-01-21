<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->bigIncrements('admins_id');
            $table->string('admin_username',50)->unique();
            $table->string('admin_email',50)->unique()->nullable();
            $table->timestamp('admin_email_verified_at')->nullable();
            $table->string('admin_password');
            $table->integer('admin_user_type')->default(0);
            $table->string('admin_fullname');
            $table->rememberToken();
            $table->timestamps();
        });

         DB::table('administrators')->insert([
           'admin_username'    => 'hashcode',
           'admin_fullname'    => 'Hashcode Group',
           'admin_password'    => Hash::make('123456789'),
           'admin_user_type'   => 1,
           'created_at' => new DateTime(),
           'updated_at' => new DateTime(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
