<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable()->index();
            $table->text('description');

            // Custom morphs dengan string support
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            $table->index(['subject_type', 'subject_id'], 'subject');

            $table->string('event')->nullable();

            // Custom morphs untuk causer dengan string support
            $table->string('causer_type')->nullable();
            $table->string('causer_id')->nullable();
            $table->index(['causer_type', 'causer_id'], 'causer');

            $table->json('properties')->nullable();
            $table->uuid('batch_uuid')->nullable();

            // Custom fields
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('module')->nullable()->index();
            $table->string('action_type')->nullable()->index();

            $table->timestamps();
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->drop(config('activitylog.table_name'));
    }
}
