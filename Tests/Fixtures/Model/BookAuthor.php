<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Fixtures\Model;

use Xidea\Component\Book\Model\AbstractBookAuthor;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookAuthor extends AbstractBookAuthor
{
    public function setId($id)
    {
        $this->id = $id;
    }
}
