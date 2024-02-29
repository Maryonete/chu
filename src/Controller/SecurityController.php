<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                return $this->redirectToRoute('admin');
            } else {

                return $this->redirectToRoute('app_home_patient');
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    // curl -X POST -H "Content-Type: application/json" http://localhost:8000/api/login_check -d'{"email":"admin-localhost","mot de passe":"123456"}'
    #[Route('/api/login_check', name: 'api_login_check', methods: ['GET', 'POST'])]
    public function loginApi(
        JWTTokenManagerInterface $jwtManager,
        Request $request,
        UserRepository $userRepository
    ): JsonResponse {
        dd('Symfony : loginApi ! ');

        $data = json_decode($request->getContent(), true);

        $email = $data['username'] ?? null;

        $password = $data['password'] ?? null;

        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new AuthenticationException('Identifiants invalides');
        }

        $token = $jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
    }
}
