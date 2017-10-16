<?php
// src/AppBundle/Controller/BlogController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlogController extends Controller
{
     /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page": "\d+"})
     */

    public function listAction($page = 1)
    {
       
     

        return new Response(
            '<html><body>Lucky number: '.$page.'</body></html>'
        );
    }

    /**
     * Matches /blog/*
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function showAction($slug)
    {
       $url = $this->generateUrl('blog_show', array('slug' => $slug), UrlGeneratorInterface::ABSOLUTE_URL);

        return new Response(
            '<html><body>Lucky number: '.$url.'</body></html>'
        );
    }
}