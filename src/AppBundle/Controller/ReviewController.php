<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * List one review with one flight and one user.
     *
     * @Route ("/", name="review_index")
     * @Method("GET")
     * @return Response A Response instance
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render ('review/index.html.twig', array (
            'reviews' => $reviews,
        ));
    }

    /**
     * Creates a new review entity.
     *
     * @param Request $request New posted info
     *
     * @Route ("/new", name="review_new")
     * @Method ({"GET", "POST"})
     * @return Response A Response instance
     */
    public function newAction(Request $request)
    {
        return $this->render($request);
    }
}
