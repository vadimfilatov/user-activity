<?php

namespace App\Controller;

use App\Entity\UserActivity;
use App\Service\Domain\UserActivityDomainServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private UserActivityDomainServiceInterface $userActivityDomainService;

    /**
     * @param UserActivityDomainServiceInterface $userActivityDomainService
     */
    public function __construct(UserActivityDomainServiceInterface $userActivityDomainService)
    {
        $this->userActivityDomainService = $userActivityDomainService;
    }

    #[Route("/cow", name: "cow", methods: ["GET"])]
    public function cow()
    {
        $this->userActivityDomainService->create(
            (new UserActivity())
                ->setUserId($this->getUser()->getId())
                ->setActions("link-cow")
                ->setDate(
                    (new \DateTimeImmutable())
                        ->setTimestamp(time())
                        ->setTimezone(
                            (new \DateTimeZone("Europe/Kiev"))
                        )
                )
        );

        return $this->render("cow.html.twig");
    }

    #[Route("/app", name: "app", methods: ["GET"])]
    public function app()
    {
        $this->userActivityDomainService->create(
            (new UserActivity())
                ->setUserId($this->getUser()->getId())
                ->setActions("link-app")
                ->setDate(
                    (new \DateTimeImmutable())
                        ->setTimestamp(time())
                        ->setTimezone(
                            (new \DateTimeZone("Europe/Kiev"))
                        )
                )
        );

        return $this->render("app.html.twig");
    }

    #[Route("/app/download", name: "app_download", methods: ["GET"])]
    public function downloadApp()
    {
        $this->userActivityDomainService->create(
            (new UserActivity())
                ->setUserId($this->getUser()->getId())
                ->setActions("button-app")
                ->setDate(
                    (new \DateTimeImmutable())
                        ->setTimestamp(time())
                        ->setTimezone(
                            (new \DateTimeZone("Europe/Kiev"))
                        )
                )
        );

        $response = new BinaryFileResponse("/var/www/html/public/files/setup.exe");
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'setup.exe'
        );

        return $response;
    }
}