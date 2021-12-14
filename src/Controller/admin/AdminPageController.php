<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
/*je fais hériter ma classe GuestPageController de la classe AbstractController de Symfony ce qui me permet d'utiliser dans
* ma classe (avec le mot clé $this) des méthodes et propriétés définies dans la classe AbstractController
*/

class AdminPageController extends AbstractController
{
/*je crée une propriété privé $book qui contiendra la liste de tous les livres afin de repetéer cette variable dans
 toutes les methodes*/
    private $books;

    /*je créé une methode constructor, qui sera appelée automatiquement quand la class sera instanciée
    Symfony instancie les classes de controller (meme si on ne les voient pas)
    pour afficher les pages créées dans le controleur*/
    public function __construct()
    {
        /*je definis la valeur de la propriété book*/

    }


    /**
     * je crée une page racine qui porte le nom "home"
     * @Route("/admin", name="dashboard")
     */
    public function dashboard(BookRepository $bookRepository)
    {

        // je veux utiliser un fichier HTML en tant que réponse
        // HTTP
        // pour ça j'appelle la méthode render (issue de l'AbstractController)
        // et je lui passe en premier parametre le nom / le chemin du fichier
        // twig (html) situé dans le dossier template et en 2eme parametre, le array qui comporte que les 3 dernieres
        // valeurs en utilisant la fonction native de PHP "array_slice"
//        return $this->render("home.html.twig", ["books" => $output = array_slice($this->books, -3, 3)]);

        $home = $bookRepository->findBy([], ['id' => 'DESC'],3);
        return $this->render("admin/dashboard.html.twig", ["home" => $home]);

    }



}