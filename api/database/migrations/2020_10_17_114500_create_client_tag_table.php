<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'client_tag',
            function (Blueprint $table) {

                $table->integer('client_id')->unsigned();
                $table->integer('tag_id')->unsigned();

                $table->primary(array('client_id', 'tag_id'));
                $table->foreign('client_id')->references('id')->on('clients');
                $table->foreign('tag_id')->references('id')->on('tags');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_tag');
    }
}
