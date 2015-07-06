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
class AuthorChoiceCollectionType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'type'         => 'xidea_book_author_choice',
                'required'     => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;
    }
    
    public function getParent()
    {
        return 'collection';
    }

    public function getName()
    {
        return 'xidea_book_author_choice_collection';
    }

}
