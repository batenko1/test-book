<?php

namespace Tests\Feature\Api;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;


/**
 * Получить список всех книг
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/books",
 *     summary="Получить список книг",
 *     description="Этот метод позволяет получить список книг",
 *     tags={"Book"},
 *     @OA\Response(
 *         response=200,
 *         description="Список книг из базы данных",
 *         @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      type="integer",
 *                      format="int64"
 *                  ),
 *                  @OA\Property(
 *                      property="title",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="publisher",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="author",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="genre",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="publication_date",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="count_words",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="price",
 *                      type="integer"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/books/{book}",
 *     summary="Получить данные одной книги",
 *     description="Этот метод позволяет получить данные одной книги",
 *     tags={"Book"},
 *     @OA\Parameter(
 *       name="book",
 *       in="path",
 *       description="Идентификатор книги",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Книга по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publisher",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="author",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="genre",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publication_date",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="count_words",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="integer"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что книги с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/books",
 *     summary="Создание новой книги",
 *     description="Этот метод позволяет создать одну книгу",
 *     tags={"Book"},
 *     @OA\RequestBody(
 *         description="Данные книги",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="publisher", type="string"),
 *             @OA\Property(property="author", type="string"),
 *             @OA\Property(property="genre", type="string"),
 *             @OA\Property(property="publication_date", type="string"),
 *             @OA\Property(property="count_words", type="integer"),
 *             @OA\Property(property="price", type="integer"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о книге после ее создания из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publisher",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="author",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="genre",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publication_date",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="count_words",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="integer"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания книги",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/books/{book}",
 *     summary="Обновление текущей книги по идентификатору",
 *     description="Этот метод позволяет обновить одну книгу по идентификатору",
 *     tags={"Book"},
 *     @OA\Parameter(
 *       name="book",
 *       in="path",
 *       description="Идентификатор книги",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\RequestBody(
 *         description="Данные книги",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="publisher", type="string"),
 *             @OA\Property(property="author", type="string"),
 *             @OA\Property(property="genre", type="string"),
 *             @OA\Property(property="publication_date", type="string"),
 *             @OA\Property(property="count_words", type="integer"),
 *             @OA\Property(property="price", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Данные о книге после ее обновления из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publisher",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="author",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="genre",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="publication_date",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="count_words",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="price",
 *                  type="integer"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что книги с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для обновления книги",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/books/{book}",
 *     summary="Удаление текущей книги по идентификатору",
 *     description="Этот метод позволяет удалить одну книгу по идентификатору",
 *     tags={"Book"},
 *     @OA\Parameter(
 *       name="book",
 *       in="path",
 *       description="Идентификатор книги",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что книга удалена",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что книги с таким идентификатором не существует",
 *     )
 * )
 */


class BookControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test the index method.
     *
     * @return void
     */
    public function test_index()
    {
        Book::factory()->count(5)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
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

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function test_show()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $book->id,
            'title' => $book->title,
            'publisher' => $book->publisher,
            'author' => $book->author,
            'genre' => $book->genre,
            'count_words' => $book->count_words,
            'price' => $book->price
        ]);

        $response->assertJsonFragment([
            'publication_date' => Carbon::parse($book->publication_date)->format('Y-m-d H:i:s')
        ]);
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_update()
    {
        $book = Book::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'publisher' => 'Updated Publisher',
            'author' => 'Updated Author',
            'genre' => 'Updated Genre',
            'publication_date' => '2023-01-01',
            'count_words' => 2000,
            'price' => 200
        ];

        $response = $this->putJson('/api/books/' . $book->id, $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', $data);
    }


    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_bad_update_validation()
    {
        $book = Book::factory()->create();

        $data = [
            'publisher' => 'Updated Publisher',
            'author' => 'Updated Author',
            'genre' => 'Updated Genre',
            'publication_date' => '2023-01-01',
            'count_words' => 2000,
            'price' => 200
        ];

        $response = $this->putJson('/api/books/' . $book->id, $data);

        $response->assertStatus(422);
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function test_bad_update()
    {
        $bookId = rand(10000, 100000);

        $data = [
            'title' => 'Updated Title',
            'publisher' => 'Updated Publisher',
            'author' => 'Updated Author',
            'genre' => 'Updated Genre',
            'publication_date' => '2023-01-01',
            'count_words' => 2000,
            'price' => 200
        ];

        $response = $this->putJson('/api/books/' . $bookId, $data);

        $response->assertStatus(404);
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function test_destroy()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson('/api/books/' . $book->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function test_bad_destroy()
    {

        $bookId = rand(10000, 100000);
        $response = $this->deleteJson('/api/books/' . $bookId);

        $response->assertStatus(404);
    }
}
