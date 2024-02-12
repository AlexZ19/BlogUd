<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $article = new Article();
            $article->setTitre(titre: 'Titre de l\'article n°' . $i);
            $article->setContenu(contenu: 'Contenu de l\'article');

            $date = new \DateTime();
            $date->modify(modifier: '-' . $i . ' days');

            $article->setDateCreation($date);

            $this->addReference('article_' . $i, $article);

            $manager->persist($article);
        }

        $manager->flush();
    }
}