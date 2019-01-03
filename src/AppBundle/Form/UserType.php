<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class, //remplace l'appel à la classe en entier : 'Symfony\Component\Form\Extension\Core\Type\TextType;' en appellant directement la classe mise en "use" en début de fichier
                [
                    'label' => 'Pseudo',
                ]
            )
            ->add('lastname',
                TextType::class,
                [
                    'label' => 'Nom',
                ]
            )
            ->add('firstname',
                TextType::class,
                [
                    'label' => 'Prénom',
                ]
            )
            ->add('email',
                EmailType::class,
                [
                    'label' => 'Email',
                ]
            )
            ->add('avatar',
                FileType::class, //type de champ :: classe correspondante
                [
                    'label' => 'Avatar',
                    'required'  => false, //champ non obligatoire
                ]
            )
            ->add('plainPassword', // le mot de passe en clair qu'on ne va pas enregistrer en BDD
                RepeatedType::class, // repeatedType génère 2 champs qui doivent être identiques d'un coup => password et confirmation du password
                [ //partie options des champs
                    'type' => PasswordType::class, //... de type password
                    'first_options' => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Confirmez le mot de passe'],
                ]
            )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
