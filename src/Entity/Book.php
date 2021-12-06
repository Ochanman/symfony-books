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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * */
    private $title;

    /**
     * @ORM\Column(type="string")
     * */
    private $author;

    /**
     * @ORM\Column(type="integer")
     * */
    private $nbPages;

    /**
     * @ORM\Column(type="date")
     * */
    private $PublishedAt;


}