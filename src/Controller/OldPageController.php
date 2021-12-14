<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
/*je fais hériter ma classe GuestPageController de la classe AbstractController de Symfony ce qui me permet d'utiliser dans
* ma classe (avec le mot clé $this) des méthodes et propriétés définies dans la classe AbstractController
*/

class OldPageController extends AbstractController
{
    /**
     * je crée une page racine qui porte le nom "home"
     * @Route("/", name="home")
     */
        // je passe en parametre le nom de la classe BookRepository pour l'instancier et j ajoute la variable
        // $bookRepository dans laquelle la classe sera instanciée
    public function home(BookRepository $bookRepository)
    {


        // je mets dans la vairable $home  le resultat de la requete SQL pour selectionner les 3 derniers 'id'
        $home = $bookRepository->findBy([], ['id' => 'DESC'],3);

        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template et en 2eme parametre, la variable $home
        return $this->render("home.html.twig", ["home" => $home]);

    }


    /**
     * je crée une page book avec un id qui porte le nom "book"
     * @Route("/book/{id}", name="book")
     */
        //    je passe en 1er parametre l'id attendu dans l'URL, le nom de la classe BookRepository pour l'instancier et
        // j ajoute la variable $bookRepository dans laquelle la classe sera instanciée
    public function showBook($id, BookRepository $bookRepository)
    {


        // je mets dans la vairable $book le resultat de la requete SQL pour
        // selectionner l'id qui sera dans l'URL
            $book = $bookRepository->find($id);

        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template et en 2eme parametre, la variable $book
        return $this->render("book.html.twig", ["book" => $book]);

    }

    /**
     * je crée une page books qui porte le nom "books"
     * @Route("/books", name="books")
     */

        // je passe en parametre le nom de la classe BookRepository pour l'instancier et j ajoute la variable
        // $bookRepository dans laquelle la classe sera instanciée
    public function showBooks(BookRepository $bookRepository)
    {
        // je mets dans la vairable $books le resultat de la requete SQL pour
        // selectionner tous les 'id'
        $books = $bookRepository->findAll();

        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template et en 2eme parametre, la variable $books
        return $this->render("books.html.twig", ["books" => $books]);
    }
}