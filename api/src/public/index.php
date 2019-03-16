<?php
error_reporting(0);
date_default_timezone_set('America/Phoenix');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Connection.php';
require __DIR__ . '/../controllers/UnitOfWork.php';
require __DIR__ . '/../controllers/Journal.php';

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

    $this->post("/journal", "Hack\Controllers\Journal:Add");
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
$app->run();