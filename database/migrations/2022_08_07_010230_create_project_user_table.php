<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->foreignId('project_id');
            $table->foreignId('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_user');
    }
};
