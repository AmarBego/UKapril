<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->text('note')->nullable();
            $table->date('date');
            $table->integer('nights');
            $table->decimal('room_temperature', 3, 1);
            $table->timestamps();
        });

        /**
         * Der folgende Code muss nicht von den Lernenden erstellt werden,
         * sondern dient als Hilfe bei der Kursentwicklung.
         */

        $reservations = [
            [
                "room_id" => 1,
                "firstname" => "Max",
                "lastname" => "Mustermann",
                "note" => "Bitte ein Zimmer mit Blick auf den See",
                "date" => "2023-04-01",
                "nights" => 3,
                "room_temperature" => 22.5
            ], [
                "room_id" => 2,
                "firstname" => "Erika",
                "lastname" => "Musterfrau",
                "note" => null,
                "date" => "2023-04-22",
                "nights" => 8,
                "room_temperature" => 17.5
            ]
        ];

        foreach ($reservations as $reservation) {
            $reservationModel = new \App\Models\Reservation();
            $reservationModel::unguard();
            $reservationModel->fill($reservation);
            $reservationModel->save();
            $reservationModel::reguard();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
