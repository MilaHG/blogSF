<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * ArticleController
 *
 * @Route("/article")
 */
class ArticleController extends Controller 
{
    /**
     * 
     * @return type
     * @Route("/list")
     */
    public function listAction() 
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findAll();
        
        return $this->render(
            'admin/article/list.html.twig',
            [
                'articles' => $articles,
            ]
        );
    }
    
    /**
     * @Route("/edit/{id}", defaults={"id": null})
     */
    public function editAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id)) // création
        {
            $new = true;
            $article = new Article();
            $article->setAuthor($this->getUser()); // $this->getUser => on passe l'utilisateur connecté
        } else { // modification
            $new = false;
            $article = $em->find('AppBundle:Article', $id);
            
            if (is_null($article)) { // si pas d'article correspondant en BDD à l'id passé, renvoi sur la liste des articles
                return $this->redirectToRoute('app_admin_article_list');
            }
        }
        
        $form = $this->createForm(ArticleType::class, $article);
        
        $form->handleRequest($request); // vérification si formulaire envoyé (a-t-on du $_POST ?)
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();
                
                $msg = ($new)
                    ? "L'article a bien été créé."
                    : "L'article a bien été modifié."
                ;
                
                $this->addFlash('success', $msg);
                
                return $this->redirectToRoute('app_admin_article_list');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }
        
        return $this->render(
            'admin/article/edit.html.twig',
            [
                'new'  => $new,
                'form'  => $form->createView(),
            ]
        );
    }
    
    /**
     * 
     * @Route("/delete/{$id}")
     */
    public function deleteAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        
        $article = $em->find('AppBundle:Article', $id);
            
        if (is_null($article)) { // si pas d'article correspondant en BDD à l'id passé, renvoi sur la liste des articles
            return $this->redirectToRoute('app_admin_article_list');
        }
        
        $em->remove($article);
        $em->flush();
        
        $this->addFlash('success', "L'article a bien été supprimé");
                
        return $this->redirectToRoute('app_admin_article_list');
    }
    
}
