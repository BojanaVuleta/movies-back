<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MoviesController extends Controller


{

    protected $movieService;
    
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->query('title');
        // $perPage = $request->query('per_page');
        // $page = $request->query('page');
    
        if ($title !== null && $title !== '') {
            $movies = $this->movieService->searchByTitle($title);
        } else {
            $movies = $this->movieService->getAll();
        }
    
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = $this->movieService->storeMovie($data);
        return $movie;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = $this->movieService->showMovie($id);
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $movie = $this->movieService->updateMovie($id, $data);
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = $this->movieService->deleteMovie($id);
        return $movie;
    }
}