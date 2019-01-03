<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) // affiche par défaut la page d'accueil de Symfony
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findLatest(3);
        
        return $this->render(
            'default/index.html.twig', 
            [
                'articles'  => $articles, // variable ('articles') à laquelle on passe une valeur (=> $articles,)
                //c'est cette variable qui est disponible dans le fichier twig pour sa mise en page
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            ]
        );
    }
    
    /**
     * @Route("/hello", name="hello")
     */
    public function helloAction() {
        
        $name = 'Mila';
        $array = ['je', 'tu', 'il'];
        $int = 3;
        $html = '<p>paragraphe</p>';
        $date = new \DateTime();
        
        return $this->render(
            'default/hello.html.twig',
            [
                'hello' => 'Bonjour',
                'name'  => $name,
                'pronoms' => $array,
                'int'   => $int,
                'html'  => $html,
                'now'   => $date,
            ]
        );
    }
    
    /**
     * 
     * @param string $name
     * @return Response
     * @Route("/hi/{name}", name="hi")
     */
    public function hiAction($name) { 
        return $this->render(
                'default/hi.html.twig',
                [
                    'name'  => $name,
                ]
        );
    }
    
    /**
     * @param string $firstname
     * @param string $lastname
     * @return Response
     * @Route("hifull/{firstname}-{lastname}", defaults={"lastname":""})
     */
    public function hiFull($firstname, $lastname) {
        $name = $firstname;
        
        if ($lastname != '') {
            $name .= ' ' . $lastname;
        }
        // ici lastname est optionnel
        // http://localhost/symfony/web/hi/Mila-G
        
        return $this->render( //on appelle le template .html.twig pour obtenir une page html en réponse avec le contenu ci-dessous
                'default/hi.html.twig',
                [
                    'name'  => $name,
                ]
        );
    }
    
}
