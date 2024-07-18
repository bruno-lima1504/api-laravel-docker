<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCategories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('id_subcategory')->references('id_subcategory')->on('subcategories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['id_subcategory']);
        });
    }
}

