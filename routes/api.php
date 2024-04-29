<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/')->group(function () {

    Route::get('/bikes', function () {
        $pdo = new PDO('mysql:host=localhost;dbname=laravel', 'root', '');
        $statement = $pdo->query('SELECT * FROM bike');
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    });

    Route::get('/bikes/{id}', function ( $id) {
        $pdo = new PDO('mysql:host=localhost;dbname=laravel', 'root', '');
        $statement = $pdo->prepare('SELECT * FROM bike WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    })->whereNumber('id');
});