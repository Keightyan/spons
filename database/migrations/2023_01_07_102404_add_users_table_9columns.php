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
            $table->foreignId('prefecture_id')->nullable()->after('team');
            $table->integer('gender')->length(1)->nullable()->after('prefecture_id');
            $table->date('birthday')->nullable()->after('gender');
            $table->string('favorites', 50)->nullable()->after('birthday');
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
            $table->dropColumn('prefecture_id');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('favorites');
            $table->dropColumn('introduction');
            $table->dropColumn('role');
            $table->dropSoftDeletes();
        });
    }
};
