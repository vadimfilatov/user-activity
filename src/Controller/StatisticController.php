<?php

namespace App\Controller;

use App\DTO\Query\UserActivityQueryDTO;
use App\Repository\UserRepository;
use App\Service\Domain\UserActivityDomainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    private UserActivityDomainServiceInterface $userActivityDomain;
    private UserRepository $userRepository;

    /**
     * @param UserActivityDomainServiceInterface $userActivityDomain
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserActivityDomainServiceInterface $userActivityDomain,
        UserRepository $userRepository
    )
    {
        $this->userActivityDomain = $userActivityDomain;
        $this->userRepository = $userRepository;
    }

    #[Route("/statistic", name: "statistic", methods: ["GET"])]
    public function index(Request $request)
    {
        $userActivities = $this->userActivityDomain->query(
            UserActivityQueryDTO::fromArray($request->query->all())
                ->setOrderBy("UA.id")
                ->setOrderDir("DESC")
        );

        return $this->render("statistic.html.twig", [
            "userActivities" => $userActivities->getEntities(),
            "count" => $userActivities->getCount(),
            "pages" => $userActivities->getPagination()->getPages(),
            "currentPage" => $userActivities->getPagination()->getPage(),
            "nextPage" => $userActivities->getPagination()->getNextPage(),
            "prevPage" => $userActivities->getPagination()->getPrevPage(),
            "request" => $request->query->all(),
            "actions" => [
                "link-cow" => "page view A",
                "link-app" => "page view B",
                "button-cow" => "click 'Buy a cow'",
                "button-app" => "click 'Download'",
            ],
            "users" => $this->userRepository->findAll()
        ]);
    }

}