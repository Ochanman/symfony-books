<?php

namespace App\Controller;
//j'ajoute le parametre App\Entity\Author pour pouvoir utiliser la classe Author
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;


class AuthorController extends AbstractController
{

    /**
     * je crée une page /author/create qui porte le nom "author_create"
     *@Route("/author/create", name="author_create")
     */
    public function createAuthor(EntityManagerInterface $entityManager)
    {
        // Je créé une nouvelle instance de la classe Author (de l'entité Author)
        // dans le but de l'enregistrer en bdd valeurs via les methodes "setter"
        // Doctrine prendra l'entité avec les valeurs de chacune des propriétés
        // et créera un enregistrement dans la table Author
        $author = new Author();
        $author->setFirstName("Jo");
        $author->setLastName("Nesbo");
        // une fois l'entité créée, j'utilise la classe EntityManager
        // je demande à Symfony de l'instancier pour moi (grâce au système
        // d'autowire)
        // cette classe me permet de persister mon entité (de préparer sa sauvegarde
        // en bdd), puis d'effectuer l'enregistrement (génère et éxecute une requête SQL)
        $entityManager->persist($author);
        $entityManager->flush();

        return $this->render('author_create.html.twig');

    }

    /**
     *@Route("/authors", name="authors")
     */
    public function showAuthors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("authors.html.twig", ["authors" => $authors]);
    }


    /**
     * Je créé la route /author/{id} mais je ne rajoute pas de requirements car j'ai placé
     * l'autre route /author/create avant celle ci
     *@Route("/author/{id}", name="author")
     */
    public function showAuthor($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        //je renvoi a twing le tableau via la methode render
        return $this->render("author.html.twig", ["author" => $author]);
    }

    /**
     *  je crée une page update avec un id qui porte le nom "author_update"
     * @Route("/author/update/{id}", name="author_update")
     */
    //  je créé une methose qui fait appel BookRepository et EntityManagerInterface
    public function authorUpdate($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // je mets dans une variable le contenu de l'id selectionné via la methode find de la classe $bookRepository
        $author = $authorRepository->find($id);
        // je modifie le contenu de cette variable via le setter
        $author->setLastName("Petit");
        // j'utilise la classe EntityManager , elle me permet de persister mon entité afin de faire la
        // modification dans la BDD puis j'effectue la modification via Flush qui génère et éxecute la requête SQL
        $entityManager->persist($author);
        $entityManager->flush();
        // puis je me rends a la page author/update
        return $this->render('author_update.html.twig');
    }

}