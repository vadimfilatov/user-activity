<?php

namespace App\Service\Api;

use App\Entity\UserActivity;
use App\Service\Domain\UserActivityDomainServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserActivityApiService implements UserActivityApiServiceInterface
{
    private UserActivityDomainServiceInterface $userActivityDomainService;
    private ValidatorInterface $validator;
    private Security $security;

    /**
     * @param UserActivityDomainServiceInterface $userActivityDomainService
     * @param ValidatorInterface $validator
     * @param Security $security
     */
    public function __construct(
        UserActivityDomainServiceInterface $userActivityDomainService,
        ValidatorInterface $validator,
        Security $security
    )
    {
        $this->userActivityDomainService = $userActivityDomainService;
        $this->validator = $validator;
        $this->security = $security;
    }

    public function create(Request $request): JsonResponse
    {
        $validateAction = $this->validator->validate(
            $request->get("action"),
            [new Type("string"), new NotNull()]
        );

        if(count($validateAction) > 0) {
            return (new JsonResponse())
                ->setData([
                    "status" => "error",
                    "message" => "Action must be string"
                ]);
        }

        try {

            $this->userActivityDomainService->create(
                (new UserActivity())
                    ->setUserId($this->security->getUser()->getId())
                    ->setDate(
                        (new \DateTimeImmutable())
                            ->setTimestamp(time())
                            ->setTimezone(
                                (new \DateTimeZone("Europe/Kiev"))
                            )
                    )
                    ->setActions($request->get("action"))
            );

            return (new JsonResponse())
                ->setData([
                    "status" => "success",
                    "message" => "User activity created"
                ]);

        } catch (\Exception $exception) {
            return (new JsonResponse())
                ->setData([
                    "status" => "error",
                    "message" => $exception->getMessage()
                ]);
        }
    }
}