<?php

namespace App\Controller\Api;

use App\Service\Api\UserActivityApiServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserActivityController extends AbstractController
{
    private UserActivityApiServiceInterface $userActivityApiService;

    /**
     * @param UserActivityApiServiceInterface $userActivityApiService
     */
    public function __construct(UserActivityApiServiceInterface $userActivityApiService)
    {
        $this->userActivityApiService = $userActivityApiService;
    }

    #[Route("/api/v1/user/activity/create", name: "user_activity_create", methods: ["GET"])]
    public function createUserActivity(Request $request): JsonResponse
    {
        return $this->userActivityApiService->create($request);
    }
}