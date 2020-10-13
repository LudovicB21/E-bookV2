<?php

namespace App\Controller;

use App\Entity\Ebookv2;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OeuvreController extends AbstractController
{
    /**
     * @Route("/oeuvre", name="oeuvre")
     */
    public function index()
    {
        return $this->render('oeuvre/index.html.twig', [
            'controller_name' => 'OeuvreController',
        ]);
    }

    /**
     * @Route("/administration", name="home")
     */
    public function home(){
        $repo = $this->getDoctrine()->getRepository(Ebookv2::class);
        $concepts = $repo->findAll();
        dump($concepts);
        return $this->render('oeuvre/home.html.twig', [
            "concepts" => $concepts
        ]);
    }

    /**
     * @Route("/administration/create", name="create")
     * @Route("administration/show/{id}/edit", name="edit")
     * @param Ebookv2 $article
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function form(Ebookv2 $article = null, Request $request,EntityManagerInterface $manager){
        if(!$article){
            $article = new Ebookv2();
            $article->setAuteur("Tiffanie");
        }
        $form = $this->createFormBuilder($article)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('Titre')
            ->add('Description')
            ->add('image')
            ->add('Auteur')
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime());
            }
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('show', ['id' => $article->getId()]);
        }
        return $this->render('oeuvre/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode'=> $article->getId() !== null
        ]);
    }

    /**
     * @Route("administration/show/{id}", name="show")
     */
    public function show($id){
        $repository = $this->getDoctrine()->getRepository(Ebookv2::class);
        $article = $repository->find($id);
        return $this->render('oeuvre/show.html.twig', [
            'article' =>$article
        ]);
    }

}
