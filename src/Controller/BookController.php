<?php
namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BookController extends ApiController
{
    /**
    * @Route("/api/v1/books/list", methods="GET")
    */
    public function index(BookRepository $bookRepository)
    {

        $books = $bookRepository->transformAll();

        return $this->respond($books);
    }

    /**
    * @Route("/api/v1/books/add", methods="POST")
    */
    public function create(Request $request, BookRepository $bookRepository, EntityManagerInterface $em)
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

        if (! $request->get('authorid')) {
            return $this->respondValidationError('Please provide a authorid!');
        }

        // persist the new book
        $book = new Book;
        $book->setName($request->get('name'));
        $book->setAuthorid($request->get('authorid'));
        $em->persist($book);
        $em->flush();

        return $this->respondCreated($bookRepository->transform($book));
    }




    /**
   * @Route("/api/v1/books/by-id/{id}", methods="GET")
   */
    public function getOne($id, EntityManagerInterface $em, BookRepository $bookRepository)
    {

        $book = $bookRepository->find($id);
        if (! $book) {
            return $this->respondNotFound();
        }

        return $this->respondCreated($bookRepository->transform($book));

    }

    /**
   * @Route("/api/v1/books/{id}", methods="DELETE")
   */
    public function delete($id, EntityManagerInterface $em, BookRepository $bookRepository)
    {
        if (! $this->isAuthorized()) {
          return $this->respondUnauthorized();
        }
        $book = $bookRepository->find($id);
        if (! $book) {
            return $this->respondNotFound();
        }

        $em->remove($book);
        $em->flush();

        // Suggestion: add a message in the flashbag

        $books = $bookRepository->transformAll();

        return $this->respond($books);
    }
}
