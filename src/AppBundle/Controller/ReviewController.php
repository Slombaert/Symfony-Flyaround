<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Review;
use AppBundle\Form\ReviewType;


/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * List all review entities.
     *
     * @Route ("/", name="review_index")
     * @Method("GET")
     * @return Response A Response instance
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();

        return $this->render ('review/index.html.twig', array(
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
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        // build the form ...

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            // You can use too :
            // return $this->redirect($this->generateUrl('review_show', array('id' => $review->getId())))

            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }

        return $this->render('review/new.html.twig', array(
            'review' => $review,
            'form' => $form->createView(),
        ));

    }
    /**
     * Delete a review entity.
     *
     * @Route("/{id}", name="review_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Review $review)
    {
        $form = $this->createDeleteForm($review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($review);
            $em->flush();
        }

        return $this->redirectToRoute('review_index');
    }

    /**
     * Create a form to delete a review entity.
     *
     * @param Review $review The review entity
     * @return \Symfony\Component\Form\Form The form
     */

    private function createDeleteForm(Review $review)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('review_delete', array('id' => $review->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }





}
