<?php

namespace App\Controller\admin;
//j'ajoute le parametre App\Entity\Author pour pouvoir utiliser la classe Author
use App\Entity\Author;
use App\Form\AuthorType;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;

class AdminAuthorController extends AbstractController
{

    /**
     * je crée une page /author/create qui porte le nom "author_create"
     *@Route("/admin/author/create", name="admin_author_create")
     */
    public function createAuthor(Request $request, EntityManagerInterface $entityManager)
    {
        // Je créé une nouvelle instance de la classe Author (de l'entité Author)
        // dans le but de l'enregistrer en bdd valeurs via les methodes "setter"
        // Doctrine prendra l'entité avec les valeurs de chacune des propriétés
        // et créera un enregistrement dans la table Author
        $author = new Author();
        // j'utilise la methode creatForm de la classe AbstractController pour que symfony créé un formulaire
        // par rapport à $Author
        $form = $this->createForm(AuthorType::class, $author);
        // avec la methode handleRequest j'associe le formulaire à $request
        $form->handleRequest($request);
        //  avec la methode isSubmitted je verifie si le formulaire a été soumis et avec la methode isValid verifie sa validité
        if ($form->isSubmitted() && $form->isValid()) {

            // cette classe permet de préparer sa sauvegarde en bdd
            $entityManager->persist($author);

            // cette classe permet de génèrer et éxecuter la requête SQL
            $entityManager->flush();
            $this->addFlash('success', "l'auteur a bien été créé!");
        }
        // je renvoie le formulaire créé mis en forme via la methode render sur la page admin/book_create.html.twig
        return $this->render("admin/author_create.html.twig", [
            'authorForm' => $form->createView()
        ]);

    }

    /**
     *@Route("/admin/authors", name="admin_authors")
     */
    public function showAuthors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("admin/authors.html.twig", ["authors" => $authors]);
    }


    /**
     * Je créé la route /author/{id} mais je ne rajoute pas de requirements car j'ai placé
     * l'autre route /author/create avant celle ci
     *@Route("/admin/author/{id}", name="admin_author")
     */
    public function showAuthor($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        //je renvoi a twing le tableau via la methode render
        return $this->render("admin/author.html.twig", ["author" => $author]);
    }

    /**
     *  je crée une page update avec un id qui porte le nom "author_update"
     * @Route("/admin/author/update/{id}", name="admin_author_update")
     */
    //  je créé une methose qui fait appel BookRepository et EntityManagerInterface
    public function authorUpdate($id, Request $request, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // je mets dans une variable le contenu d'un author avec l id de recuperé dans l'url via la methode
        // find de la classe $authorRepository
        $author = $authorRepository->find($id);
        $form = $this->createForm(AuthorType::class, $author);
        // avec la methode handleRequest j'associe le formulaire à $request
        $form->handleRequest($request);
        //  avec la methode isSubmitted je verifie si le formulaire a été soumis et avec la methode isValid verifie sa validité
        if ($form->isSubmitted() && $form->isValid()) {

            // cette classe permet de préparer sa sauvegarde en bdd
            $entityManager->persist($author);

            // cette classe permet de génèrer et éxecuter la requête SQL
            $entityManager->flush();
            $this->addFlash('success', "l'auteur a bien été modifié!");
        }
        // je renvoie le formulaire créé mis en forme via la methode render sur la page admin/author_update.html.twig
        return $this->render("admin/author_update.html.twig", [
            'authorForm' => $form->createView()
        ]);

    }
    /**
     * je créé une route /author/delete qui attend un id et porte le nom author_delete
     *@Route("/admin/author/delete/{id}", name="admin_author_delete")
     */
    // je créé ne methode avec en parametre l'id, la classe AuthorRepository instanciée dans la variable
    // $authorRepository et la classe EntityManagerInterface qui est instanciée dans la variable $entityManager
    public function authorDelete($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // je mets dans la variable $author le resultat de l'author portant l'id que l on, aura recupéré dans l'url
        // en utilisant la methode find de la classe AuthorRepository
        $author = $authorRepository->find($id);
        // j'utilise la methode remove de la classe EntityManagerInterface pour preparer la suppression
        $entityManager->remove($author);
        // j'utilise la methode flush de la classe EntityManagerInterface pour appliquer la suppression
        $entityManager->flush();
        $this->addFlash('success', "l'auteur a bien été supprimé!");
        //je retourne sur la page author_delete
        return $this->redirectToRoute('admin_authors');
    }

}