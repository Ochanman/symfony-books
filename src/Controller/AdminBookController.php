<?php

namespace App\Controller;
//j'ajoute le parametre App\Entity\Book pour pouvoir utiliser la classe Book
use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class AdminBookController extends AbstractController
{
    /**
     * je crée une page book avec un id qui porte le nom "book" et j'ajoute un requirements pour que id
     * devienne un integer
     * @Route("/admin/book/{id}", name="admin_book", requirements={"id"="\d+"})
     */
    public function showBook($id, BookRepository $bookRepository)
    {



        $book = $bookRepository->find($id);

//je cree une variable article qui renvoi a twing la partie de tableau comportant l'id via la methode render
        return $this->render("admin/book.html.twig", ["book" => $book]);

    }

    /**
     * je crée une page books qui porte le nom "books"
     * @Route("/admin/books", name="admin_books")
     */
    public function showBooks(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("admin/books.html.twig", ["books" => $books]);
    }

    /**
     * je crée une page /admin/book/create qui porte le nom "admin_book_create"
     *@Route("/admin/book/create", name="admin_book_create")
     */
//    je créé une methode qui utilise les classes Request et EntityManagerInterface
    public function createBook(Request $request, EntityManagerInterface $entityManager)
    {
        //je crée une instance de mon entity Book dans ma variable $book
        $book = new Book();
        // j'utilise la methode creatForm de la classe AbstractController pour que symfony créé un formulaire
        // par rapport à $Book
        $form = $this->createForm(BookType::class, $book);

        // avec la methode handleRequest j'associe le formulaire à $request
        $form->handleRequest($request);

        //  avec la methode isSubmitted je verifie si le formulaire a été soumis et avec la methode isValid verifie sa validité
        if ($form->isSubmitted() && $form->isValid()) {

           // cette classe permet de préparer sa sauvegarde en bdd
            $entityManager->persist($book);

            // cette classe permet de génèrer et éxecuter la requête SQL
            $entityManager->flush();
            $this->addFlash('success', "le livre a bien été enregistré!");
        }

        // je renvoie le formulaire créé mis en forme via la methode render sur la page admin/book_create.html.twig
        return $this->render("admin/book_create.html.twig", [
            'bookForm' => $form->createView()
    ]);













//        // Je créé une nouvelle instance de la classe Book (de l'entité Book)
//        // dans le but de l'enregistrer en bdd valeurs via les methodes "setter"
//        // Doctrine prendra l'entité avec les valeurs de chacune des propriétés
//        // et créera un enregistrement dans la table Book
//        $book = new Book();
//        $book->setTitle("Snowman");
//        $book->setAuthor("Jo Nesbo");
//        $book->setNbPages(700);
//        $book->setPublishedAt(new \DateTime(2010-12-02));
//        // une fois l'entité créée, j'utilise la classe EntityManager
//        // je demande à Symfony de l'instancier pour moi (grâce au système
//        // d'autowire)
//        // cette classe me permet de persister mon entité (de préparer sa sauvegarde
//        // en bdd), puis d'effectuer l'enregistrement (génère et éxecute une requête SQL)
//        $entityManager->persist($book);
//        $entityManager->flush();
//
//        return $this->render('admin/book_create.html.twig');

    }
    /**
     * je crée une page update avec un id qui porte le nom "book_update"
     * @Route("/admin/book/update/{id}", name="admin_book_update")
     */
        //  je créé une methose qui fait appel BookRepository et EntityManagerInterface
        public function bookUpdate($id, Request $request, BookRepository $bookRepository, EntityManagerInterface $entityManager)
        {
            // je mets dans une variable le contenu d'un book avec l id de recuperé dans l'url via la methode
            // find de la classe $bookRepository
            $book = $bookRepository->find($id);
            $form = $this->createForm(BookType::class, $book);

            // avec la methode handleRequest j'associe le formulaire à $request
            $form->handleRequest($request);

            //  avec la methode isSubmitted je verifie si le formulaire a été soumis et avec la methode isValid verifie sa validité
            if ($form->isSubmitted() && $form->isValid()) {

                // cette classe permet de préparer sa sauvegarde en bdd
                $entityManager->persist($book);

                // cette classe permet de génèrer et éxecuter la requête SQL
                $entityManager->flush();
                $this->addFlash('success', "le livre a bien été modifié!");
            }

            // je renvoie le formulaire créé mis en forme via la methode render sur la page admin/book_create.html.twig
            return $this->render("admin/book_update.html.twig", [
                'bookForm' => $form->createView()
            ]);

        }








//        // je modifie le contenu de cette variable via le setter
//        $book->setTitle("L'Étrange Cas du docteur Jekyll et de M. Hyde le retour");
//        // j'utilise la classe EntityManager , elle me permet de persister mon entité afin de faire la
//        // modification dans la BDD puis j'effectue la modification via Flush qui génère et éxecute la requête SQL
//        $entityManager->persist($book);
//        $entityManager->flush();
//        // puis je me rends a la page book/update
//        return $this->render('admin/book_update.html.twig');
//    }


        /**
         * je créé une route /book/delete qui attend un id et porte le nom book_delete
         *@Route("/admin/book/delete/{id}", name="admin_book_delete")
         */
        // je créé ne methode avec en parametre l'id, la classe BookRepository instanciée dans la variable
        // $bookRepository et la classe EntityManagerInterface qui est instanciée dans la variable $entityManager
        public function bookDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
        {
        // je mets dans la variable $book le resultat du livre portant l'id que l on, aura recupéré dans l'url
        // en utilisant la methode find de la classe BookRepository
            $book = $bookRepository->find($id);
        // j'utilise la methode remove de la classe EntityManagerInterface pour preparer la suppression
            $entityManager->remove($book);
        // j'utilise la methode flush de la classe EntityManagerInterface pour appliquer la suppression
            $entityManager->flush();
            $this->addFlash('success', "le livre a bien été supprimé!");
        //je redirige sur la route books apres avoir supprimé
            return $this->redirectToRoute('admin_books');
        }

        /**
        * @Route("/admin/search", name="admin_search_books")
        */
        // je créé une methode searchBooks utilisant la classe BookRepository et Request
    public function searchBooks(BookRepository $bookRepository, Request $request)
    {
        // je recupére le contenu de l'input de la barre recherche "q" et le mets dans la variable $word
        $word = $request->query->get('q');

        // je fais la requete SQL dans la BDD via la methode searchByTitle de la classe BookRepository
        $books = $bookRepository->searchByTitle($word);

        // je retuorne le resultat dans la page admin/books_search.html.twig
        return $this->render('admin/books_search.html.twig', [
            'books' => $books
        ]);

    }




}