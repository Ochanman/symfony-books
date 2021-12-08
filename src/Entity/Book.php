<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;



    /**
     * @ORM\Column(type="integer")
     */
    private $nbPages;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedAt;



    /**
     * @ORM\ManyToOne(targetEntity=Genre::class)
     * @ORM\JoinColumn(name="genre_id", referencedColumnName="id", nullable=false)
     */
    private $genre;

    /**
     * j'utilise la methode ManyToOne car plusieurs books peuvent être associés à un même author pour joindre
     * la table book a la table author et et j'utilise la propriété inversedBy pour demander à Symfony de faire
     * l'inverse pour la table author (OneToMany)
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }



    public function getNbPages(): ?int
    {
        return $this->nbPages;
    }

    public function setNbPages(int $nbPages): self
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }





    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

}