<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Form\Type;

use Xidea\Bundle\BookBundle\Form\Type\BookType,
    Xidea\Component\Book\Model\BookInterface,
    Xidea\Bundle\BookBundle\Tests\Fixtures\Model\Book;

use Symfony\Component\Form\Test\TypeTestCase,
    Symfony\Component\Form\Forms,
    Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension,
    Symfony\Component\Validator\ConstraintViolationList;

class BookTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'slug' => 'book1-slug',
            'isbn' => '9788375747478',
            'name' => 'Book 1',
            'description' => 'Book 1 description',
            'shortDescription' => 'Book 1 short description',
            'series' => 'Book 1 Series',
            'cover' => BookInterface::COVER_HARD,
            'premiere' => new \DateTime('2012-03-26'),
            'releaseYear' => 2012,
            'releaseNumber' => 2,
            'pages' => 376,
            'dimensions' => '220x140x30',
            'price' => 39.90,
            'imagePath' => 'book1-image-path.jpg'
        );
        
        $object = new Book();

        $type = new BookType(get_class($object));

        $form = $this->factory->create($type);
        //$object->fromArray($formData);
        $form->setData($object);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
    
    protected function setUp()
    {
        parent::setUp();

        $validator = $this->getMock('\Symfony\Component\Validator\Validator\ValidatorInterface');
        $validator->method('validate')->will($this->returnValue(new ConstraintViolationList()));

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addTypeExtension(
                new FormTypeValidatorExtension(
                    $validator
                )
            )
            ->addTypeGuesser(
                $this->getMockBuilder(
                    'Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser'
                )
                    ->disableOriginalConstructor()
                    ->getMock()
            )
            ->getFormFactory();

        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->builder = new FormBuilder(null, null, $this->dispatcher, $this->factory);
    }
}