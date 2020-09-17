<?php
namespace App\Controller\Admin;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{   /**
    * @var PropertyRepository
    */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/Admin", name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response 
     */

    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('Admin/Property/index.html.twig', compact('properties'));
    }
    
    /**
     * @Route("/Admin/property/create", name="admin.property.new")
     * @return \Symfony\Component\HttpFoundation\Response 
     */

    public function new(Request $request)
    {   
        $property= new Property();
        $form = $this->createForm(PropertyType::class, $property );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {   
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien crée avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('Admin/Property/new.html.twig',[
            'property'=> $property,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/Admin/property/{id}/edit", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response 
     */

    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('Admin/Property/edit.html.twig',[
            'property'=> $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/Admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\RedirectResponse 
     */
    public function delete(Property $property,EntityManagerInterface $em,Request $request)
    {   if($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token')))
        {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
          
        }
      
        return $this->redirectToRoute('admin.property.index');
    }
}