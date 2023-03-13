<?php

namespace App\Controller;

use App\Entity\Zona;
use App\Form\ZonaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZonaController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }




    #[Route('/zona', name: 'app_zona')]
    public function index(Request $request): Response
    {


        
        $zona = new Zona();
        $form = $this->createForm(ZonaType::class, $zona);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($zona);  
            $this->em->flush();
            return $this->redirectToRoute('app_zona');
        }


        $zonas = $this->em->getRepository(Zona::class)->findAll(); //Busca todos


        return $this->render('zona/index.html.twig', [
            'form'=>$form->createView(),
            'zonas'=>$zonas,
        ]);
    }
}
