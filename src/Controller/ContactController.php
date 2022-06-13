<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use App\Entity\Demande;
use App\Entity\Commande;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'demande'=>'',
        ]);
    }

    /**
     * @Route("/contactbis", name="contectbis")
    */
    public function contactbis(Request $request,
    EntityManagerInterface $manager)
    {
        $demande = new Demande();
        $demande->setEntname($request->request->get("entname"));
        $manager->persist($demande);
        $demande->setName($request->request->get("name"));
        $manager->persist($demande);
        $demande->setMail($request->request->get("mail"));
        $manager->persist($demande);
        $demande->setObjet($request->request->get("objet"));
        $manager->persist($demande);
        $manager->flush();
        return $this->render('contact/contact.html.twig',[
            'demande' => 'Votre demande a été prise en compte'
        ]);
    }

    /**
     * @Route("/colab", name="colab")
     */
    public function colab(): Response
    {
        $colab = $this->getDoctrine()->getRepository(Demande::class)->findAll();
        return $this->render('contact/colab.html.twig', [
            'controller_name' => 'ContactController',
            'colab' => $colab,
        ]);
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function commande(): Response
    {
        $commande = $this->getDoctrine()->getRepository(Commande::class)->findAll();
        return $this->render('contact/commande.html.twig', [
            'controller_name' => 'ContactController',
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/commandebis", name="commandebiss")
     */
    public function commandebis(Request $request,
    EntityManagerInterface $manager): Response
    {

        $ids=$request->request->get("ids");
        return $this->render('contact/resultat.html.twig', [
            'controller_name' => 'ContactController',
            'demande' => $service,
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajout(): Response
    {
        
        return $this->render('contact/ajout.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/ajoutbis", name="ajoutbis")
     */
    public function ajoutbis(Request $request,
    EntityManagerInterface $manager): Response
    {
        $demande = new Commande();
        $demande->setService($request->request->get("service"));
        $manager->persist($demande);
        $demande->setPrix($request->request->get("prix"));
        $manager->persist($demande);
        $manager->flush();
        return $this->render('contact/ajout.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

}
