<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use App\Form\ProductoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//Se importa el Request 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandarController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        // se llama la persistencia de la base de datos 
        $producto=new Producto();



        // Y se llama al formulario.
        $form=$this->createForm(ProductoType::class, $producto);



        
        $numero1=1;
        $numero2=100;
        $suma=$numero1+$numero2;
        $nombre="Diego, andrea, camila, mariana";


      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $entityManager=$this->getDoctrine()->getManager();


        $categoria=new Categoria("Hogar");
        $entityManager->persist($categoria);
        $entityManager->flush();
        $producto=$form->getData();
        $producto->setCategoria($categoria);
        $entityManager->persist($producto);
        $entityManager->flush(); 
        return $this->redirectToRoute('index');

      }

        return $this->render('standar/index.html.twig', [
            'controller_name' => 'StandarController',
            'usuario' => 'Diana Salazar',
            'numero1' => $numero1,
            'numero2' => $numero2,
            'suma' => $suma,
            'nombre' => $nombre,
            'form' => $form->createView(),
        ]);
    }

 /**
  * @Route("/pagina2/{nombre}", name="pagina2")
  */

    public function pagina2($nombre, Request $request)
    {

        $producto= new Producto();
        $form=$this->createFormBuilder()
        ->add('nombre')
        ->add('codigo')
        ->add('categoria',EntityType::class, 
        
        ['class'=>Categoria::class ,
        'choice_label'=>'nombre'])

        ->add('Enviar', SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            // Se tiene que llamar para persistir:

            $entityManager=$this->getDoctrine()->getManager();

            $data=$form->getData();
            $producto=new Producto($data['nombre'], $data['codigo']);
            $producto->setCategoria($data['categoria']);
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('pagina2',['nombre'=>'Guardado Exitoso']);

        }

        return $this->render('standar/pagina2.html.twig',[
            'nombre'=>$nombre, 
            'form'=>$form->createView()
        ]);
    }


   /**
    * @Route("/persistirDatos", name="persistencia")
    */

    public function persistirDatos()
    {
        //la entidad manager 
        $entityManager=$this->getDoctrine()->getManager();
        //se crea un nuevo objeto de la entidad producto  y se le asignan valores al nombre y al codigo, por medio de los metodos 
        // set de cada una de los campos. 

        //$verificarCategoria=$entityManager->getRepository(Producto::class)->findOneBy($parametro);
        //if($parametro){}else{}
   
        $categoria=new Categoria("Tecnologia");
        $entityManager->persist($categoria);
        $entityManager->flush();

        $producto=new Producto('televisor', 'tv09');
        $producto->setCategoria($categoria);

        $entityManager->persist($producto);
        $entityManager->flush();

        // si todo sale bien, tiene que retornar la vista 
        return $this->render('standar/success.html.twig');
    }




}
