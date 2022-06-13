<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


use App\Entity\Demande;

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
        $colab = $this->getDoctrine()->getRepository(Demande::class)->findAll();
        return $this->render('contact/commande.html.twig', [
            'controller_name' => 'ContactController',
            'colab' => $colab,
        ]);
    }
}
