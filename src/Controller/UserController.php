<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Form\UserType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, UserService $userService): Response
    {
        $form = $this->createForm(UserType::class, new UserDto());
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $form->getData();
            $userService->create($user);
        }

        return $this->render('user/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/userFromJson', name: 'app_user_Json')]
    public function indexJson(UserService $userService, #[MapRequestPayload] UserDto $user): Response
    {
        $userService->create($user);

        return $this->render('user/index.html.twig', [
            'form' => $user,
        ]);
    }

    #[Route('/getUser', name: 'app_usgetUserer_Json')]
    public function getUserInfo(SerializerInterface $serializer, UserDto $userDTO): Response
    {
        $user = new User('bill', 'gates@microsoft.com', '06666666');
        $userDTO = new UserDto();
        $userDTO->setEmail($user->getEmail());
        $userDTO->setUsername($user->getUsername());
        $userJson = $serializer->serialize($userDTO, 'json');

        return new JsonResponse($userJson, 200, ['Content-Type' => 'application/json'], true);
    }
}
