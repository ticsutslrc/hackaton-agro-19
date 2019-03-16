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

}