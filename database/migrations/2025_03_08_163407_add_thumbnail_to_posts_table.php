<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->string('thumbnail')->nullable()->after('status');
    });
    Schema::table('posts', function (Blueprint $table) {
        $table->tinyInteger('status')->default(0); 
    });
}

public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('thumbnail');
    });
}

};
