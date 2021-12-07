<?php

namespace App\Controller;
//j'ajoute le parametre App\Entity\Book pour pouvoir utiliser la classe Book
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
class BookController extends AbstractController
{
    /**
     * je crée une page book avec un id qui porte le nom "book" et j'ajoute un requirements pour que id
     * devienne un integer
     * @Route("/book/{id}", name="book", requirements={"id"="\d+"})
     */
    public function showBook($id, BookRepository $bookRepository)
    {



        $book = $bookRepository->find($id);

//je cree une variable article qui renvoi a twing la partie de tableau comportant l'id via la methode render
        return $this->render("book.html.twig", ["book" => $book]);

    }

    /**
     * je crée une page books qui porte le nom "books"
     * @Route("/books", name="books")
     */
    public function showBooks(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("books.html.twig", ["books" => $books]);
    }

    /**
     * je crée une page /books/create qui porte le nom "book_create"
     *@Route("/book/create", name="book_create")
     */
    public function createBook()
    {
        // j'instancie la class Book pour en suite integrer des valeurs via les methodes "setter"
        $book = new Book();
        $book->setTitle("Snowman");
        $book->setAuthor("Jo Nesbo");
        $book->setNbPages(700);
        $book->setPublishedAt(new \DateTime(2010-12-02));

        //  je fais un dump pour controler le contenu de $book
        dump($book); die;

    }

}