<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pages;


class MyController extends Controller
{

    /**
     * @Route("/my")
     */
    public function myAction()
    {
        return new Response(
            '<html><body>Hello</body></html>'
        );
    }

    /**
     * @Route("/my/pages")
     */
    public function pagesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Pages::class);
        $pages = $repository->findAll();

        return $this->render('my/pages.html.twig', [
            'pages' => $pages,
        ]);
    }



    /**
     * @Route("/my/page/{id}")
     * @Method({"GET"})
     */
    public function pageAction($id)
    {
        $page = $this->getDoctrine()
            ->getRepository(Pages::class)
            ->find($id);

        if (! $page) {
            throw $this->createNotFoundException(
                'No page found for id '. $pageId
            );
        }

        return $this->render('my/page.html.twig', [
            'page' => $page,
        ]);

    }
}