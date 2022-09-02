<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    /**
     * @Route("/cliente", name="app_cliente")
     */
    public function index(): Response
    {
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }

    /**
     * @Route("/cliente/crear", name="create_cliente")
     */
    public function crearCliente(Request $request): JsonResponse
    {
        $nombre = $request->query->get('nombre');
        
        return new JsonResponse(['saludo' => "Hola $nombre"], 200, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'crossdomain, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE',
            'Allow' => 'GET, POST, OPTIONS, PUT, DELETE'
        ]);
    }
}
