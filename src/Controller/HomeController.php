<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController
{
    /**
     * @var Environment
     */

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }


    /**
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findAll();
        return new Response($this->twig->render('Taches/home.html.twig', [
            'properties' => $properties    
        ]));
    }
}