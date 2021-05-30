<?php


namespace App\Controller;


use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="main_home")
     */
    public function home(VehiculeRepository $vehiculeRepository)
    {
        $vehicules = $vehiculeRepository->findAll();

        return $this->render('main/home.html.twig', [
            "vehicules" => $vehicules

        ]);
    }

    /**
     * @Route("/contact", name="main_contact")
     */
    public function contact()
    {
        return $this->render('main/contact.html.twig');
    }


}