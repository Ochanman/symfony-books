<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/*je fais hériter ma classe PageController de la classe AbstractController de Symfony ce qui me permet d'utiliser dans
* ma classe (avec le mot clé $this) des méthodes et propriétés définies dans la classe AbstractController
*/

class PageController extends AbstractController
{
/*je crée une propriété privé $book qui contiendra la liste de tous les livres afin de repetéer cette variable dans
 toutes les methodes*/
    private $books;

    /*je créé une methode constructor, qui sera appelée automatiquement quand la class sera instanciée
    Symfony instancie les classes de controller (meme si on ne les voient pas)
    pour afficher les pages créées dans le controleur*/
    public function __construct()
    {
        /*je definis la valeur de la propriété book*/
        $this->books = [
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
    }


    /**
     * je crée une page racine qui porte le nom "home"
     * @Route("/", name="home")
     */
    public function home()
    {

        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template et en 2eme parametre, le array qui comporte que les 3 dernieres
        // valeurs en utilisant la fonction native de PHP "array_slice"
        return $this->render("home.html.twig", ["books" => $output = array_slice($this->books, -3, 3)]);
    }


    /**
     * je crée une page book avec un id qui porte le nom "book"
     * @Route("/book/{id}", name="book")
     */
    public function showBook($id)
    {


//        j'utilise une condition avec la fonction native de PHP "array_key_exists" afin de verifier que l'id donné
//        dans l'url soit bien comprise dans le array, si non j'utilise la methode createNotFoundException de Symfony
//        pour renvoyer une erreur 404
        if (!array_key_exists($id, $this->books)) {
            throw $this->createNotFoundException('Petit malin! tu n\'as rien à faire ici!!!');
        }
//je cree une variable article qui renvoi a twing la partie de tableau comportant l'id via la methode render
        return $this->render("book.html.twig", ["book" => $this->books[$id]]);

    }

    /**
     * je crée une page books qui porte le nom "books"
     * @Route("/books", name="books")
     */
    public function showBooks()
    {


        //je renvoi a twing le tableau via la methode render
        return $this->render("books.html.twig", ["books" => $this->books]);
    }
}