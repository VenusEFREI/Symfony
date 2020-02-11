<?php
//Ce Controller gère le formulaire qu'on a créé et associé à notre entité Property qui est le modèle
//Doctrine recupère automatiquement les champs qu'on a précédemment créé dans notre entité 

//repertoire de trvail
namespace App\Form;

//On indique le repertoire des objets qu'on va utiliser
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//On étend la class pour PropertyType à AbstractType
class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('date')
            ->add('statut')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
