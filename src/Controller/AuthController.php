<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{

    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/registration', name: 'registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        if($this->getUser()) {
            return $this->redirect("/");
        }

        if ($request->request->all()) {
            $user = new User();
            $user->setUsername($request->request->get("username"));
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $request->request->get("password")
                )
            );
            $user->setRoles(['ROLE_USER']);
            $this->userRepository->add($user, true);
            return $this->redirect("/login");
        }

        return $this->render("registration.html.twig");
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        if($this->getUser()) {
            return $this->redirect("/");
        }

        return $this->render('login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout() {}
}