<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

use App\Entity\Demande;
use App\Entity\Commande;
use App\Entity\Prestation;
use App\Entity\ListeCommande;

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
     * @Route("/listepresta", name="listepresta")
     */
    public function listepresta(): Response
    {
        $commande = $this->getDoctrine()->getRepository(Prestation::class)->findAll();
        return $this->render('contact/listepresta.html.twig', [
            'controller_name' => 'ContactController',
            'commande' => $commande,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/commande", name="commande")
     */
    public function commande(): Response
    {
        $presta = $this->getDoctrine()->getRepository(Prestation::class)->findAll();
        return $this->render('contact/commande.html.twig', [
            'controller_name' => 'ContactController',
            'presta' => $presta,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/commandebis", name="commandebis")
     */
    public function commandebis(Request $request,
    EntityManagerInterface $manager,Security $security): Response
    {
        $ids=$request->request->get("ids");
        $user=$security->getUser();
        foreach($ids as $id){
            $prest=$manager->getRepository(Prestation::class)->find($id);
            $user->addCommande($prest);

        }
        $manager->flush();
        return $this->render('contact/commandebis.html.twig', [
            'controller_name' => 'ContactController',
        ]);

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/panier", name="panier")
     */
    public function panier(Security $security): Response
    {
        $user=$security->getUser();
        $iduser=($user->getId());
        $panier = ($user->getCommande());
        return $this->render('contact/panier.html.twig', [
            'controller_name' => 'ContactController',
            'panier' => $panier,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/supprpanier", name="suppr")
     */
    public function suppr(Request $request,
    EntityManagerInterface $manager,Security $security): Response
    {
        $suppr=$request->request->get("suppr");
        $user=$security->getUser();
        foreach($suppr as $supp){
            $prest=$manager->getRepository(Prestation::class)->find($supp);
            $user->removeCommande($prest);
        }
        $manager->flush();
        $user=$security->getUser();
        $iduser=($user->getId());
        $panier = ($user->getCommande());
        return $this->render('contact/panier.html.twig', [
            'controller_name' => 'ContactController',
            'panier' => $panier,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/final", name="final")
     */
    public function final(Request $request,
    EntityManagerInterface $manager,Security $security): Response
    {
        $suppr=$request->request->get("suppr");
        /*Récupère le total*/
        $prixs=$request->request->get("prix");
        $total=0;
        foreach($prixs as $prix)
            $total=$total+(int)$prix;
        /*Je récupe la list de ce qu'il a prix*/
        $noms=$request->request->get("nom");
        $nom=implode(", ", $noms); // string(20) "lastname,email,phone"
        dump($nom);
        $user=$security->getUser();
        $iduser=($user->getId());
        /*Je recupe le nom du mec*/
        $nomuser=($user->getEmail());

        /*Ajout base de données commande*/
        $demande = new ListeCommande();
        $demande->setNom($nomuser);
        $manager->persist($demande);
        $demande->setPrix($total);
        $manager->persist($demande);
        $demande->setPrestation($nom);
        $manager->persist($demande);
        $manager->flush();

        /*Suppr du panier*/
        foreach($suppr as $supp){
            $prest=$manager->getRepository(Prestation::class)->find($supp);
            $user->removeCommande($prest);
        }
        $manager->flush();
        return $this->render('contact/fini.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/affiche", name="affiche")
     */
    public function affiche(Request $request,
    EntityManagerInterface $manager): Response
    {
        $affiche=$manager->getRepository(ListeCommande::class)->findAll();
        dump($affiche);
        return $this->render('contact/affiche.html.twig', [
            'controller_name' => 'ContactController',
            'affiche'=>$affiche,
        ]);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/ajoutbis", name="ajoutbis")
     */
    public function ajoutbis(Request $request,
    EntityManagerInterface $manager): Response
    {
        $demande = new Prestation();
        $demande->setNom($request->request->get("service"));
        $manager->persist($demande);
        $demande->setPrix($request->request->get("prix"));
        $manager->persist($demande);
        $manager->flush();
        return $this->render('contact/ajout.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

}
