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
use Xidea\Bundle\BaseBundle\Form\DataTransformer\ModelToIdTransformer;
use Xidea\Component\Book\Loader\AuthorLoaderInterface;

/**
 * Description of RegistrationType
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class AuthorChoiceType extends AbstractType
{
    /*
     * var AuthorLoaderInterface
     */
    protected $loader;

    /**
     * @param AuthorLoaderInterface $loader The Author loader
     */
    public function __construct(AuthorLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ModelToIdTransformer($this->loader);
        $builder->addModelTransformer($transformer, true);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->getChoices()
        ));
    }
    
    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'xidea_book_author_choice';
    }
    
    protected function getChoices()
    {
        $result = array();
        
        $authors = $this->loader->loadAll();

        foreach($authors as $author) {
            $result[$author->getId()] = $author->getName();
        }
        
        return $result;
    }
}
