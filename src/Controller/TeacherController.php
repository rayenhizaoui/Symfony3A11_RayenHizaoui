<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /*    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }
    public function showTeacher($name, $id)
    {
        return new Response('bonjour', $name, $id);
    }
*/
    public function index(): Response
    {
        return new Response('Bonjour');
    }

    public function showTeacher($name, $id)
    {
        return new Response('Bonjour' . $name . ' ' . $id);
    }

    #[Route('/testpath', name: 'app_test')]
    public function  test()
    {
        return new Response('tesssssssst');
    }
}
