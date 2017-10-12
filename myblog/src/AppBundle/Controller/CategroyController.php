<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CategroyController extends Controller
{
        
     public  function getBreadcrumbs($cat) {
      $path = "";
       $div = " >> ";
          while ($cat != 0) {

              $em = $this->getDoctrine()->getManager();

              $RAW_QUERY = " SELECT * FROM category where  id=" .$cat . " ";
        
               $statement = $em->getConnection()->prepare($RAW_QUERY);
               $statement->execute();

               $row = $statement->fetchall();
               $row = $row [0];

              if ($row) {
               $path = $div.$row['name'].$path;
              $cat = $row['parentId'];
       
             }
       }


      if ($path != "") {
        $path = substr($path,strlen($div)); 
       }
         
        return $path;
      } 
     

    public  function getBreadcrumbsonfront($cat) {
       $path = "";
        $div = " >> ";
          while ($cat != 0) {
              $em = $this->getDoctrine()->getManager(); 
              $RAW_QUERY = " SELECT * FROM category where  id=" .$cat . " ";
               $statement = $em->getConnection()->prepare($RAW_QUERY);
               $statement->execute();
               $row = $statement->fetchall();
               $row = $row [0];
               if ($row) {
               $path = $div.$row['name'].$path;
              $cat = $row['parentId'];
              if($cat == 1 || $cat == 2 || $cat == 3 || $cat == 4)
                {
                      break;
                }}
               } /**end while **/

            if ($path != "") {
                $path = substr($path,strlen($div)); 
                }
                return $path;
      }

     public  function getCatparentID($cat) {

            while ($cat != 0) {
              $em = $this->getDoctrine()->getManager(); 
              $RAW_QUERY = " SELECT * FROM category where  id=" .$cat . " ";
               $statement = $em->getConnection()->prepare($RAW_QUERY);
               $statement->execute();
               $row = $statement->fetchall();
               $row = $row [0];
               if ($row) {
              $cat = $row['parentId'];
              if($cat == 1 || $cat == 2 || $cat == 3 || $cat == 4)
                {
                      break;
                }}
               }
              
               return $cat;
          }

     public function showTopcatAction($categoryId)
      {
        $category = $this->getDoctrine()
                     ->getRepository(Category::class)
                     ->find($categoryId);
      $catname = $category->getName();
           return $catname;
      }

    /**
     * @Route("/admin/cats/all", name="cats_list")
     */

   public function categoryindexAction()
    { 
        $allresources = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('fixed'=> '0') );

            $errors = array_filter($allresources);
        
      $topcategory = array();
      $cathierchy = array();

      if(!empty($errors)) {   
       foreach($allresources as $resource)
       {
       $gettheparentid = $this->getCatparentID((int)$resource->id);
       $catsname = $this->showTopcatAction((int)$gettheparentid );

        array_push($topcategory,$catsname);
       }
         foreach($allresources as $resourcecats)
         {
        
         $catheirchy  =  $this->getBreadcrumbsonfront((int)$resourcecats->parentId);

       array_push($cathierchy,$catheirchy);
         }
        }

    return $this->render('/admin/category/allcats.html.twig', array(
            'catdatas' => $allresources ,'topcats'=>$topcategory,'catsheirchy'=>$cathierchy

        
        ));
     }



     /**
     * @Route("/admin/cat/create", name="category_create")
     */

    public function creatercategoryAction()
    {
          $resourcecategory = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('deepest'=> '1') );


              $errors = array_filter($resourcecategory);
          if(!empty($errors))  {

            $catid = array();
         foreach($resourcecategory  as $resources)
          {
             array_push($catid ,(int)$resources->id);
     
          } 


          $cathierchy = array();

          foreach($resourcecategory  as $resources)
           {
               $catvals =  $this->getBreadcrumbs((int)$resources->id);
                array_push($cathierchy,$catvals);
           }

           $formattedcats = array_combine($catid ,$cathierchy);
           }
           

         
        return $this->render('/admin/category/createcat.html.twig',array(
            'catdatas' => $formattedcats 
        ));
    }

    
   /**
     * @Route("/admin/cat/savenew", name="category_save")
     */

    public function savecategoryAction(Request $request)
    {
            

           $newcat = new \AppBundle\Entity\Category();
           $newcat ->setName($_REQUEST['categoryname']);
           $newcat ->setParentId($_REQUEST['parentid']);
           $newcat ->setFixed(0);
           $newcat ->setCreatedTime(new \DateTime('now'));
           $newcat ->setUpdatedTime(new \DateTime('now'));
           $newcat ->setDeepest(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newcat);
            $em->flush();
            $this->addFlash('notice', 'Category is added');
            return $this->redirectToRoute('cats_list');
    }
    

     /**
     * @Route("/admin/cat/edit/{id}", name="cat_edit")
     * @Method({"GET"})
     */
       public function editAction($id, Request $request)
      {

          
        $resultcategory = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->find($id);
    
        if (empty($resultcategory)) {
            $this->addFlash('error','No Category Found');
            return $this->redirectToRoute('cats_list');
        }
         
          $topcategory = array();
          $cathierchy = array();

      $resourcecategory = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('deepest'=> '1') );
          
         $errors = array_filter($resourcecategory);


        if(!empty($errors))  {

            $catid = array();
         foreach($resourcecategory  as $resources)
          {
             array_push($catid ,(int)$resources->id);
     
          } 


          $cathierchy = array();

          foreach($resourcecategory  as $resources)
           {
               $catvals =  $this->getBreadcrumbs((int)$resources->id);
                array_push($cathierchy,$catvals);
           }

           $formattedcats = array_combine($catid ,$cathierchy);
           }




       
         return $this->render('/admin/category/editcat.html.twig', array(
          
            'catinfos' => $resultcategory,'deepcats'=> $formattedcats
        ));
        }


     
    /**
     * @Route("/admin/cat/edit/{id}", name="cat_edit_save")
     * @Method({"POST"})
     */
         
  public function editcategorysaveAction($id, Request $request)
    {
          $formsave  = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->find($id);

          $formresources =  $this->getDoctrine()
                ->getRepository('AppBundle:Resources')
                ->findBy(array('category'=> $id ) );

          $errors = array_filter($formresources);   

         if (empty($formsave)) {
            $this->addFlash('error','No Resource is Found');
            
            return $this->redirectToRoute('cats_list');
           }

           
            if(isset($_REQUEST)){
           
           $formsave ->setName($_REQUEST['categoryname']);
          $formsave ->setParentId($_REQUEST['parentid']);
           $formsave->setUpdatedTime(new \DateTime('now'));
             $em = $this->getDoctrine()->getManager();
             $em->persist($formsave);
             $em->flush();

                     
         if(!empty($errors))
         {

           foreach($formresources as $formresource)
           {
            $formresource->setCategoryid($_REQUEST['parentid']);
            $em = $this->getDoctrine()->getManager();
             $em->persist($formresource);
             $em->flush();

           }


         }

       $this->addFlash('notice', 'Category is updated');
            return $this->redirectToRoute('cats_list');
            }

           return $this->render('/admin/resources/editresources.html.twig'
        );
     }

     /**
     * @Route("/admin/cat/delete/{id}", name="cat_delete")
     */
    public function categorydeleteAction($id)
    {
        $deletecat = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                 ->find($id);
         $catresource = $this->getDoctrine()
                ->getRepository('AppBundle:Resources')
                 ->findBy(array('categoryid'=> $id) );
         
         $errors = array_filter($catresource);


      if (empty($deletecat)) {
            $this->addFlash('error', 'No Category is found');
            
            return $this->redirectToRoute('cats_list');
          }
        

          if(!empty($errors))
         {

           foreach($catresource as $catsource)
           {
             $catsource->setCategoryid('0');
             $em = $this->getDoctrine()->getManager();
             $em->persist($catsource);
             $em->flush();

           }
         }

        $em = $this->getDoctrine()->getManager();
        $em->remove($deletecat);
         $em->flush();


        
        $this->addFlash('notice', 'Category is  removed');
       
        return $this->redirectToRoute('cats_list');
    }
    
}

  
 


