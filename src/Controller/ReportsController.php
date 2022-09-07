<?php

namespace App\Controller;

use App\Service\Domain\UserActivityDomainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReportsController extends AbstractController
{
    private UserActivityDomainServiceInterface $userActivityDomainService;

    /**
     * @param UserActivityDomainServiceInterface $userActivityDomainService
     */
    public function __construct(UserActivityDomainServiceInterface $userActivityDomainService)
    {
        $this->userActivityDomainService = $userActivityDomainService;
    }

    #[Route("/reports", name: 'reports', methods: ['GET'])]
    public function index()
    {
        $userActivities = $this->userActivityDomainService->getDataForReport();

        return $this->render("report.html.twig", [
            'userActivities' => $userActivities
        ]);
    }
}