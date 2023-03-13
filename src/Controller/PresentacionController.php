<?php

namespace App\Controller;

use App\Entity\Presentacion;
use App\Form\PresentacionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentacionController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }




    
    #[Route('/presentacion', name: 'app_presentacion')]
    public function index(Request $request): Response
    {


        $presentacion = new Presentacion();
        $form = $this->createForm(PresentacionType::class, $presentacion);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($presentacion);  
            $this->em->flush();
            return $this->redirectToRoute('app_presentacion');
        }


        $presentaciones = $this->em->getRepository(Presentacion::class)->findAll(); //Busca todos


        return $this->render('presentacion/index.html.twig', [
            'form'=>$form->createView(),
            'presentaciones'=>$presentaciones
        ]);
    }



        
    #[Route('/presentacion/edit/{id}', name: 'presentacionEdit')]
    public function zonaEdit(Request $request, Presentacion $presentacion, Presentacion $id)
    {
        $form = $this->createForm(PresentacionType::class, $presentacion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $presentacion = $this->em->getRepository(Presentacion::class)->find($id); //Busca por id
            $this->em->flush();
            return $this->redirectToRoute('app_presentacion');

        }

        return $this->render('presentacion/edit.html.twig', [
            'form' => $form->createView(),
            'presentacion' => $presentacion,
        ]);
    }


    #[Route('/presentacion/remove/{id}', name: 'presentacionRemove')]
    public function marcaRemove(Request $request, Presentacion $presentacion, Presentacion $id)
    {
        $form = $this->createForm(PresentacionType::class, $presentacion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $presentacion = $this->em->getRepository(Presentacion::class)->find($id); //Busca por id
            $this->em->remove($presentacion); //usando los set
            $this->em->flush();
            return $this->redirectToRoute('app_presentacion');
            
        }

        return $this->render('presentacion/remove.html.twig', [
            'form' => $form->createView(),
            'presentacion' => $presentacion,
        ]);
    }




}
