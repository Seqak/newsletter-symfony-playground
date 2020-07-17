<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('Homepage');
    }

    /**
     * @Route("/about/{slug}")
     */
    public function about( $slug )
    {
        return new Response(sprintf(
            'Witaj, ' . $slug
        ));
    }
}