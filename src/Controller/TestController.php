<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/page/{nom}', name:'pageDynamique')]
    public function f1($nom): Response{
        return $this->render('test/page.html.twig',[
            'nom' => $nom,
        ]);
    }

    #[Route('/user', name: 'getUser', methods:['GET'])]
    public function fgetUser(): Response
    {
        return new Response('Select * from user;');
    }
    
    #[Route('/user', name: 'createUser', methods:['POST'])]
    public function fsetUser(): Response
    {
        return new Response('Create user {}');
    }

    #[Route('/form',  name:'form')]
    public function form(Request $r):Response{

        // creates a task object and initializes some data for this example
        // $task = new Task();
        // $task->setTask('Write a blog post');
        // $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add("age", TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        return $this->render('test/form.html.twig', ['form' => $form]);
    }
    
    
}