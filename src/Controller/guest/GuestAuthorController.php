<?php

namespace App\Controller\guest;
//j'ajoute le parametre App\Entity\Author pour pouvoir utiliser la classe Author
use App\Entity\Author;
use App\Form\AuthorType;
use Doctrine\ORM\EntityManagerInterface;
//j'ajoute le parametre EntityManagerInterface pour pouvoir utiliser sa classe
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;

class GuestAuthorController extends AbstractController
{


    /**
     *@Route("/guest/authors", name="guest_authors")
     */
    public function showAuthors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();

        //je renvoi a twing le tableau via la methode render
        return $this->render("guest/authors.html.twig", ["authors" => $authors]);
    }


    /**
     * Je créé la route /author/{id} mais je ne rajoute pas de requirements car j'ai placé
     * l'autre route /author/create avant celle ci
     *@Route("/guest/author/{id}", name="guest_author")
     */
    public function showAuthor($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        //je renvoi a twing le tableau via la methode render
        return $this->render("guest/author.html.twig", ["author" => $author]);
    }



}