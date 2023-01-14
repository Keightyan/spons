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
        Schema::table('users', function (Blueprint $table) {
            $table->text('profile_image')->nullable()->after('email_verified_at');
            $table->string('team', 20)->nullable()->after('profile_image');
            $table->text('introduction')->nullable()->after('team');
            $table->integer('role')->length(1)->default(1)->after('remember_token');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_image');
            $table->dropColumn('team');
            $table->dropColumn('introduction');
            $table->dropColumn('role');
            $table->dropSoftDeletes();
        });
    }
};
