<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\Image;

class AuctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Tytuł'
            ])
            ->add('description', TextType::class, [
                'label' => 'Opis'
            ])
            ->add('price', TextType::class, [
                'label' => 'Cena'
            ])
            ->add('category', EntityType::class, [
                'label' => 'Kategoria',
                'class' => Category::class,
                'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name'
            ])
             ->add('images', FileType::class, [
                 'multiple' => true,
                 'label' => 'Zdjęcia',
                 'mapped' => false,
                 'data_class' => null,
                 'required' => false,
             ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success form-button-custom']
            ])
        ;
    }
}
