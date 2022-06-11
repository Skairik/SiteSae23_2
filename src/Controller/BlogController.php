<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Demande;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/cv", name="cv")
     */
    public function cv()
    {
        return $this->render('blog/cv.html.twig');
    }

     /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolio()
    {
        return $this->render('blog/portfolio.html.twig');
    }

    /**
     * @Route("/cca", name="cca")
     */
    public function cca()
    {
        return $this->render('blog/cca.html.twig');
    }

    /**
     * @Route("/ccb", name="ccb")
     */
    public function ccb()
    {
        return $this->render('blog/ccb.html.twig');
    }

    /**
     * @Route("/ccc", name="ccc")
     */
    public function ccc()
    {
        return $this->render('blog/ccc.html.twig');
    }

    /**
     * @Route("/ensavoirplus", name="ensavoirplus")
     */
    public function ensavoirplus()
    {
        return $this->render('blog/passion.html.twig');
    }

    /**
     * @Route("/contact", name="contect")
    */
    public function contact()
    {
        return $this->render('blog/contact.html.twig',[
            'demande' => ''
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
        $demande->persist($entname);
        $demande->flush();
        $demande->setName($request->request->get("name"));
        $demande->persist($nom);
        $demande->flush();
        $demande->setMail($request->request->get("mail"));
        $demande->persist($mail);
        $demande->flush();
        $demande->setObjet($request->request->get("objet"));
        $demande->persist($objet);
        $demande->flush();
        return $this->render('blog/contact.html.twig',[
            'demande' => 'Votre demande a été prise en compte'
        ]);
    }
}
