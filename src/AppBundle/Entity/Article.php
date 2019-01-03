<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le titre est obligatoire")
     */
    private $title;
    
    /**
     *
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;
    
    /**
     *
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     */
    private $author;
    // clé étrangère N-to-1 
    // @ORM\ManyToOne(targetEntity="User", inversedBy="articles") : relation entre les objets
    // le User peut avoir plusieurs articles
    // 'inversedBy' dans table User le champ/attribut 'articles' contient la liste des articles
    // pour cet utilisateur
    // @JoinColumn(name="author_id", referencedColumnName="id", nullable=false) : relation entre les tables
    // dans table article champ clé étrangère est défini comme 'author_id', il référénce notre 'id' dans la 
    // table 'user', non nullable (à bien préciser car une clé étrangère est nullable par défaut)
    
    /**
     *
     * @var Category 
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="Vous devez sélectionner une rubrique !")
     */
    private $category;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
        return $this;
    }


    
}

