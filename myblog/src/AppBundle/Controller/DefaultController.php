<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\News;
use AppBundle\Entity\Category;
use AppBundle\Entity\ResourceType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontend/homepage.html.twig');
    }
      
    /**
     * @Route("/latest-news", name="latestnews")
     */
       public function latestnewsAction(Request $request)
    {
    
        $news = $this->getDoctrine()
                ->getRepository('AppBundle:News')
                ->findAll();


        return $this->render('frontend/latestnews.html.twig',array(
            'allnews' => $news
        ));
    }
     
    /**
     * @Route("/news/{slug}/{id}", name="singlenews_list")
     */


     public function showooooAction($slug,$id)
    {
        // $slug will equal the dynamic part of the URL
        // e.g. at /blog/yay-routing, then $slug='yay-routing'

        $singledata = $this->getDoctrine()
                ->getRepository('AppBundle:News')
                ->find($id);
         
       
    return $this->render('frontend/singlenews.html.twig',array(
            'allnews' =>$singledata));

    }


   /**
    *@Route("/contact-us", name="contactus")
    */

    public function contactusAction()
    {
        return $this->render('frontend/contactus.html.twig');

    }

   /**
    *@Route("/project-team", name="projecteam")
    */

    public function teamembersAction()
    {
        return $this->render('frontend/team.html.twig');

    }
    

   /**
    *@Route("/behaviour-diagram", name="behaviourdiagram")
    */

    public function BehaviourDiagramAction()
    {
        return $this->render('frontend/behaviourdiagram.html.twig');

    }

    /**
    *@Route("/behavioural-science", name="behaviourscience")
    */
    
     public function BehaviourAction()
    {
        

       $outcomecats = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('parentId'=> '5','fixed'=>'0') );
        
        $outcomeerrors = array_filter($outcomecats);
        
         if(!empty($outcomeerrors)){
        foreach($outcomecats as $singleoutcomecat)
          {

            $singleoutcomecat->getId();

          }  
         }

        return $this->render('frontend/behaviour.html.twig',array(
            'outcomecats' =>$outcomecats));

    }
    
    /**
    *@Route("/computer-science", name="computerscience")
    */
    
     public function ComputerScienceAction()
    {
        
        $computerscience = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('parentId'=> '3','fixed'=>'0') );

        $resourcetypes = $this->getDoctrine()
                ->getRepository('AppBundle:ResourceType')
                ->findAll();

        return $this->render('frontend/computerscience.html.twig',array('allcomputerscats'=>$computerscience ,'allresourcetypes'=> $resourcetypes  ));

    }

    /**
    *@Route("/system-architecture", name="systemarchitect")
    */
    
     public function SystemArchitectureAction()
    {
        return $this->render('frontend/systemarchitect.html.twig');

    }
    
    /**
    *@Route("/all-resources", name="allresources")
    */
    public function AllResourcesAction()
    {
        return $this->render('frontend/allresources.html.twig');

    }

    /**
     *@Route("/resources", name="singleresource")
     */
    public function SingleResourcesAction()
    {
        return $this->render('frontend/singleresource.html.twig');

    }


    /**
     * @Route("/admin/dashboard" , name="admindashboard")
     */
      
     public function admindashboard()
    {
        
   return $this->render('/admin/dashboard/dashboard.html.twig');
    }

}
