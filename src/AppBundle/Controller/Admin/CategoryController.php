<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        // va chercher toutes les catégories en bdd
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render(
            'admin/category/list.html.twig',
            [
                'categories' => $categories,
            ]
        );
    }
    
    /**
     * Quand on ne passe pas de "name" à la route,
     * son nom est généré automatiquement grâce à l'arborescence :
     * ici : app_admin_category_edit
     * 
     * @param int $id
     * @Route("/edit/{id}", defaults={"id": null})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id)) { // création
            $new = true;
            $category = new Category();
        } else { // modification
            $new = false;
            // raccourci pour $em->getRepository('AppBundle:Category')->find($id)
            $category = $em->find('AppBundle:Category', $id);
            
            // si il n'y a pas de catégorie avec cet id en bdd,
            // on redirige vers la liste
            if (is_null($category)) {
                return $this->redirectToRoute('app_admin_category_list');
            }
        }
        
        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request); // le formulaire analyse la requête HTTP 
        
        if ($form->isSubmitted()) { // si le formulaire a été envoyé
            if ($form->isValid()) { // s'il n'y a pas eu d'erreur de validation du formulaire
                $em->persist($category); //prépare l'enregistrement de l'object en bdd
                $em->flush(); // enregistre en bdd
                
                $msg = ($new)
                    ? 'La rubrique a bien été créée'
                    : 'La rubrique a bien été modifiée'
                ;
                $this->addFlash('success', $msg);
                return $this->redirectToRoute('app_admin_category_list');
            } else {
                // ajoute un message flash
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
            
        }
        
        return $this->render(
            'admin/category/edit.html.twig',
            [
                'new' => $new,
                'form' => $form->createView(),
            ]
        );
    }
    
    /**
     * @Route("/delete/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->find('AppBundle:Category', $id);
        
        if (is_null($category)) {
            return $this->redirectToRoute('app_admin_category_list');
        }
        
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'La rubrique a bien été supprimée');
        
        return $this->redirectToRoute('app_admin_category_list');
    }
}
