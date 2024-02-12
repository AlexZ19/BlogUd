<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'liste_articles', methods: ['GET'])]
    public function listeArticles(ArticleRepository $articleRepository): Response
    {


        // recupere les articles de la base de données
        $articles = $articleRepository->findAll(['titre' => 'Titre de l\'article n°1'],
    [
        'DateCreation' => 'DESC'
    ],
    );
//   $articles = $articleRepository->findByDateCreation(new \DateTime("2024-01-18"));  
//   dd($articles); 
        // $articles = $articleRepository->findByTitre('Titre de l\'article n°5');
        // dd($articles);



        return $this->render('default/index.html.twig', ['articles' => $articles]);
    }

    #[Route('/{id}', name: 'vue_article', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function vueArticle(ArticleRepository $articleRepository,  $id)
    {
        $article = $articleRepository->find($id);


        return $this->render('default/vue.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/article/ajouter', name: 'ajout_article')]
    public function ajouter(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $manager)
    {
        // $article = new Article();
        // $article->setTitre('Titre de l\'article');
        // $article->setContenu('Contenu de l\'article');
        // $article->setDateCreation(new \DateTime());

        // $manager->persist($article);

        // $manager->flush();

        // die;
        // dd($request);

    $form = $this->createFormBuilder()
    ->add('titre', TextType::class, [
      'label' => 'Titre de l\'article'
    ])
    ->add('contenu', TextareaType::class)
    ->add('DateCreation', DateType::class,[

      'widget' => 'single_text'
    ])
    ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // dd($form->getData());
      $article = new Article();
      $article->setTitre($form->get('titre')->getData());
      $article->setContenu($form->get('contenu')->getData());
      $article->setDateCreation($form->get('DateCreation')->getData());
      $category = $categoryRepository->findOneBy(['name' => 'Sports']);
      // dd($category);
      $article->addCategory($category);
      $manager->persist($article);
      $manager->flush();
      
    }

    return $this->render('default/ajout.html.twig',[
      'form' => $form-> createView()
    ]);
    }
}