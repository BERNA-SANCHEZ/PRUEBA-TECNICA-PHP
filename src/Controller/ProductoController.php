<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    
    #[Route('/producto', name: 'app_producto')]
    public function index(Request $request): Response
    {

        

        $producto = new Producto();
        //$productos = $this->em->getRepository(Producto::class)->findAll(); //Busca todos

        $productos = $this->em->getRepository(Producto::class)->findAllProductos(); //Busca todos



        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($producto);  
            $this->em->flush();
            return $this->redirectToRoute('app_producto');
        }



        return $this->render('producto/index.html.twig', [
            'form'=>$form->createView(),
            'productos'=>$productos
        ]);
    }
}
