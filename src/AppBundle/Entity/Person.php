<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
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
     */
    private $firstname;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     */    
    private $lastname;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;
    
    /**
     *
     * @var \DateType
     * @ORM\Column(type="date")
     */
    private $birthDate;
    
    /**
     *
     * @var type ArrayCollection
     * @ORM\OneToMany(targetEntity="Address", mappedBy="person")
     */
    private $addresses;
//    @ORM\OneToMany(targetEntity="Address", mappdBy="person") du coté ou on est référencé - renvoie à la variable person créée dans la table Address
    
    public function __construct() {
        $this->addresses = new ArrayCollection();
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
    
    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setBirthDate(\DateType $birthDate) {
        $this->birthDate = $birthDate;
        return $this;
    }
    
    public function getAddresses() {
        return $this->addresses;
    }

    public function setAddresses(type $addresses) {
        $this->addresses = $addresses;
        return $this;
    }

    public function addAddress(Address $address) {
        $this->addresses->add($address);
        return $this;
    }
    
    public function removeAddress(Address $address) {
        $this->addresses->removeElement($address);
        return $this;
    }


}

