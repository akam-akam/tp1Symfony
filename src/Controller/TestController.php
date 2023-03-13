<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


#[Route('/admin')]
class TestController extends AbstractController
{
    #[Route('/test', name: 'toto', methods:['POST','PUT'])]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

   #[Route('/page/{nom}', name: 'pageDynamique')]
    public function f1($nom): Response
    {
        return $this->render('test/page.html.twig', [
            'nom' => $nom,
        ]);
    }


#[Route('/user', name: 'getUser', methods:['GET'])]
    public function fgetUser(Request $r): Response
    {
	if ($r->headers->get('secret'))
        	return new Response('select * from user;');
	else 
		return new Response('Il manque le secret');
    }

#[Route('/user', name: 'createUser', methods:['POST'])]
    public function fcreateUser(Request $r): Response
    {
	print_r($r->query);
       $nom=$r->request->get('nom');
        return new Response("create user  {$nom};");
    }

#[Route('/user/{id}', name: 'getUserId', methods:['GET'])]
    public function fgetUserId($id): Response
    {
        return new Response("select * from user where id = $id");
    }

#[Route('/user/{id}', name: 'updateUserId', methods:['PUT'])]
    public function fupdateUserId($id,Request $r): Response
    {
	print_r($r->request);
        return new Response("update from user where id = $id {}");
    }

#[Route('/user/{id}', name: 'deleteUserId', methods:['DELETE'])]
    public function fdeleteUserId($id): Response
    {
        return new Response("delete from user where id = $id");
    }


#[Route('/form', name: 'form')]
public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        /*$task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
*/

        $form = $this->createFormBuilder()
            ->add('Entrez_votre_nom', TextType::class)
		->add('prenom', TextType::class)
            ->add('age', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();

	return $this->render('test/form.html.twig', ['monFormulaire' => $form]);

    }


}
