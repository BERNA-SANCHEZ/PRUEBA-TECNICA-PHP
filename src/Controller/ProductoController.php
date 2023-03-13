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


    #[Route('/reportegeneral', name: 'app_reportegeneral')]
    public function reportegeneral(Request $request): Response
    {        
        $producto = new Producto();

        $productos = $this->em->getRepository(Producto::class)->findAllProductos(); //Busca todos

        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($producto);  
            $this->em->flush();
            return $this->redirectToRoute('app_producto');
        }

        return $this->render('producto/rep.html.twig', [
            'productos'=>$productos
        ]);
    }



    #[Route('/reportegeneralproveedor', name: 'app_reportegeneralproveedor')]
    public function reportegeneralproveedor(Request $request): Response
    {        
        $producto = new Producto();

        $productos = $this->em->getRepository(Producto::class)->findAllProductosProveedor(); //Busca todos

        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($producto);  
            $this->em->flush();
            return $this->redirectToRoute('app_producto');
        }

        return $this->render('producto/repproveedor.html.twig', [
            'productos'=>$productos
        ]);
    }





    




    #[Route('/producto/edit/{id}', name: 'productoEdit')]
    public function productoEdit(Request $request, Producto $id,Producto $producto)
    {
        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $producto = $this->em->getRepository(Producto::class)->find($id); //Busca por id
            $this->em->flush();
            return $this->redirectToRoute('app_producto');

        }

        return $this->render('producto/edit.html.twig', [
            'form' => $form->createView(),
            'producto' => $producto,
        ]);
    }



    #[Route('/producto/remove/{id}', name: 'productoRemove')]
    public function marcaRemove(Request $request, Producto $producto, Producto $id)
    {
        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $producto = $this->em->getRepository(Producto::class)->find($id); //Busca por id
            $this->em->remove($producto); //usando los set
            $this->em->flush();
            return $this->redirectToRoute('app_producto');
            
        }

        return $this->render('producto/remove.html.twig', [
            'form' => $form->createView(),
            'producto' => $producto,
        ]);
    }







}
