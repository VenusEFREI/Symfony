<?php
//Ce fichier est l'entité property qui contient des methodes avec les informations sur les champs de notre base de données
//On a les getter et setter qui sont des methodes qui vont effectuer des actions sur les les champs

//Repertoire de travail
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType ;

//Cette annotation associe l'entité au repository qui lui va faire le pont entre l'entité et la base de données
/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{

    const STATUT = [
        0 => 'à faire',
        1 => 'en cours',
        2 => 'terminé'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $statut;

    public function __construct()
{
    $this->date = new \DateTime('now');
    
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getStatutType(): string 
    {
        return self::STATUT[$this->statut];
    }

}
