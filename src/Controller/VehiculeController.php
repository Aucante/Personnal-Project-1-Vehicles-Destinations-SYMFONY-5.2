<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\DestinationRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicules", name="vehicule_")
 */
class VehiculeController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(VehiculeRepository $vehiculeRepository): Response
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->render('vehicule/list.html.twig', [
            "vehicules" => $vehicules

        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */

    public function details(int $id, VehiculeRepository $vehiculeRepository, DestinationRepository $destinationRepository): Response
    {
        $vehicule = $vehiculeRepository->find($id);

        $destinations[] = $destinationRepository->findAll();




        return $this->render('vehicule/details.html.twig', [
            "vehicule" => $vehicule,
            "destinations" => $destinations,

        ]);
    }

    /**
     * @Route("/create", name="create")
     */

    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicule = new Vehicule();
        $vehicule->setDateCreated(new \DateTime());


        $vehiculeForm = $this->createForm(VehiculeType::class, $vehicule);

        $vehiculeForm->handleRequest($request);

        if($vehiculeForm->isSubmitted() && $vehiculeForm->isValid())
        {
            $vehicule->setPoster($vehicule->getBackdrop());
            $entityManager->persist($vehicule);
            $entityManager->flush();

            $this->addFlash('success', 'Vehicle added!');
            return $this->redirectToRoute('vehicule_details', ['id' => $vehicule->getId()]);

        }



        return $this->render('vehicule/create.html.twig', [
            'vehiculeForm1' => $vehiculeForm->createView()
        ]);
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function delete(int $id, VehiculeRepository $vehiculeRepository): Response
    {
        $vehicule = $vehiculeRepository->find($id);

        return $this->render('vehicule/delete.html.twig', [
            "vehicule" => $vehicule
        ]);
    }

    /**
     * @Route("/deleteId/{id}", name="deleteId")
     */

    public function deleteId(Vehicule $vehicule, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($vehicule);
        $entityManager->flush();

        return $this->redirectToRoute('main_home');


        return $this->render('vehicule/deleteId.html.twig');
    }






}
