<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Property;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', null, array(
                //'invalid_message' => 'You entered an invalid value, it should include %num% letters',
                //'invalid_message_parameters' => array('%num%' => 6),
                //'attr' => array('maxlength' => 100),
                //'label' => 'Titulo'
            ))
            ->add('description', TextAreaType::class, array(
                //'label' => 'Descripción'
            ))
            ->add('prize', MoneyType::class, array(
                'currency' => 'EUR',
                'grouping' => true,
                //'label' => 'Precio '
            ))
            ->add('rooms', IntegerType::class, array(
                //'label' => 'Habitaciones'
            ))
            ->add('bathrooms', IntegerType::class, array(
                //'label' => 'Baños'
            ))
            ->add('toilets', IntegerType::class, array(
                //'label' => 'Aseos'
            ))
            ->add('size', IntegerType::class, array(
                //'label' => 'Tamaño (m2)'
            ))
            ->add('plotSize', IntegerType::class, array(
                //'label' => 'Tamaño Parcela'
            ))
            ->add('province', null, [
                'placeholder' => 'Elige una provincia'
            ])

            ->add('save', SubmitType::class, array(
                'label' => 'Añadir propiedad'
            ));



    }

    /** This method creates an object from form data */
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
          'data_class' => Property::class,
       ));
    }

}

?>
