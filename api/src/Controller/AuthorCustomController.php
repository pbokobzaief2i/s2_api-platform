<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorCustomController extends AbstractController
{
    public function __invoke(Author $author): Author
    {
        $existingFirstName = $author->getFirstName();
        $author->setFirstName(strtoupper($existingFirstName));
        return $author;
    }
}
