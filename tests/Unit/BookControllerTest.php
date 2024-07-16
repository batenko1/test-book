<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\BookController;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use App\Repository\BookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Mockery;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * Test the index method.
     *
     * @return void
     */
    public function test_index()
    {
        $books = new Collection([new Book(['title' => 'Test Book'])]);

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository->shouldReceive('get')->once()->andReturn($books);

        $controller = new BookController($bookRepository);

        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($books->toArray(), $response->getData(true));
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function test_store()
    {
        $data = [
            'title' => 'Test Book',
            'publisher' => 'Test Publisher',
            'author' => 'Test Author',
            'genre' => 'Test Genre',
            'publication_date' => '2023-01-01',
            'count_words' => 1000,
            'price' => 100
        ];

        $request = StoreRequest::create('/api/books', 'POST', $data);
        $request->setJson(new \Illuminate\Http\Request($data));
        $request->setLaravelSession(app('session')->driver());
        $request->setValidator(Validator::make($data, (new StoreRequest)->rules()));

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository->shouldReceive('store')->once()->with($data);

        $controller = new BookController($bookRepository);

        $response = $controller->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([
            'status' => 'success',
            'message' => 'Store success'
        ], $response->getData(true));
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function test_show()
    {
        $book = new Book(['title' => 'Test Book']);

        $controller = new BookController(new BookRepository($book));
        $response = $controller->show($book);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($book->toArray(), $response->getData(true));
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_update()
    {
        $data = [
            'title' => 'Updated Title',
            'publisher' => 'Updated Publisher',
            'author' => 'Updated Author',
            'genre' => 'Updated Genre',
            'publication_date' => '2023-01-01',
            'count_words' => 2000,
            'price' => 200
        ];

        $book = new Book(['title' => 'Old Title']);
        $request = StoreRequest::create('/api/books/' . $book->id, 'PUT', $data);
        $request->setJson(new \Illuminate\Http\Request($data));
        $request->setLaravelSession(app('session')->driver());
        $request->setValidator(Validator::make($data, (new StoreRequest)->rules()));

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository->shouldReceive('update')->once()->with($book, $data);

        $controller = new BookController($bookRepository);

        $response = $controller->update($request, $book);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([
            'status' => 'success',
            'message' => 'Update success'
        ], $response->getData(true));
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function test_destroy()
    {
        $book = new Book(['title' => 'Test Book']);

        $bookRepository = Mockery::mock(BookRepository::class);
        $bookRepository->shouldReceive('delete')->once()->with($book);

        $controller = new BookController($bookRepository);

        $response = $controller->destroy($book);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEquals([
            'status' => 'success',
            'message' => 'Delete success'
        ], $response->getData(true));
    }
}
