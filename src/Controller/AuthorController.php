<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
/*je fais hériter ma classe PageController de la classe AbstractController de Symfony ce qui me permet d'utiliser dans
* ma classe (avec le mot clé $this) des méthodes et propriétés définies dans la classe AbstractController
*/

class AuthorController extends AbstractController
{

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
     *@Route("/author/{id}", name="author")
     */
    public function showAuthor($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        //je renvoi a twing le tableau via la methode render
        return $this->render("author.html.twig", ["author" => $author]);
    }
}