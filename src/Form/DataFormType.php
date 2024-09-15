<?php

namespace App\Form;

use App\Entity\Data;
use App\Entity\Type;
use App\Entity\Licence;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\LicenceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DataFormType extends AbstractType
{

    private $entityManager;

    public function __construct()
    {

        // $this->tokenStorage = $tokenStorage;
        // $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $user = $this->tokenStorage->getToken()->getUser();
        $builder

            ->add('titre', TextType::class)

            ->add('type', EntityType::class, [
                'class' => Type::class,
                'placeholder' => 'Quel est le type de votre donnée ?',
                'choice_label' => 'titret',                
            ])

            ->add('licence', EntityType::class, [
                'class' => Licence::class,
                'placeholder' => 'Choisissez ou recherchez une licence ',
                'choice_label' => 'titrel',                
            ])
            
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Description:'
                ],
            ])
            // ->add('createdat', DateType::class, [
            //     'widget' => 'choice',
            //     'input'  => 'datetime_immutable'
            // ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Data::class,
        ]);
    }
}
