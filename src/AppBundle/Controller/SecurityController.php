<?php

namespace AppBundle\Controller; // permet de récupérer toutes les infos des requêtes HTTP en $_POST et $_GET


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
    /**
     *
     * @Route("/register")
     */
    public function registerACtion(Request $request) 
    { // création du compte d'un user
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) { //vérifie les règles de validation @Assert du formulaire
                //encoder le MDP: nécessite la configuration "encoders" dans app/config/security.yml
                // et que la classe User implémente UserInterface
                $passwordEncoder = $this->get('security.password_encoder');// ceci est un service (dans la configuration de 
                //notre MVC, ou ici on prend celui déjà existant dans S3) container d'injection de dépendances = brique 
                //logicielle du framework vérifie si les classes ont besoin d'autre chose pour être instanciées et 
                //qu'elles ont eu ce qu'il leur fallait
                // c'est la même chose quand on appelle getDoctrine, on appelle en service Doctrine
                // $this->get permet au controller d'accéder aux containers de service de Symfony pour accéder 
                // aux instances des autres classes dépendantes
                $user->setPassword(
                    $passwordEncoder->encodePassword($user, $user->getPlainPassword())
                );
                
                //TEST OK// var_dump($user->getPassword());
                
                // récupérer l'image "avatar" uploadée
                // nécessite qu'existe le paramètre "upload_dir"
                // et que le répertoire web/upload soit créé
                
                // Le commentaire qui suit est indicatif. Il précise
                // que l'on a dans $avatar une instance de "UploadedFile" ou null
                // En outre, comme l'avatar est optionnel on ajoute |null
                /** @var Symfony\Component\HttpFondation\UploadedFile|null */
                $avatar = $user->getAvatar();
                
                if (!is_null($avatar)) {
                    // on donne un nom unique au fichier que l'on va enregistrer
                    // ici on utilise la fonction uniqid() pour donner un id unique à chaque fichier
                    // md5 encrypte et limite la longueur du nom du fichier (fonction native PHP) ici 32 caractères, pour avoir
                    // tous les fichiers de la même taille après l'id unique
                    $fileName = md5(uniqid()) . '.' . $avatar->guessExtension();
                    
                    // gère le move_uploadedFile() vers notre répertoire d'upload depuis le /tmp
                    // 1er paramètre : répertoire de destination
                    // 2nd paramètre : nom du fichier dans le répertoire de destination
                    $avatar->move(
                        $this->getParameter('upload_dir'),
                        $fileName
                    );
                    
                    // on va stocker le nom du fichier en BDD pour notre User
                    $user->setAvatar($fileName);
                }
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                $this->addFlash('success', 'Votre compte est créé.');
                
                return $this->redirectToRoute('homepage');
                
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs !');
            }
        }
        
        return $this->render(
            'security/register.html.twig',
            [
                 'form' => $form->createView(),
            ]
        );
    }
    
    /**
     * 
     * @param Request $request
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        
        if ($request->isMethod('POST') && is_null($error)) {
            return $this->redirectToRoute('homepage');
        }
        
        $lastUsername = $authenticationUtils->getLastUsername(); //on repasse le username pour que l'user 
        //n'ait pas à le retapper (pas le MDP qui devra l'être)
        
        return $this->render(
            'security/login.html.twig',
            [
                'last_username'    => $lastUsername,
                'error' => $error,
            ]
        );
    }
    
}
