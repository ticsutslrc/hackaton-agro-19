<?php
/**
 * Created by PhpStorm.
 * User: Xerardoo
 * Date: 3/16/2019
 * Time: 12:12 AM
 */

namespace Hack\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class Journal
{
    public function Add(Request $req, Response $resp, array $args)
    {
        $body = json_decode($req->getBody());
        try {
            $conn = \Connection::get();
            $stmt = $conn->prepare('INSERT INTO jornadas SET referencia=:referencia,descripcion=:descripcion,
            idsupervisor=:idsupervisor,inicio=:inicio,final=:final');
            $stmt->execute([
                'referencia' => $body->numparcela,
                'descripcion' => $body->descripcion,
                'idsupervisor' => $body->idsupervisor,
                'inicio' => $body->inicio,
                'final' => $body->final,
            ]);
            $idjornada = $conn->lastInsertId();

            foreach ($body->jornaleros as $jornalero) {
                if (is_null($jornalero->id)) {
                    $stmt = $conn->prepare('INSERT INTO jornaleros SET nombre=:nombre,nacimiento=:nacimiento');
                    $stmt->execute([
                        'nombre' => $jornalero->nombre,
                        'nacimiento' => $jornalero->nacimiento,
                    ]);
                    $jornalero->id = $conn->lastInsertId();
                }
                $stmt = $conn->prepare('INSERT INTO jornadas_jornaleros SET idjornada=:idjornada,idjornalero=:idjornalero,
                folio_inicial=:folio_inicial,folio_final=:folio_final');
                $stmt->execute([
                    'idjornada' => $idjornada,
                    'idjornalero' => $jornalero->id,
                    'folio_inicial' => $jornalero->folioinicial,
                    'folio_final' => $jornalero->foliofinal,
                ]);
                foreach ($jornalero->contenedores as $contenedor) {
                    $stmt = $conn->prepare('INSERT INTO jornaleros_contenedores SET folio=:folio,completado=:completado,
                    idjornada=:idjornada,idjornalero=:idjornalero');
                    $stmt->execute([
                        'folio' => $contenedor->folio,
                        'completado' => $contenedor->completado,
                        'idjornalero' => $jornalero->id,
                        'idjornada' => $idjornada,
                    ]);
                }// contenedor
            }// jornalero


        } catch (\Exception $e) {
            return $resp->withJson(["msg" => $e->getMessage()], 500);
        }
        return $resp->withJson(["msg" => $idjornada]);
    }

    public function GetByUnitWork(Request $req, Response $resp, array $args)
    {
        $conn = \Connection::get();  $id = $args['id'];
        $search = $req->getQueryParam('search');
        $limit = $req->getQueryParam('limit', 20);
        $offset = $req->getQueryParam('offset', 0);

        $filter = "";
        $pagination = " LIMIT $limit OFFSET $offset";
        if ($search) $filter .= " AND nombre LIKE '%$search%' ";
        try {
            $stmt = $conn->query("SELECT j.id idjornada,j.referencia,j.descripcion,j.inicio,j.final,j.creada 
            FROM unidad_trabajo ut
            INNER JOIN unidadtrabajo_jornadas utj ON utj.idunidadtrabajo=ut.id
            INNER JOIN jornadas j ON j.id=utj.idjornadas  WHERE ut.id = $id and 1=1 " . $filter . $pagination);
            $rows = $stmt->fetchAll();
            $stmt = $conn->query("SELECT COUNT(*)count FROM unidad_trabajo ut
            INNER JOIN unidadtrabajo_jornadas utj ON utj.idunidadtrabajo=ut.id
            INNER JOIN jornadas j ON j.id=utj.idjornadas  WHERE ut.id = $id and 1=1 " . $filter);
            $row = $stmt->fetch();
        } catch (\Exception $e) {
            return $resp->withJson($e->getMessage(), 500);
        }
        return $resp->withJson(["rows" => $rows, 'total' => $row->count], 200);
    }

    public function GetByJornada(Request $req, Response $resp, array $args)
    {
        $conn = \Connection::get();
        $search = $req->getQueryParam('search');
        $limit = $req->getQueryParam('limit', 20);
        $offset = $req->getQueryParam('offset', 0);

        $filter = "";
        $pagination = " LIMIT $limit OFFSET $offset";
        if ($search) $filter .= " AND nombre LIKE '%$search%' ";
        try {
            $stmt = $conn->query("select * from jornaleros j inner join jornadas_jornaleros jj on j.id = jj.idjornalero WHERE 1=1 " . $filter . $pagination);
            $rows = $stmt->fetchAll();
            $stmt = $conn->query("select count(*)count from jornaleros j inner join jornadas_jornaleros jj on j.id = jj.idjornalero;  WHERE 1=1 " . $filter);
            $row = $stmt->fetch();
        } catch (\Exception $e) {
            return $resp->withJson($e->getMessage(), 500);
        }
        return $resp->withJson(["rows" => $rows, 'total' => $row->count], 200);
    }
}