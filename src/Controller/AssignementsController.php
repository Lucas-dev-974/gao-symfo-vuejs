<?php

namespace App\Controller;

use App\Entity\Assignements;
use App\Entity\Computers;
use App\Repository\AssignementsRepository;
use App\Repository\ClientsRepository;
use App\Repository\ComputersRepository;
use DateTime;
use PhpParser\Node\Expr\Assign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssignementsController extends AbstractController
{
    /**
     * @Route("/assignements", name="assignements")
     */
    public function index(): Response
    {
        return $this->render('assignements/index.html.twig', [
            'controller_name' => 'AssignementsController',
        ]);
    }

    /**
     * @Route("/api/assignements/add", name="addAssignemets", methods="POST")
     */
    public function add(Request $request, ComputersRepository $computersRepository, ClientsRepository $clientsRepository){
        $date  = $request->query->get('date');
        $horraire = $request->query->get('horraire');
        $computerId = $request->query->get('computerId');
        $clientId   = $request->query->get('clientId');
        $entityManager = $this->getDoctrine()->getManager();

        if(isset($date) && isset($horraire) && isset($computerId) && isset($clientId)){
            $computer = $computersRepository->find($computerId);
            $client   = $clientsRepository->find($clientId);

            $assign = new Assignements();
            $assign->setDate(new DateTime($date));
            $assign->setHorraire($horraire);
            $assign->setComputer($computer);
            $assign->setClient($client);

            $entityManager->persist($assign);
            $entityManager->flush();
            return new JsonResponse('ok');
        }else{
            return new JsonResponse('nop');
        }
    }

    /**
     * @Route("/api/assignements/delete", name="deleteAssignemets", methods="POST")
     */
    public function delete(Request $request, AssignementsRepository $assignementsRepository){

        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->query->get('assignementId');
        $assign = $assignementsRepository->find($id);
        if($assign){
            $entityManager->remove($assign);
            $entityManager->flush();
            return new JsonResponse('Suppresion assignement ok');
        }else{
            return new JsonResponse('Aucun assignement avec l\'id ' . $id . 'n\'a était tourver !');
        }
        return new JsonResponse('ok delete attr');
    }
}
