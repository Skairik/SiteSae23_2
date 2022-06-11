<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function home(): Response
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/cv", name="cv")
     */
    public function cv(): Response
    {
        return $this->render('blog/cv.html.twig');
    }

    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolio(): Response
    {
        return $this->render('blog/portfolio.html.twig');
    }

    /**
     * @Route("/cca", name="cca")
     */
    public function cca(): Response
    {
        return $this->render('blog/cca.html.twig');
    }

    /**
     * @Route("/ccb", name="ccb")
     */
    public function ccb(): Response
    {
        return $this->render('blog/ccb.html.twig');
    }

    /**
     * @Route("/ccc", name="ccc")
     */
    public function ccc(): Response
    {
        return $this->render('blog/ccc.html.twig');
    }

    /**
     * @Route("/ensavoirplus", name="ensavoirplus")
     */
    public function ensavoirplus(): Response
    {
        return $this->render('blog/passion.html.twig');
    }
}
