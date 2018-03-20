<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PropertyType;
use App\Entity\Property;

class PropertyController extends AbstractController
{
    /**
     * @Route("/", name="property")
     */
    public function index()
    {
        /*$em = $this->getDoctrine()->getManager();

        $property = new Property();

        $property->setTitle("Adosado en Calle Mozart");
        $property->setDescription("Propiedad de 4 habitaciones en ubicación inmejorable");
        $property->setPrize(380000);
        $property->setRooms(4);
        $property->setBathrooms(2);
        $property->setToilets(2);
        $property->setSize(280);
        $property->setPlotSize(350);
        $property->setProvince("Guadalajara");

        $em->persist($property);
        $em->flush();
        */
        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
        ]);
    }

    /**
     * @param Request $
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/new-property", name="admin_new_property")
     */
    public function new(Request $request){
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property);

        // only handles data on POST
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Propiedad creada!');
            $property = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();

            return $this->redirectToRoute('admin_list_properties');
        }


        return $this->render('property/new.html.twig', array(
            'form' => $form->createView()
            //'action' => 'add'
        ));
    }

    /**
     * @Route("/admin/show-property/{id}", name="admin_show_property")
     */
    public function showAction(Property $property){

        /*return new Response("Propiedad_id:".$property->getId());*/
        return $this->render('property/show.html.twig', [
            'property' => $property
        ]);

        /*return new Response("Propiedad_id:".$property->getId()."Propiedad_titulo:".$property->getTitle());*/
    }

    /**
     * @Route("/admin/list-properties", name="admin_list_properties")
     *
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $properties = $em->getRepository(Property::class)->findAll();
        //dump($properties);

        return $this->render('property/list.html.twig', [
            'properties' => $properties
        ]);

        /*
        $propertiesJson = $this->get('serializer')->serialize($properties, 'json');

        $response = new JsonResponse($propertiesJson);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
        //return new JsonResponse(json_encode($properties));
        */


    }

    /**
     * Ajax Method that returns the poperties ordered in 
     */
    public function listAjaxAction(){

    }

    /**
     *
     * @Route("/admin/edit-property/{id}", name="admin_edit_property")
     *
     */
    public function editAction(Request $request, Property $property){
        var_dump($property->getId());
        //$em = $this->getDoctrine()->getManager();
        //$property = $em->getRepository(Property::class)->find($property->getId());

        if(!$property){
            throw $this->createNotFoundException(
              "No hay propiedad con id: ".$id
            );
        }else{
            $form = $this->createForm(PropertyType::class, $property);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $property = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($property);
                $em->flush();

                $this->addFlash('success', 'Propiedad actualizada!');

                return $this->redirectToRoute('admin_list_properties');
            }
        }



        //$property->setTitle("Titulo nuevo");

        //$em->flush();

        /*return $this->redirectToRoute('property_show', [
           'id' => $property->getId()
        ]);
        */
        return $this->render('property/new.html.twig', array(
            'form' => $form->createView()
            //'action' => 'edit'
        ));

    }

    /**
     * @Route("/admin/delete-property/{id}", name="admin_delete_property")
     */
    public function deleteAction(Property $property){
        //$em = $this->getDoctrine()->getManager();

        //$property = $em->getRepository(Property::class)->find($id);

        if(!$property){
            throw $this->createNotFoundException(
                "No hay propiedad con id: ".$id
            );
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($property);
            $em->flush();

            $this->addFlash('success', 'Propiedad eliminada!');

            return $this->redirectToRoute('admin_list_properties');

        }


    }
}
