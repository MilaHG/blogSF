<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactController extends Controller
{
    /**
     * 
     * @param Request $request
     * @Route("/contact")
     */
    public function indexAction(Request $request) 
    {
        $formBuilder = $this->createFormBuilder(); // le formBuilder ne va pas prendre de données pour les rentrer
        // en BDD - on aura pas de mapping, nous pouvons donc donner des contraintes 'Assert' directement dans notre controller
        //il va nous servir à nous envoyer un email
        
        $formBuilder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                    'constraints'   => new NotBlank
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email',
                    'constraints'   => [
                        new NotBlank(),
                        new Email(),
                    ]
                ]
            )
            ->add(
                'subject',
                TextType::class,
                [
                    'label' => 'Sujet',
                    'constraints'   => new NotBlank()
                ]
            )
            ->add(
                'body',
                TextareaType::class,
                [
                    'label' => 'Votre texte',
                    'constraints'   => new NotBlank(),
                ]
            )
        ;
        
        $form = $formBuilder->getForm();
        
        if ($this->getUser()) { // si un utilisateur est connecté avec $form->get on le récupère et setData récupère 
        // les données pour pré-remplir les champs du formulaire
            $form->get('name')->setData($this->getUser()->getFullName());
            $form->get('email')->setData($this->getUser()->getEmail());
        }
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data = $form->getData(); // renvoie un tableau avec le nom des champs en clé puisqu'on n'a pas d'entité mappée
                
                /** @var \Swift_Mailer */
                // utilitaire d'envoi de mails utilisé dans Symfony
                // la fonction mail() native de PHP est plus compliquée à utiliser
                $mailer = $this->get('mailer');
                $mail = $mailer->createMessage();
                
                $mailContent = "<h3>Nouveau message de ${data['name']} (${data['email']})</h3>" . '<p><b>' . $data['subject'] . '</b></p>' .'<p>'. nl2br($data['body']) . '</p>';
                
                $mail
                    ->setSubject('Nouveau message sur votre blog')
                    ->setFrom($this->getParameter('contact_email'))
                    ->setTo($this->getParameter('contact_email'))
                    ->setBody($mailContent)
                    ->setReplyTo($data['email'])
                ;
                
                $mailer->send($mail);
                $this->addFlash('success', 'Votre message a bien été envoyé.');
                
            } else {
                $this->addFlash('error', 'Le forumlaire contient des erreurs.');
            }
        }
        
        return $this->render(
            'contact/index.html.twig',
            [
                'form'  => $form->createView(),
            ]
        );
    }
}
