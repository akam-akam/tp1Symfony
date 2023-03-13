<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MyFactoryController extends AbstractController
{
    #[Route('/my/factory', name: 'app_my_factory')]
    public function index()
    {

        $faker = Factory::create('fr_FR'); // Crée une instance de Faker pour générer des données aléatoires en français
        $entityManager = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 500; $i++) {
            $livre = new Livre();
            $livre->setIsbn($faker->isbn13);
            $livre->setTitre($faker->sentence(4));
            $livre->setNbPages($faker->numberBetween(50, 1000));
            $livre->setResume($faker->paragraphs(3, true));

            $entityManager->persist($livre); // Ajoute l'entité à l'unité de travail
        }

        $entityManager->flush(); // Enregistre les 500 entités dans la base de données


        

    }
}