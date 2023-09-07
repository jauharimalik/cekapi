<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


/**
 * @OA\Info(
 *     description="API Documentation Test Flix",
 *     version="1.0.0",
 *     title="Basic CRUD Laravel API Documentation",
 *     @OA\Contact(
 *         email="jauharimalikupil@gmail.com"
 *     ),
 *     @OA\License(
 *         name="GPL2",
 *         url="https://jauharimalik.github.io"
 *     )
 * )
 */
class MovieController extends Controller
{
    use ResponseTrait;

    public $user;

    /**
     * @OA\GET(
     *     path="/api/movies",
     *     tags={"Movies"},
     *     summary="Get list of movies",
     *     description="Returns list of movies",
     *     operationId="index movies",
     *     @OA\Response(response=200,description="Get Movies List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function index()
    {
        
        try {
            return $this->responseSuccess(Movie::all(), 'Movie List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

/**
 * @OA\Post(
 *     path="/api/movies",
 *     operationId="createMovie",
 *     tags={"Movies"},
 *     summary="Create a new movie",
 *     description="Creates a new movie record",
 *     security={{"bearer":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="title", type="string", example="Pengabdi Setan 2 Comunion"),
 *             @OA\Property(property="description", type="string", example="dalah sebuah film horor Indonesia tahun 2022 yang disutradarai dan ditulis oleh Joko Anwar sebagai sekuel dari film tahun 2017, Pengabdi Setan."),
 *             @OA\Property(property="rating", type="number", example=7.0),
 *             @OA\Property(property="kode", type="string", example="123"),
 *             @OA\Property(property="image", type="string", example=""),
 *         )
 *     ),
 *     @OA\Response(response=201, description="Movie created successfully"),
 *     @OA\Response(response=400, description="Bad request"),
 * )
 */

    public function store(Request $request)
    {
        try {
            return $this->responseSuccess(Movie::create($request->all()), 'Create Movie Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     /**
     * @OA\GET(
     *     path="/api/movies/{movie}",
     *     operationId="getMovieById",
     *     tags={"Movies"},
     *     summary="Get a movie by ID",
     *     description="Returns a movie by its ID",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Movies Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(Movie $movie)
    {
        try {
            return $this->responseSuccess($movie, 'Movie Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
/**
 * @OA\Patch(
 *     path="/api/movies/{movie}",
 *     operationId="updateMovie",
 *     tags={"Movies"},
 *     summary="Update Movie",
 *     description="Updates a movie by its ID",
 *     security={{"bearer":{}}},
 *     @OA\Parameter(
 *         name="movie",
 *         in="path",
 *         description="ID of the movie",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="title", type="string", example="Pengabdi Setan 2 Comunion"),
 *             @OA\Property(property="description", type="string", example="dalah sebuah film horor Indonesia tahun 2022 yang disutradarai dan ditulis oleh Joko Anwar sebagai sekuel dari film tahun 2017, Pengabdi Setan."),
 *             @OA\Property(property="rating", type="number", format="float", example=7.0),
 *             @OA\Property(property="image", type="string", example=""),
 *             @OA\Property(property="kode", type="string", example="123"),
 *             @OA\Property(property="created_at", type="string", example="2022-08-01 10:56:31"),
 *             @OA\Property(property="updated_at", type="string", example="2022-08-13 09:30:23"),
 *         )
 *     ),
 *     @OA\Response(response=200, description="Movie updated successfully"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Movie not found"),
 * )
 */
public function update(Request $request, Movie $movie)
{
    try {
        $movie->update($request->all());
        return $this->responseSuccess($movie, 'Update Movie Successfully !');
    } catch (\Exception $e) {
        return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
/**
 * @OA\Delete(
 *     path="/api/movies/{movie}",
 *     tags={"Movies"},
 *     summary="Delete Movie",
 *     description="Delete Movie from Database",
 *     operationId="deleteMovie",
 *     @OA\Parameter(
 *         name="movie",
 *         in="path",
 *         description="ID of the movie",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(response=204, description="Movie deleted successfully"),
 *     @OA\Response(response=404, description="Movie not found"),
 * )
 */
    public function destroy(Movie $movie)
    {
        try {           
            $movie->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
