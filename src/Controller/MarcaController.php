<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarcaController extends AbstractController
{

    private $em;

        public function __construct(EntityManagerInterface $em)
        {
            $this->em = $em;
        }

    
    #[Route('/marca', name: 'app_marca')]
    public function index(Request $request): Response
    {

        $marca = new Marca();


        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $this->em->persist($marca);  
            $this->em->flush();
            return $this->redirectToRoute('app_marca');
        }


        $marcas = $this->em->getRepository(Marca::class)->findAll(); //Busca todos




        return $this->render('marca/index.html.twig', [
            'form'=>$form->createView(),
            'marcas'=>$marcas
        ]);
    }
}
