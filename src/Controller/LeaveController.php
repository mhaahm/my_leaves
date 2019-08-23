<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Leave;
use App\Repository\LeaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LeaveController extends AbstractController
{
    private $repository;


    public function __construct(LeaveRepository $repository)
    {
        $this->repository = $repository;

    }

    /**
     * @Route("/admin/leave/", name="leave")
     */
    public function index(Request $request)
    {

        $leaves = [];

        return $this->render('leave/index.html.twig', [
            'leaves' => $leaves,
        ]);
    }


}
