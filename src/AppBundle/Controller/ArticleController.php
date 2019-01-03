<?php

namespace AppBundle\Controller;

use AppBundle\Form\CommentType;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * 
     * @param Request $request
     * @param int $id
     * @Route("/article/{id}")
     */
    public function displayAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->find('AppBundle:Article', $id);
        
        if (is_null($article)) {
            throw $this->createNotFoundException(); // jette une 404
        }
        
        // pour récupérer nos commentaires déjà postés afin de les afficher dans la view
        $comments = $em->getRepository('AppBundle:Comment')->findAllByArticle($article);
        
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        
        //traiter la requete s'il y a des choses à faire
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) { // on fait un setter pour ce qui n'est pas dans le formulaire 
            // car handleRequest récupère les informations s'il y a eu du $_POST dans le formulaire et les mapper avec l'entity
                $comment
                    ->setArticle($article)
                    ->setUser($this->getUser())
                ;
                
                $em->persist($comment);
                $em->flush();
                
                $this->addFlash('success', 'Votre commentaire a été bien ajouté.');
                
                // $request->get('_route') permet d'avoir la route courante en actualisant la page de sorte que l'utilisateur
                // ne poste pas à nouveau le même commentaire
                return $this->redirectToRoute($request->get('_route'), ['id' => $id]);
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs.');
            }
        }
        
        return $this->render(
            'article/display.html.twig',
            [
                'article'   => $article,
                'form'  => $form->createView(), //créé une instance du formulaire que l'on peut exploiter directement
                // dans la view avec les form_start et form_row
                'comments'   => $comments,
            ]
        );
    }
    
}
