<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventSearch;
use App\Entity\Register;
use App\Form\EventSearchType;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\RegisterRepository;
use DateTime;
use Exception;
use Faker;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class EventController extends AbstractController
{
    /**
     * @Route("/events", name="event_index", methods={"GET"})
     * @param EventRepository    $eventRepository
     * @param PaginatorInterface $paginator
     * @param Request            $request
     *
     * @return Response
     */
    public function index(EventRepository $eventRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $search = new EventSearch();
        $form = $this->createForm(EventSearchType::class, $search);
        $form->handleRequest($request);

        $events = $paginator->paginate(
            $eventRepository->findAllQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('event/index.html.twig', [
            'events' =>  $events,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/events/{id}", name="event", methods={"GET"})
     * @param Event $event
     *
     * @return Response
     */
    public function event(Event $event): Response
    {
        // Update number of page views
        $nbViews = (int)$event->getViews();
        $event->setViews($nbViews + 1);
        $form = $this->getDoctrine()->getManager();
        $form->persist($event);
        $form->flush();

        return $this->render('event/event.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/account/events", name="event_account", methods={"GET"})
     * @param EventRepository $eventRepository
     * @param UserInterface   $user
     *
     * @return Response
     */
    public function account(EventRepository $eventRepository, UserInterface $user): Response
    {
        return $this->render('event/account/index.html.twig', [
            'events' => $eventRepository->findBy(['User' => $user], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/account/event/new", name="event_new", methods={"GET","POST"})
     * @param Request       $request
     * @param UserInterface $user
     *
     * @return Response
     * @throws Exception
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        $event->setLabel(strtoupper(substr($faker->uuid, 1, 5)));

        $event->setCreated(new DateTime());
        $event->setUpdated(new DateTime());
        $event->setUser($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvel événement enregistré avec succès.');

            return $this->redirectToRoute('event_account');
        }

        return $this->render('event/account/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/event/{id}", name="event_show", methods={"GET"})
     * @param Event $event
     *
     * @return Response
     */
    public function show(Event $event): Response
    {
        $this->denyAccessUnlessGranted('CRUD', $event);

        return $this->render('event/account/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/account/event/{id}/edit", name="event_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Event   $event
     *
     * @return Response
     */
    public function edit(Request $request, Event $event): Response
    {
        $this->denyAccessUnlessGranted('CRUD', $event);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Événement modifié avec succès.');


            return $this->redirectToRoute('event_account');
        }

        return $this->render('event/account/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/event/{id}", name="event_delete", methods={"DELETE"})
     * @param Request $request
     * @param Event   $event
     *
     * @return Response
     */
    public function delete(Request $request, Event $event): Response
    {
        $this->denyAccessUnlessGranted('CRUD', $event);

        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();

            $this->addFlash('success', 'Événement supprimé avec succès.');
        }

        return $this->redirectToRoute('event_account');
    }

    /**
     * Permet d'enrgistrer la participation d'un utilisateur à un événement
     * @Route("/events/{id}/register", name="event_user_register", methods={"GET"})
     *
     * @param Event              $event
     * @param RegisterRepository $registerRepository
     * @param UserInterface      $user
     *
     * @param Request            $request
     *
     * @return Response
     */
    public function register(Event $event, RegisterRepository $registerRepository, UserInterface $user, Request $request): response
    {

        if (!$user) {
            return $this->json([
                'code'    => 403,
                'message' => 'Unauthorized',
            ], 403);
        }

        $token = $request->get('token');
        $isValidToken = $this->isCsrfTokenValid($user->getEmail(), $token);

        if (!$isValidToken) {
            return $this->json([
                'code'    => 403,
                'message' => 'Unauthorized',
            ], 403);
        }

        $entityManager = $this->getDoctrine()->getManager();

        if ($event->isRegisterByUser($user)) {
            $register = $registerRepository->findOneBy([
                'event' => $event,
                'user'  => $user,
            ]);

            $entityManager->remove($register);
            $entityManager->flush();

            return $this->json([
                'code'      => 200,
                'message'   => 'User unregistered to this event',
                'action'    => 'unregistered',
                'registers' => $registerRepository->count(['event' => $event]),
            ], 200);
        }

        $register = new Register();
        $register
            ->setEvent($event)
            ->setUser($user);
        $entityManager->persist($register);
        $entityManager->flush();

        return $this->json([
            'code'      => 200,
            'message'   => 'User registered to this event',
            'action'    => 'registered',
            'registers' => $registerRepository->count(['event' => $event]),
        ], 200);
    }
}
