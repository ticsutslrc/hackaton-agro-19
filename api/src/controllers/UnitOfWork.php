<?php
/**
 * Created by PhpStorm.
 * User: Xerardoo
 * Date: 3/15/2019
 * Time: 9:27 PM
 */


namespace Hack\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class UnitOfWork
{
    public function Add(Request $req, Response $resp, array $args)
    {
        $body = json_decode($req->getBody());
        try {

            $conn = \Connection::get();
            $stmt = $conn->prepare('INSERT INTO unidad_trabajo SET referencia=:referencia,cantidad=:cantidad,
            unidad=:unidad,inicio=:inicio,final=:final');
            $stmt->execute([
                'referencia' => $body->referencia,
                'cantidad' => $body->cantidad,
                'unidad' => $body->unidadmedida,
                'inicio' => $body->inicio,
                'final' => $body->final,
            ]);
            $lastId = $conn->lastInsertId();

        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $lastId]);
    }

    public function Upd(Request $req, Response $resp, array $args)
    {
        $id = $args['id'];
        $body = json_decode($req->getBody());
        try {

            $conn = \Connection::get();
            $stmt = $conn->prepare('UPDATE unidad_trabajo SET referencia=:referencia,cantidad=:cantidad,
            unidad=:unidad,inicio=:inicio,final=:final WHERE id=:id');
            $stmt->execute([
                'referencia' => $body->referencia,
                'cantidad' => $body->cantidad,
                'unidad' => $body->unidadmedida,
                'inicio' => $body->inicio,
                'final' => $body->final,
                'id' => $id,
            ]);

        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $id]);
    }

    public function Del(Request $req, Response $resp, array $args)
    {
        $id = $args['id'];
        try {
            $conn = \Connection::get();
            $stmt = $conn->prepare("DELETE FROM unidad_trabajo WHERE id=:id");
            $stmt->execute(['id' => $id]);
        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $id]);
    }
}