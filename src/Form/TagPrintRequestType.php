<?php

namespace App\Form;

use App\Entity\TagPrintRequest;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagPrintRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('article')
            ->add('reason', TextType::class)
            ->add('quantity', NumberType::class);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            /** @var TagPrintRequest $tagPrintRequest */
            $tagPrintRequest = $event->getData();

            if ($tagPrintRequest) {
                $tagPrintRequest->setDate(new DateTime());
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TagPrintRequest::class,
            'csrf_protection' => false
        ));
    }
}
