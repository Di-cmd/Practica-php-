<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandarController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        $numero1=1;
        $numero2=100;
        $suma=$numero1+$numero2;
        $nombre="Diego, andrea, camila, mariana";

        return $this->render('standar/index.html.twig', [
            'controller_name' => 'StandarController',
            'usuario' => 'Diana Salazar',
            'numero1' => $numero1,
            'numero2' => $numero2,
            'suma' => $suma,
            'nombre' => $nombre,
        ]);
    }

 /**
  * @Route("/pagina2/{nombre}", name="pagina2")
  */

    public function pagina2($nombre)
    {
        return $this->render('standar/pagina2.html.twig',[
            'nombre'=>$nombre, 
        ]);
    }
}
