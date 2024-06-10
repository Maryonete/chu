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
    #[Route('/api/login_check', name: 'api_login_check', methods: ['POST'])]
    /**
     * Login API endpoint for user authentication.
     *
     * This function handles user login requests and generates a JSON Web Token (JWT)
     * upon successful authentication.
     *
     * @param JWTTokenManagerInterface $jwtManager Service for JWT token creation and management
     * @param Request $request Incoming HTTP request object
     * @param UserRepository $userRepository Repository for user data access
     * @return JsonResponse Response containing the JWT token on success or error message on failure
     * @throws AuthenticationException Thrown if user credentials are invalid
     */
    public function loginApi(
        JWTTokenManagerInterface $jwtManager,
        Request $request,
        UserRepository $userRepository
    ): JsonResponse {
        // Get user credentials from the request body (expects JSON format)
        $data = json_decode($request->getContent(), true);
        $email = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        // Validate email and password presence
        if (empty($email) || empty($password)) {
            throw new AuthenticationException('Missing required fields: username and password');
        }

        // Fetch user from repository by email
        $user = $userRepository->findOneBy(['email' => $email]);
        error_log('loginApi : ' . var_export($user, true));
        // Check user existence and password validity
        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new AuthenticationException('Invalid credentials');
        }

        // Generate JWT token for the authenticated user
        $token = $jwtManager->create($user);

        // Return successful login response with JWT token
        return new JsonResponse(['token' => $token]);
        // curl -X POST -H "Content-Type: application/json" http://localhost:8000/api/login_check -d'{"email":"admin-localhost","mot de passe":"123456"}'
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
    }
}
