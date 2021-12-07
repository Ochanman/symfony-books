<?php

namespace App\Controller;
//j'ajoute le parametre App\Entity\Book pour pouvoir utiliser la classe Book
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
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
    public function createBook(EntityManagerInterface $entityManager)
    {
        // Je créé une nouvelle instance de la classe Book (de l'entité Book)
        // dans le but de l'enregistrer en bdd valeurs via les methodes "setter"
        // Doctrine prendra l'entité avec les valeurs de chacune des propriétés
        // et créera un enregistrement dans la table Book
        $book = new Book();
        $book->setTitle("Snowman");
        $book->setAuthor("Jo Nesbo");
        $book->setNbPages(700);
        $book->setPublishedAt(new \DateTime(2010-12-02));
        // une fois l'entité créée, j'utilise la classe EntityManager
        // je demande à Symfony de l'instancier pour moi (grâce au système
        // d'autowire)
        // cette classe me permet de persister mon entité (de préparer sa sauvegarde
        // en bdd), puis d'effectuer l'enregistrement (génère et éxecute une requête SQL)
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('book_create.html.twig');

    }
    /**
     * je crée une page update avec un id qui porte le nom "book_update"
     * @Route("/book/update/{id}", name="book_update")
     */
        //  je créé une methose qui fait appel BookRepository et EntityManagerInterface
        public function bookUpdate($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // je mets dans une variable le contenu d'un book avec l id de recuperé dans l'url via la methode
        // find de la classe $bookRepository
        $book = $bookRepository->find($id);
        // je modifie le contenu de cette variable via le setter
        $book->setTitle("L'Étrange Cas du docteur Jekyll et de M. Hyde le retour");
        // j'utilise la classe EntityManager , elle me permet de persister mon entité afin de faire la
        // modification dans la BDD puis j'effectue la modification via Flush qui génère et éxecute la requête SQL
        $entityManager->persist($book);
        $entityManager->flush();
        // puis je me rends a la page book/update
        return $this->render('book_update.html.twig');
    }




}