<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('publishedAt')

            // j'indique le type à 'genre' qui est EntityType
            ->add('genre', EntityType::class, [
                // j'utilise la propriété 'class' pour selectionner la classe de mon entity Genre
                'class'=>Genre::class,
                // j'utilise la propriété 'choice_label' pour afficher le title de l'entity sous forme de string
                // avec le getter de la classe Genre
                'choice_label' => function ($genre) {
                // je retourne le title
                    return $genre->gettitle();
                }
            ])
            // j'indique le type à 'author' qui est EntityType
            ->add('author', EntityType::class, [
                // j'utilise la propriété 'class' pour selectionner la classe de mon entity Author
                'class'=>Author::class,
                // j'utilise la propriété 'choice_label' pour afficher le firstname et le lastname concaténé
                // de l'entity sous forme de string avec le getter de la classe Author
                'choice_label' => function ($author) {
                // je retourne le firstname et le lastname
                return $author->getFirstname() .' '. $author->getlastname();
                }
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
