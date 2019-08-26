<?php
namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuthorController extends ApiController
{
    /**
    * @Route("/api/v1/authors/list", methods="GET")
    */
    public function index(AuthorRepository $authorRepository)
    {

        $authors = $authorRepository->transformAll();

        return $this->respond($authors);
    }

    /**
    * @Route("/api/v1/authors/add", methods="POST")
    */
    public function create(Request $request, AuthorRepository $authorRepository, EntityManagerInterface $em)
    {
        if (! $this->isAuthorized()) {
          return $this->respondUnauthorized();
        }
        $request = $this->transformJsonBody($request);
        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the name
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }


        // persist the new author
        $author = new Author;
        $autor->setName($request->get('name'));
        $em->persist($author);
        $em->flush();

        return $this->respondCreated($authorRepository->transform($author));
    }




    /**
   * @Route("/api/v1/authors/by-id/{id}", methods="GET")
   */
    public function getOne($id, EntityManagerInterface $em, AuthorRepository $authorRepository)
    {

        $author = $authorRepository->find($id);
        if (! $author) {
            return $this->respondNotFound();
        }

        return $this->respondCreated($authorRepository->transform($author));

    }

    /**
   * @Route("/api/v1/authors/{id}", methods="DELETE")
   */
    public function delete($id, EntityManagerInterface $em, AuthorRepository $authorRepository)
    {
        if (! $this->isAuthorized()) {
          return $this->respondUnauthorized();
        }
        $author = $authorRepository->find($id);
        if (! $author) {
            return $this->respondNotFound();
        }

        $em->remove($author);
        $em->flush();

        // Suggestion: add a message in the flashbag

        $auhors = $bookRepository->transformAll();

        return $this->respond($authors);
    }
}
