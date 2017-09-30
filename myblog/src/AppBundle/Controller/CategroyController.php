<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CategroyController extends Controller
{
    /**
     * @Route("/admin/cats/all", name="cats_list")
     */
    public function categoryindexAction()
    { 
        $allresources = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findBy(array('fixed'=> '0') );
        

       return $this->render('/admin/category/allcats.html.twig', array(
            'catdatas' => $allresources 
        ));
    }

  
     /**
     * @Route("/admin/cat/create", name="category_create")
     */

    public function creatcategoryAction(Request $request)
    {
        $resoucedata = new \AppBundle\Entity\Category();
        $atrributes = array('class' => 'form-control' , 'style' => 'margin-bottom:15px');
       $form = $this->createFormBuilder($resoucedata)
                ->add('name', TextType::class, array('attr' => $atrributes, 'label' => 'Category Name'))
              ->add('parentId', EntityType::class, array(
    'class' => 'AppBundle:Category',
    'choice_label' => 'name',
     'choice_value' => 'id',
     'label' =>'Parent Category',
     'attr'=> $atrributes,
     'query_builder' => function (EntityRepository $er) {
        return $er->createQueryBuilder('u')->where('u.fixed != 0');
            
    },
     
))
               
                ->add('save', SubmitType::class, array('label' => 'Create Category', 'attr' => array('class' => 'btn btn-primary')))
                ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
           $resoucedata->setName($form['name']->getData());
           $resoucedata->setParentId($resoucedata->getParentId());
           
       
            $resoucedata->setFixed(0);
             $resoucedata->setCreatedTime(new \DateTime('now'));
           $resoucedata->setUpdatedTime(new \DateTime('now'));
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($resoucedata);
            $em->flush();
            
            $this->addFlash('notice', 'Category  is created');
            return $this->redirectToRoute('cats_list');
           
        }
       
        
        return $this->render('/admin/category/createcat.html.twig', array(
            'form' => $form->createView()
        ));
    }




       /**
     * @Route("/admin/cat/edit/{id}", name="cat_edit")
     */
    public function editAction($id, Request $request)
    {

          
        $todo = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->find($id);
    
         
     
        if (empty($todo)) {
            $this->addFlash('error','No Category Found');
            
            return $this->redirectToRoute('cats_list');
        }


        $atrributes = array('class' => 'form-control' , 'style' => 'margin-bottom:15px');
      
              
       $form = $this->createFormBuilder($todo)
                ->add('name', TextType::class, array('attr' => $atrributes))
                ->add('parentId', EntityType::class, array(
                      'class' => 'AppBundle:Category',
                      'choice_label' => 'name',
                      'choice_value' => 'id',
                      'query_builder' => function (EntityRepository $er) use ($id) {
        return $er->createQueryBuilder('u')
                 ->where('u.id != :id')->andWhere('u.fixed != 0')
               ->setParameter('id',$id);
           
    },
                      'label' =>'Parent Category',
                      'attr'=> $atrributes
                    ))
                ->add('save', SubmitType::class, array('label' => 'Update Category', 'attr' => array('class' => 'btn btn-primary')))
                ->getForm();
    
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $todo->setName($form['name']->getData());
            $todo->setParentId($todo->getParentId());
            $todo->setUpdatedTime(new \DateTime('now'));
           $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            
            $this->addFlash('notice', 'Category is updated');
            return $this->redirectToRoute('cats_list');
            
        }
        
        return $this->render('/admin/category/editcat.html.twig', array(
            'form' => $form->createView(),
            'todo' => $todo
        ));
        }


     /**
     * @Route("/admin/cat/delete/{id}", name="cat_delete")
     */
    public function categorydeleteAction($id)
    {
        $deletecat = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                 ->find($id);
        
        dump($deletecat);
        if (empty($deletecat)) {
            $this->addFlash('error', 'No Category is found');
            
            return $this->redirectToRoute('cats_list');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($deletecat);
        $em->flush();
        
        $this->addFlash('notice', 'Category is  removed');
       
        return $this->redirectToRoute('cats_list');
    }

    
}

  
 


