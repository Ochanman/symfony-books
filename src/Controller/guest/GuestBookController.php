<?php

namespace App\Controller\guest;
//j'ajoute le parametre App\Entity\Book pour pouvoir utiliser la classe Book
use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class GuestBookController extends AbstractController
{
    /**
     * je crée une page book avec un id qui porte le nom "book" et j'ajoute un requirements pour que id
     * devienne un integer
     * @Route("/guest/book/{id}", name="guest_book", requirements={"id"="\d+"})
     */
    public function showBook($id, BookRepository $bookRepository)
    {



        $book = $bookRepository->find($id);

//je cree une variable article qui renvoi a twing la partie de tableau comportant l'id via la methode render
        return $this->render("guest/book.html.twig", ["book" => $book]);

    }

    /**
     * je crée une page books qui porte le nom "books"
     * @Route("/guest/books", name="guest_books")
     */
    public function showBooks(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("guest/books.html.twig", ["books" => $books]);
    }

















        /**
        * @Route("/guest/search", name="admin_search_books")
        */
        // je créé une methode searchBooks utilisant la classe BookRepository et Request
    public function searchBooks(BookRepository $bookRepository, Request $request)
    {
        // je recupére le contenu de l'input de la barre recherche "q" et le mets dans la variable $word
        $word = $request->query->get('q');

        // je fais la requete SQL dans la BDD via la methode searchByTitle de la classe BookRepository
        $books = $bookRepository->searchByTitle($word);

        // je retuorne le resultat dans la page admin/books_search.html.twig
        return $this->render('guest/books_search.html.twig', [
            'books' => $books
        ]);

    }




}