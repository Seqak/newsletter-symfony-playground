<?php

namespace App\Controller;

use App\Entity\Addresses;
use App\Repository\AddressesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AddressesController
 * @package App\Controller
 * @Route("/addresses", name="addresses.")
 */
class AddressesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AddressesRepository $addressesRepository)
    {
        $adresses = $addressesRepository->findAll();

        return $this->render('addresses/index.html.twig', [
            'addresses' => $adresses,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $address = new Addresses();

        $emailNumber = rand(6, 100);
        $address->setEmail("test" . $emailNumber . "@test.pl");

        $em = $this->getDoctrine()->getManager();

        $em->persist($address);
        $em->flush();

        $this->addFlash('success', 'E-mail address has been added.');

        return $this->redirect($this->generateUrl('addresses.index'));
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Addresses $addresses)
    {

        return $this->render('addresses/show.html.twig', [
            'address' => $addresses
        ]);
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Addresses $addresses)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($addresses);
        $em->flush();

        $this->addFlash('success', 'E-mail address has been deleted.');

        return $this->redirect($this->generateUrl('addresses.index'));
    }
}
