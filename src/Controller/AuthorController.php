<?php

namespace App\Controller;
//j'ajoute le parametre App\Entity\Author pour pouvoir utiliser la classe Author
use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;


class AuthorController extends AbstractController
{

    /**
     * je crée une page /author/create qui porte le nom "author_create"
     *@Route("/author/create", name="author_create")
     */
    public function createAuthor()
    {
        // j'instancie la class Author pour en suite integrer des valeurs via les methodes "setter"
        $author = new Author();
        $author->setFirstName("Jo");
        $author->setLastName("Nesbo");


        //  je fais un dump pour controler le contenu de $book
        dump($author); die;

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

}