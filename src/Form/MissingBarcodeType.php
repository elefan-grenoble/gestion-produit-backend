<?php

namespace App\Form;

use App\Entity\MissingBarcode;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissingBarcodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article')
            ->add('barcode', NumberType::class);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            /** @var MissingBarcode $missingBarcode */
            $missingBarcode = $event->getData();

            if ($missingBarcode) {
                $missingBarcode->setDate(new DateTime());
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MissingBarcode::class,
            'csrf_protection' => false
        ));
    }
}
