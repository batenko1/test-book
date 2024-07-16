<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use App\Repository\BookRepository;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{

    private BookRepository $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->bookRepository->get();

        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->bookRepository->store($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Store success'
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(StoreRequest $request, Book $book): JsonResponse
    {
        $this->bookRepository->update($book, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Update success'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->bookRepository->delete($book);

        return response()->json([
            'status' => 'success',
            'message' => 'Delete success'
        ], 204);
    }
}
