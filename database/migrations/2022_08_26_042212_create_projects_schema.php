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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);

            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('user')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);

            $table->unsignedInteger('fk_id_role');

            $table->timestamps();

            $table->foreign('fk_id_role')
                ->references('id')
                ->on('roles');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('project_manager');
            $table->string('description');
            $table->string('enterprise');
            $table->boolean('active')->default(true);

            $table->timestamps();
        });

        Schema::create('developers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');

            $table->unsignedInteger('fk_id_project');

            $table->timestamps();

            $table->foreign('fk_id_project')
                ->references('id')
                ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
