<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sports = new Category();
        $sports->setName('Sports');
        $sports->addArticle($this->getReference('article_1'));
        $sports->addArticle($this->getReference('article_2'));
        $sports->addArticle($this->getReference('article_3'));

        $manager->persist($sports);

        $maison = new Category();
        $maison->setName('Maison');
        $maison->addArticle($this->getReference('article_2'));
        $maison->addArticle($this->getReference('article_3'));
        $maison->addArticle($this->getReference('article_4'));
        $manager->persist($maison);


        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ArticlesFixtures::class
        ];
    }
}
