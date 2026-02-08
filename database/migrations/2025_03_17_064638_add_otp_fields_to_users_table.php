<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('otp_code')->nullable(); // Store the OTP code
            $table->timestamp('otp_expires_at')->nullable(); // Store the expiration time of the OTP
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('otp_code');
            $table->dropColumn('otp_expires_at');
        });
    }
    
};
