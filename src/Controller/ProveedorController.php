<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveedorController extends AbstractController
{
    
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }



    #[Route('/proveedores', name: 'app_proveedor')]
    public function index(Request $request): Response
    {


        $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($proveedor);  
            $this->em->flush();
            return $this->redirectToRoute('app_proveedor');
        }


        $proveedores = $this->em->getRepository(Proveedor::class)->findAll(); //Busca todos



        return $this->render('proveedor/index.html.twig', [           
            'form'=>$form->createView(),
            'proveedores'=>$proveedores
        ]);

    }



    
    #[Route('/proveedores/edit/{id}', name: 'proveedorEdit')]
    public function zonaEdit(Request $request, Proveedor $proveedores, Proveedor $id)
    {
        $form = $this->createForm(ProveedorType::class, $proveedores);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $proveedores = $this->em->getRepository(Proveedor::class)->find($id); //Busca por id
            $this->em->flush();
            return $this->redirectToRoute('app_proveedor');

        }

        return $this->render('proveedor/edit.html.twig', [
            'form' => $form->createView(),
            'proveedores' => $proveedores,
        ]);
    }


    #[Route('/proveedores/remove/{id}', name: 'proveedorRemove')]
    public function marcaRemove(Request $request, Proveedor $proveedores, Proveedor $id)
    {
        $form = $this->createForm(ProveedorType::class, $proveedores);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $proveedores = $this->em->getRepository(Proveedor::class)->find($id); //Busca por id
            $this->em->remove($proveedores); //usando los set
            $this->em->flush();
            return $this->redirectToRoute('app_proveedor');
            
        }

        return $this->render('proveedor/remove.html.twig', [
            'form' => $form->createView(),
            'proveedores' => $proveedores,
        ]);
    }



    /*#[Route('/proveedor/{id}', name: 'app_proveedor')]
    public function index(Proveedor $id): Response
    {

        $proveedor = $this->em->getRepository(Proveedor::class)->find($id); //Busca por id
        //$proveedor = $this->em->getRepository(Proveedor::class)->findAll(); //Busca todos
        //$proveedor = $this->em->getRepository(Proveedor::class)->findBy(['id'=>1]); //Busca VARIOS por parametros
        $custom_proveedor = $this->em->getRepository(Proveedor::class)->findProveedor($id);


        return $this->render('proveedor/index.html.twig', [
           
            'proveedor'=>$proveedor,
            'custom_proveedor'=>$custom_proveedor

        ]);
    }*/




    //PARA INSERTAR REGISTROS
    /*#[Route('/insert/proveedor', name: 'app_insert')]
    public function insert(){
        $proveedor = new Proveedor('nueva prueba'); //usando el constructor
        //$proveedor->setDescripcion('prueba'); //usando los set
        $this->em->persist($proveedor);
        $this->em->flush();
        
        return new JsonResponse(['success'=>true]);

    }*/

    //PARA MODIFCAR REGISTROS
    /*#[Route('/update/proveedor', name: 'app_insert')]
    public function insert(){

        $proveedor = $this->em->getRepository(Proveedor::class)->find(4); //Busca por id
        $proveedor->setDescripcion('prueba modificada'); //usando los set
        $this->em->flush();
        
        return new JsonResponse(['success'=>true]);

    }*/



     //PARA BORRAR REGISTROS
    /* #[Route('/remove/proveedor', name: 'app_insert')]
     public function insert(){
 
         $proveedor = $this->em->getRepository(Proveedor::class)->find(4); //Busca por id
         $this->em->remove($proveedor); //usando los set
         $this->em->flush();         
         return new JsonResponse(['success'=>true]);
 
     }*/


    
    /*#[Route('/proveedor/{id}', name: 'app_proveedor')]
    public function index(Proveedor $proveedor): Response
    {

        dump($proveedor);

        return $this->render('proveedor/index.html.twig', [
            'controller_name' => [
                'Hola mundo'=>'holas',
                'Ber'=>10,  
                'proveedor'=>$proveedor],//Dentro del array
                'proveedor'=>$proveedor//Fuera del array
        ]);
    }*/
}
