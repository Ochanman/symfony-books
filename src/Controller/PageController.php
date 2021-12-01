<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render("home.html.twig");
    }

    /**
     * @Route("/book/{id}", name="book")
     */
    public function ShowBook($id)
    {
        $books = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 5
            ]
        ];
        if (!array_key_exists($id, $books)) {
            throw $this->createNotFoundException('Petit malin! tu n\'as rien à faire ici!!!');
        }
//je cree une variable article qui renvoi  a twing la partie de tableau comportant l'id via la methode render
        return $this->render("book.html.twig", ["book" => $books[$id]]);

    }

    /**
     *
     * @Route("/books", name="books")
     */
    public function ShowBooks()
    {
        $books = [
            1 => [
                "title" => "Dune",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-na.ssl-images-amazon.com/images/I/41rDK8Jb1LL._SX312_BO1,204,203,200_.jpg",
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-eu.ssl-images-amazon.com/images/I/41Y8vPpBFlL._SY291_BO1,204,203,200_QL40_ML2_.jpg",
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-eu.ssl-images-amazon.com/images/I/51IgnZIwYRS._SY291_BO1,204,203,200_QL40_ML2_.jpg",
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-eu.ssl-images-amazon.com/images/I/41GpkWdUd6L._SY291_BO1,204,203,200_QL40_ML2_.jpg",
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "image" => "https://images-na.ssl-images-amazon.com/images/I/51R4FsiUzlL._SX323_BO1,204,203,200_.jpg",
                "id" => 5
            ]
        ];
        return $this->render("books.html.twig", ["books" => $books]);
    }
}