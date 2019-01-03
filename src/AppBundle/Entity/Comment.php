<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
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
     * @Assert\NotBlank()
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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;
    // le \DateTime permet de sortir du namespace AppBundle\Entity et d'utiliser 
    // le namespace global (sinon il faudrait ajouter "use DateTime")
    
    /**
     *
     * @var Article
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     */
    private $article;
    //plusieurs commentaires pour un même article
    // @ORM\ManyToOne(targetEntity="Article") => mapping objet user
    // @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false) => mapping tables - BDD
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;
    //plusieurs commentaires pour un même utilisateur

    public function __construct() 
    {
        $this->date = new \DateTime(); // sans paramètres c'est la date à l'instant T    
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
    
    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getDate() {
        return $this->date;
    }

    public function getArticle() {
        return $this->article;
    }

    public function getUser() {
        return $this->user;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
        return $this;
    }

    public function setArticle(Article $article) {
        $this->article = $article;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }


    
}

