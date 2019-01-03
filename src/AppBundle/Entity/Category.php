<?php

namespace AppBundle\Entity; //permet de nous ajouter des contraintes de validation de formulaire sur les champs

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// avec "as Assert\Regex" on aurait pu utiliser les expressions régulières en librairie Symfony (date, length, email...)

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Le nom de la rubrique est obligatoire !")
     * @Assert\Length(max="20", maxMessage="Le nom de la rubrique ne doit pas dépasser {{ limit }} caractères !")
     */
    //max="20", maxMessage="Le nom de la rubrique ne doit pas dépasser {{ limit }} ca...
    // {{ limit }} est une variable Symfony qui va aller chercher le nombre max quand il voit {{ limit }} dans maxMessage, idem pour min et minMessage
    private $name;
    
    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category")
     */
    private $articles;
    // correspond au "inversedBy" dans l'entité Article - attribut/variable category
    // mappedBy="category" => champ dans la classe article
    
    public function __construct() 
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles(ArrayCollection $articles) {
        $this->articles = $articles;
        return $this;
    }

    public function __toString() // affiche l'attribut 'name' de la catégorie - transforme l'objet en chaine de caractères
    { 
        return $this->name;
    }

}

