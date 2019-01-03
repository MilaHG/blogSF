<?php

namespace AppBundle\Entity; //Contrainte de validation spécifique car liée à Doctrine


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
// pour valider les champs uniques on demande à Doctrine de faire une requête de vérif en BDD => sur la classe et non sur le champ (plainPassword ici)

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Un utilisateur existe déjà avec cet email")
 * @UniqueEntity(fields="username", message="Un utilisateur existe déjà avec ce pseudo")
 */
class User implements UserInterface, Serializable // sérialiser un objet => pour un objet on le transforme en chaine de caractères
//        pour stocker l'utilisateur en session et à l'issue de la session il transforme à nouveau la chaine de caractères pour reformer
        // notre objet
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
     * @ORM\Column(type="string", length=30, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max="30")
     */
    private $username;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     *
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $lastname;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $firstname;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $role = 'ROLE_USER'; // c'est par convention qu'on écrit ROLE_XXX en majuscules
    // ici on donne par défaut le role de USER, si on ne précise pas un autre rôle (Admin, Gestionnaire...)
    
    /**
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Image()
     */
    //par défaut les mappings nous créent des champs NOT NULL donc il faut préciser autrement au besoin
    private $avatar;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(min="6")
     */
    // par de mapping ORM ici pour ne pas récupérer en BDD un MDP non encrypté
    private $plainPassword; // on récupère le password en clair avant de le crypter et de le stocker en BDD crypté sur l'attribut password
    
    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     */
    private $articles;
    // correspond au "inversedBy" dans l'entité Article - attribut/variable author
    // mappedBy="author" => champ dans la classe article
    
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
    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
        return $this;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    //rajouts pour la sécurité MDP du User
    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return [$this->role]; //on passe un tableau car on pourrait attribuer plusieurs rôles à un même utilisateur
    }

    public function getSalt() {
        return null;
    }

    public function serialize() { 
        return serialize([ //attributs qu'on veut conserver pendant la session => permet de passer l'utilisateur en session et de lui 
            // laisser faire ses allers-retours de pages en pages
            $this->id,
            $this->username,
            $this->lastname,
            $this->firstname,
            $this->email,
            $this->avatar,
            $this->password,
       ]);
    }

    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->lastname,
            $this->firstname,
            $this->email,
            $this->avatar,
            $this->password
        ) = unserialize($serialized);
    }

    public function getArticles() {
        return $this->articles;
    }

    public function setArticles(ArrayCollection $articles) {
        $this->articles = $articles;
        return $this;
    }
    
    // les 2 méthodes qui suivent ne sont pas obligatoires
    // optionnels pour le cas ou l'on fait ajouter/supprimer article depuis User
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        $article->setAuthor($this);
        
        return $this;
    }
    
    public function removeArticle(Article $article) 
    {
        $this->articles->removeElement($article);
    }
    
    /**
     * 
     * @return string
     */
    public function getFullName() {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }
    
}

