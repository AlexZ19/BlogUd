<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 10; $i++)
        {
        $comment = new Comment();
        $comment->setContenu('J\'ai jamais vu un winner pareil !');
        $comment->setAuthor('Jean-Mimi');
        $comment->setDateComment(new \DateTime());
        $comment->setArticle($this->getReference('article_1'));
        
        $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ArticlesFixtures::class];
    }
}
