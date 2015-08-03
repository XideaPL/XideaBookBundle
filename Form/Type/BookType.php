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
                'label' => 'book.slug',
                'required' => false
            ))
            ->add('isbn', null, array(
                'label' => 'book.isbn'
            ))
            ->add('name', null, array(
                'label' => 'book.name'
            ))
            ->add('description', null, array(
                'label' => 'book.description',
                'required' => false
            ))
            ->add('shortDescription', null, array(
                'label' => 'book.short_description',
                'required' => false
            ))
            ->add('series', null, array(
                'label' => 'book.series',
                'required' => false
            ))
            ->add('cover', null, array(
                'label' => 'book.cover',
                'required' => false
            ))
            ->add('premiere', null, array(
                'label' => 'book.premiere',
                'required' => false
            ))
            ->add('releaseYear', null, array(
                'label' => 'book.release_year',
                'required' => false
            ))
            ->add('releaseNumber', null, array(
                'label' => 'book.release_number',
                'required' => false
            ))
            ->add('pages', null, array(
                'label' => 'book.pages'
            ))
            ->add('dimensions', null, array(
                'label' => 'book.dimensions',
                'required' => false
            ))
            ->add('price', null, array(
                'label' => 'book.price',
                'required' => false
            ))
            ->add('image', null, array(
                'label' => 'book.image',
                'required' => false
            ))
            ->add('authors', 'xidea_book_author_choice_collection', array(
                'label' => 'book.authors'
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
