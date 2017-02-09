<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('membreequipe',function (Blueprint $table){
            $table->date('dateparticipation');
            $table->integer('intervenant_id');
            $table->integer('equipetravaux_id');
            $table->integer('fpam')->nullable();
            $table->primary(['fpam','intervenant_id','equipetravaux_id'],'pk_membreequipe');
            $table->foreign('intervenant_id')->references('id')->on('intervenant');
            $table->foreign('equipetravaux_id')->references('id')->on('equipetravaux');
            $table->foreign('fpam')->references('id')->on('fpactionmaintenance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('membreequipe');
    }
}
