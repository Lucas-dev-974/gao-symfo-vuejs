<?php

namespace App\Controller;

use App\Entity\Assignements;
use App\Entity\Computers;
use App\Repository\AssignementsRepository;
use App\Repository\ComputersRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ComputersController extends AbstractController
{
    /**
     * @Route("/api/computers", name="computers", methods={"GET"})
     */
    public function getComputer(Request $request, ComputersRepository $computerRepository, AssignementsRepository $assignementsRepository, SerializerInterface $serializer) : JsonResponse
    {
        $date = $request->query->get('date');
        $computerData = [];

        // get computers with its attributions
        $computers = $computerRepository->findAll();    
        
        foreach ($computers as $computer){
            $attribution = $assignementsRepository->findBy(['date' => new DateTime($date), 'computer' => $computer]);
            $attributions = [];
            // return new JsonResponse($serializer->serialize($attribution, 'json'));
            foreach($attribution as $attr){
                if($attr->getComputer() === $computer){
                    $attributions[] = [
                        'id'       => $attr->getId(),
                        'horraire' => $attr->getHorraire(),
                        'date'     => $attr->getDate()->format('Y-m-d'),
                        'client'   => $attr->getClient(),
                        'computer' => $attr->getComputer()
                    ];  
                }
            }
            

            // format in array computer data
            $computerData[] = [
                'id' => $computer->getId(),
                'name' => $computer->getName(),
                'attributions' => $attributions
            ];

        }
        $json = $serializer->serialize($computerData, 'json');
        return new JsonResponse($json);
        
    }

    /**
     * @Route("/api/computers/add", name="computersAdd", methods="POST")
     */
    public function add(Request $request): Response
    {
        $name = $request->query->get('computerName');

        $entityManager = $this->getDoctrine()->getManager();
        $computer = new Computers();
        $computer->setName($name);
        $entityManager->persist($computer);
        $entityManager->flush();

        return new Response('data with id: ' . $computer->getid() . ' saved');
    }


    /**
     * @Route("/api/computers/delete", name="computersDelete", methods="POST")
     */
    public function delete(Request $request){
        $id = $request->query->get('computerId');
        $computerManager = $this->getDoctrine()->getManager();
        $computer = $computerManager->getRepository(Computers::class)->find($id);

        if(!$computer){
            return new JsonResponse('Aucun ordinateur avec l\'id ' . $id . ' n\'a était trouver. suppression impossible');
        }else{
            $computerManager->remove($computer);
            $computerManager->flush();
            return new JsonResponse('ok ordinateur supprimer !');
        }
    }


}
