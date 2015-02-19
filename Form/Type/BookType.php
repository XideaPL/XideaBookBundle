<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of RegistrationType
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookType extends AbstractType
{
    /*
     * var string
     */
    protected $class;

    /**
     * @param string $class The Book class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', null, array(
                'label' => 'book.slug'
            ))
            ->add('isbn', null, array(
                'label' => 'book.isbn'
            ))
            ->add('title', null, array(
                'label' => 'book.name'
            ))
            ->add('description', null, array(
                'label' => 'book.description'
            ))
            ->add('shortDescription', null, array(
                'label' => 'book.shortDescription'
            ))
            ->add('series', null, array(
                'label' => 'book.series'
            ))
            ->add('binding', null, array(
                'label' => 'book.binding'
            ))
            ->add('premiere', null, array(
                'label' => 'book.premiere'
            ))
            ->add('releaseYear', null, array(
                'label' => 'book.releaseYear'
            ))
            ->add('releaseNumber', null, array(
                'label' => 'book.releaseNumber'
            ))
            ->add('pages', null, array(
                'label' => 'book.pages'
            ))
            ->add('dimensions', null, array(
                'label' => 'book.dimensions'
            ))
            ->add('price', null, array(
                'label' => 'book.price'
            ))
            ->add('imagePath', null, array(
                'label' => 'book.imagePath'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    public function getName()
    {
        return 'xidea_book';
    }

}
