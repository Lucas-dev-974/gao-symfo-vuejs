<?php

namespace App\Controller;

use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clients")
     */
    public function index(): Response
    {
        return $this->render('clients/index.html.twig', [
            'controller_name' => 'ClientsController',
        ]);
    }

    /**
     * @Route("/api/clients/autocompleteName", name="autocompleteName", methods="GET")
     */
    public function autocompleteName(Request $request, ClientsRepository $clientsRepository, SerializerInterface $serializer){
       
        $name = $request->query->get('inputName');

        if(isset($name)){
            $clients = $clientsRepository->Autocomplete($name);
            $clientsData = [];
            foreach($clients as $client){
                $clientsData[] = [
                    'id' => $client->getId(),
                    'name' => $client->getName(),
                    'lastName' => $client->getLastName()
                ];
            }

            $clientsData = $serializer->serialize($clientsData, 'json');
            return new Response($clientsData);
        }else{
            return new JsonResponse('erreur aucune valeur');
        }
    }
}
