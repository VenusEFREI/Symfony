<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\Property2Type;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/property")
 */
class PropertyController extends AbstractController
{
    //methode qui va recupérer toutes les données dans la base et les afficher
    //on a la route aussi en annotation
    /**
     * @Route("/", name="property_index", methods={"GET"})
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        return $this->render('property/index.html.twig', [
            'properties' => $propertyRepository->findAll(),
        ]);
    }

    //methode qui va créer une nouvelle tache

    /**
     * @Route("/new", name="property_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $property = new Property();
       
        $form = $this->createForm(Property2Type::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);//on met en fil d'attente les modifications 
            $entityManager->flush();//on apporte les modification à la base de données

            return $this->redirectToRoute('property_index');//on redirige l'utilisateur sur la page de listing des taches
        }

        return $this->render('property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
        ]);
    }

    //methode qui affiche une tache spécifique avec toutes ses informations

    /**
     * @Route("/{id}", name="property_show", methods={"GET"})
     */
    public function show(Property $property): Response
    {
        return $this->render('property/show.html.twig', [
            'property' => $property,
        ]);
    }

    //methode qui va permettre d'éditer une tache et apporter de ce fait des modifications

    /**
     * @Route("/{id}/edit", name="property_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Property $property): Response
    {
        $form = $this->createForm(Property2Type::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) //on vérifie après soumission si le formulaire est valide 
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('property_index');//après l'édition on redirige l'utilisateur sur la page de listing  
        }

        return $this->render('property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView(),//on envoie à la vue
        ]);
    }

    //methode qui va supprimer les taches

    /**
     * @Route("/{id}", name="property_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Property $property): Response
    {
        //on verifie que le token est valide avant de supprimer pour accroitre la sécurité
        if ($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($property);//on supprime la tache 
            $entityManager->flush();//qui va apporter grace à doctrine les modifications effectué à la base de données
        }

        return $this->redirectToRoute('property_index');
    }
    
}
