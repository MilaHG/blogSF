<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Titre',
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => 'Contenu',
                    'required' => false, // désactivé pour fonctionnement du WYSIWYG
                    'attr'  => ['class' => 'wysiwyg', 'style' => 'height: 200px'], // options attr = attributs du champ 
                    //de formulaire ajoutés dans la balise HTML
                ]
            )
            ->add(
                'description',
                 TextareaType::class,
                [
                    'label' => 'Description courte',
                ]
            )
            ->add(
                'category',
                EntityType::class, // créé un select sur une entité // pour un bouton radio ChoiceType
                [
                    'label' => 'Rubrique',
                    'class' => 'AppBundle:Category', // nom de l'entité
                    'choice_label'  => 'name', // le champ de l'entité qui va s'afficher dans les options
                    'placeholder'   => 'Choisissez une rubrique' // pour avoir une 1ère option vide
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
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function getBlockPrefix()
//    {
//        return 'appbundle_article';
//    }


}
