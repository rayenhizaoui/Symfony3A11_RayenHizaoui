<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\type;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }


    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]
    public function showAuthor($name)
    {
        return $this->render('author/show.html.twig', [
            'n' => $name
        ]);
    }



    function listAuthors()
    {
        $authors = array(
            array(
                'id' => 1,
                'picture' => '/images/Victor-Hugo.jpg',
                'username' => 'Victor Hugo',
                'email' => 'victor.hugo@gmail.com',
                'nb_books' => 100
            ),
            array(
                'id' => 2,
                'picture' => '/images/william-shakespeare.jpg',
                'username' => 'William Shakespeare',
                'email' => 'william.shakespeare@gmail.com',
                'nb_books' => 200
            ),
            array(
                'id' => 3,
                'picture' => '/images/Taha_Hussein.jpg',
                'username' => 'Taha Hussein',
                'email' => 'taha.hussein@gmail.com',
                'nb_books' => 300
            )
        );

        return $authors;
    }

    /**
     * @Route("/authors/{id}", name="author_details")
     */
    public function authorDetails($id)
    {
        return $this->render('author/showAuthor.html.twig', ['id' => $id]);
    }

    #[Route('/author/get/all}', name: 'app_get_all_author')]
    public function getall(AuthorRepository $repo)
    {
        $authors = $repo->findAll();
        return $this->render('author/listauthors.html.twig', [
            'a' => $authors
        ]);
    }

    #[Route('/author/add', name: 'app_add_author')]
    public function add(ManagerRegistry $manager)
    {

        $author = new Author();
        $author->setUsername('author 1');
        $author->setEmail('author1@esprit.tn');
        $manager->getManager()->persist($author);
        $manager->getManager()->flush();
        return $this->redirectToRoute('app_get_all_author');
    }
    #[Route('/author/delete/{id}', name: 'app_delete_author')]
    public function delete($id, ManagerRegistry $manager, AuthorRepository $repo)
    {
        $author = $repo->find($id);
        $manager->getManager()->remove($author);
        $manager->getManager()->flush();
        return $this->redirectToRoute('app_get_all_author');
    }
}

    /*
    #[Route('/edit/{id}', name: 'app_add_edit')]
    public function edit(AuthorRepository $repository, $id, request $request)
    {

        $author = $repository->find($id);
        $form->this->createForm(type:AuthorType::class, $author);
        $form ->add(child 'Edit',type:SubmitType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute(route:"app_afiche");
        }
    }
*/



    //    $authorList = listAuthors();
