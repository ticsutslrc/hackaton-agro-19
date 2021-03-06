<?php
error_reporting(0);
date_default_timezone_set('America/Phoenix');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Connection.php';
require __DIR__ . '/../controllers/UnitOfWork.php';
require __DIR__ . '/../controllers/Journal.php';
require __DIR__ . '/../controllers/Supervisor.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
    ]]);


$app->get("/hack/api/", function ($req, $res, $args) {
    return $res->withJSON(["hello" => "world"]);
});

$app->group("/hack/api", function () {
    $this->post("/unitofwork", "Hack\Controllers\UnitOfWork:Add");
    $this->post("/unitofwork/{id}", "Hack\Controllers\UnitOfWork:Upd");
    $this->delete("/unitofwork/{id}", "Hack\Controllers\UnitOfWork:Del");
    $this->get("/unitofwork", "Hack\Controllers\UnitOfWork:GetAll");
    $this->get("/unitofwork/{id}/journal", "Hack\Controllers\Journal:GetByUnitWork");

    $this->post("/journal", "Hack\Controllers\Journal:Add");
    $this->get("/journal/{id}/foreman", "Hack\Controllers\Journal:GetByJornada");

    $this->get("/supervisor", "Hack\Controllers\Supervisor:GetAll");
    $this->post("/supervisor", "Hack\Controllers\Supervisor:Add");
    $this->delete("/supervisor/{id}", "Hack\Controllers\Supervisor:Del");
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
$app->run();