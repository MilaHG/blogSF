<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(type="text")
     */
    private $street;

    /**
     * 
     * @var string
     * @ORM\Column(type="string", length=5)
     */
    private $zipCode;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string") 
     */
    private $town;

    /**
     *
     * @var Person
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="addresses")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    private $person;
    // on créé notre clé étrangère pour lier les tables Person et Address
    // ici l'attribut $person est un objet de type Person
    // inversedBy => on va modifier notre classe Person pour qu'elle prenne un attribut "addresses" ou on aura une collection d'objets "addresses"
    // referencedColumnName="id" nom du champ dans la table Person
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getStreet() {
        return $this->street;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getTown() {
        return $this->town;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setTown($town) {
        $this->town = $town;
        return $this;
    }

    public function getPerson() {
        return $this->person;
    }

    public function setPerson($person) {
        $this->person = $person;
        return $this;
    }


    
    
}

