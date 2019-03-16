<?php
/**
 * Created by PhpStorm.
 * User: Xerardoo
 * Date: 3/16/2019
 * Time: 5:58 AM
 */

namespace Hack\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class Supervisor
{
    public function Add(Request $req, Response $resp, array $args)
    {
        $body = json_decode($req->getBody());
        try {
            $conn = \Connection::get();
            $stmt = $conn->prepare('INSERT INTO supervisores SET nombre=:nombre');
            $stmt->execute(['nombre' => $body->nombre]);
            $lastId = $conn->lastInsertId();
        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $lastId]);
    }

    public function Del(Request $req, Response $resp, array $args)
    {
        $id = $args['id'];
        try {
            $conn = \Connection::get();
            $stmt = $conn->prepare("DELETE FROM supervisores WHERE id=:id");
            $stmt->execute(['id' => $id]);
        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $id]);
    }

    public function GetAll(Request $req, Response $resp, array $args)
    {
        $conn = \Connection::get();
        $search = $req->getQueryParam('search');
        $limit = $req->getQueryParam('limit', 20);
        $offset = $req->getQueryParam('offset', 0);

        $filter = "";
        $pagination = " LIMIT $limit OFFSET $offset";
        if ($search) $filter .= " AND nombre LIKE '%$search%' ";
        try {
            $stmt = $conn->query("SELECT * FROM supervisores WHERE 1=1 " . $filter . $pagination);
            $rows = $stmt->fetchAll();
            $stmt = $conn->query("SELECT COUNT(*)count FROM supervisores WHERE 1=1 " . $filter);
            $row = $stmt->fetch();
        } catch (\Exception $e) {
            return $resp->withJson($e->getMessage(), 500);
        }
        return $resp->withJson(["rows" => $rows, 'total' => $row->count], 200);
    }
}