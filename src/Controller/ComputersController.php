<?php

namespace App\Controller;

use App\Entity\Computers;
use App\Repository\ComputersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ComputersController extends AbstractController
{
    /**
     * @Route("/computers/{slug}", name="computers", methods={"GET", "HEAD"})
     */
    public function getComputer(String $slug) : JsonResponse
    {
        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();
        $serializer = new Serializer([$normalizer], [$encoder]);
        
        $data = $this->getDoctrine()->getRepository(Computers::class)->findAll();
        $test = $serializer->serialize($data, 'json');
        
        return new JsonResponse($test);
    }

    /**
     * @Route("/computers/basicAdd", name="basicAdd")
     */
    public function basicAdd(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $computer = new Computers();
        $computer->setName('ordi 1');
        
        $entityManager->persist($computer);
        $entityManager->flush();

        return new Response('data with id: ' . $computer->getid() . ' saved');
    }

    /**
     * @Route("/url/{id}", name="computersid")
     */
    public function getid(int $id): Response
    {
        return new Response('id' . $id);
    }

}
