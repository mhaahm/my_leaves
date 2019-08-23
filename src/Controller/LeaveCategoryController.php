<?php

namespace App\Controller;

use App\Entity\LeaveCategory;
use App\Form\LeaveCategoryType;
use App\Repository\LeaveCategoryRepository;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class LeaveCategoryController extends AbstractController
{
    private $repository;
    private $em;

    /**
     * LeaveCategoryController constructor.
     * @param LeaveCategoryRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(LeaveCategoryRepository $repository,ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/leaves/category",options={"expose"=true}, name="leave.category.index")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('leave_category/index.html.twig');
    }
    /**
     * @Route("/admin/leaves/category/fetch",options={"expose"=true}, name="leave.category.fetch")
     * @return Response
     */
    public function fetch() : Response
    {
        $categories = $this->repository->findAll();;
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);

        $normalizer->setCircularReferenceHandler(function ($object) {
            if(method_exists($object, 'getId')){
                return $object->getId();
            }
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        $response = $serializer->serialize($categories, 'json');


        return new Response($response);
    }

    /**
     * @Route("/admin/leaves/category/new",options={"expose"=true},name="leave.category.new",condition="request.isXmlHttpRequest()")
     * @param Request $request
     * @return Response
     */
    //
    public function new(Request $request) : Response
    {
        $leaveCategory = new LeaveCategory();
        $form = $this->createForm(LeaveCategoryType::class,$leaveCategory,
            [
                'action' => $this->generateUrl($request->get('_route'))
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($leaveCategory);
            $this->em->flush();
            $this->addFlash('success', "Record added successfully !");
            $response = [
                'status' => 'success',
                'message' => "Record added successfully !"
            ];
            return new Response(json_encode($response));
        }
        return $this->render('leave_category/form.html.twig', [
            'leaveCategory' => $leaveCategory,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/leaves/category/{id}/edit",options={"expose"=true},name="leave.category.edit",condition="request.isXmlHttpRequest()")
     * @param LeaveCategory $leaveCategory
     * @param Request $request
     * @return Response
     */
    public function edit(LeaveCategory $leaveCategory,Request $request) :Response
    {
        $form = $this->createForm(LeaveCategoryType::class, $leaveCategory,
            [
                'action' => $this->generateUrl($request->get('_route'),array('id' => $leaveCategory->getId()))
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', "Record updated successfully !");
            $response = [
                'status' => 'success',
                'message' => "Record updated successfully !"
            ];
            return new Response(json_encode($response));

        }
        return $this->render("leave_category/form.html.twig", [
            'category' => $leaveCategory,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/leaves/category/{id}/remove",options={"expose"=true},name="leave.category.remove",condition="request.isXmlHttpRequest()")
     * @param LeaveCategory $leaveCategory
     * @param Request $request
     * @return Response
     */
    public function remove(LeaveCategory $leaveCategory,Request $request) : Response
    {
        $this->em->remove($leaveCategory);
        $this->em->flush();
        $this->addFlash('success', "Record removed successfully !");
        $response = [
            'status' => 'success',
            'message' => "Record removed successfully !"
        ];

        return new Response(json_encode($response));
    }

}
