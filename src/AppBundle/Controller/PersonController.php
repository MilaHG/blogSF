<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PersonController extends Controller
{
    /**
     * @Route("/person/list")
     */
    public function listAction()
    {
        // EntityManager de Doctrine
        $em = $this->getDoctrine()->getManager(); //relation avec BDD par notre entity manager (em par convention)
        // Nous permet d'accéder au repository de la classe Person
        $repository = $em->getRepository('AppBundle:Person');
//        echo get_class($repository);
        // Le repository permet de requêter la BDD (ici un SELECT *)
        $persons = $repository->findAll();
        
        return $this->render('person/list.html.twig', array(
            'persons' => $persons,
        ));
    }
    
    /**
     * 
     * @param int $id
     * @return Response
     * @Route("/person/{id}", requirements={"id":"\d+"})
     */
//    requirements={"id":"\d+"} expression régulière qui permet d'indiquer qu'on attend un entier(int)
    public function findAction($id) {
        $em = $this->getDoctrine()->getManager(); 
        $repository = $em->getRepository('AppBundle:Person');
        // find fait une recherche sur l'id par défaut -> on ne peut pas lui passer un autre paramètre
        $person = $repository->find($id);
         
        return $this->render('person/find.html.twig', array(
            'person' => $person,
        ));
    }
    
    /**
     * 
     * @param string $firstname
     * @return Response
     * @Route("/person/{firstname}")
     */
    public function findByFirstname($firstname) {
        $em = $this->getDoctrine()->getManager(); 
        $repository = $em->getRepository('AppBundle:Person');
        // findOneBy fait une requête avec un filtre et ne renvoie qu'un résultat (le 1er trouvé)
        $person = $repository->findOneBy(['firstname' => $firstname]);
        
        // findBy fonctionne pareil mais peut retourner plusieurs résultats
        return $this->render('person/find.html.twig', array(
            'person' => $person,
        ));
    }

}
