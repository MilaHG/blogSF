<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    // pas de route ici car on génère juste un bout de code HTML pour afficher les
    // catégories dans la barre de nav
    public function menuAction() {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render(
            'category/menu.html.twig',
            [
                 'categories'   => $categories,
            ]
        );
    }
    
    /**
     * @Route("/category/{id}")
     */
    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->find('AppBundle:Category', $id);
        
        if (is_null($category)) {
            throw $this->createNotFoundException(); // jette une 404
        } // throw lance une exception
        
        // afficher les derniers articles par catégorie
        $articles = $em->getRepository('AppBundle:Article')->findLatest(3, $category); //on passe un filtre sur les catégories en 27me paramètre
        return $this->render(
            'category/display.html.twig',
            [
                'category'  => $category,
                'articles'  => $articles,
            ]
            
        );
    }
    
}
