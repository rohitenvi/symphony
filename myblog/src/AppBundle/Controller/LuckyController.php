<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Psr\Log\LoggerInterface;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number" , name="propage")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }

    /**
    * @Route("/lucky/number/{max}")
    */


    public function numbAction($max, LoggerInterface $logger)
    {
      
       

       $logger->info('have a look');
       
             
       return new Response(
            '<html><body>Lucky number: '.$p.'</body></html>'
        );
    
    }


    /**
     * @Route("/admin/dashboard" , name="admindashboard")
     */
      
     public function admindashboard()
    {
        
   return $this->render('/admin/dashboard/dashboard.html.twig');
    }



}
