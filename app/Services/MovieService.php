<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Validator;


class MovieService{
    public function checkMovieExists(string $title, string $releaseDate, string $excludeId = null)
    {
        $query = Movie::where('title', $title)->where('release_date', $releaseDate);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }

    public function getAll()
    {
        return Movie::all();
    }

    public function searchByTitle($title, $perPage = 10, $page = 1)
    {
        $query = Movie::query();

        if ($title !== null && $title !== '') {
            $query->where('title', 'like', '%' . $title . '%');
        }  
        return $query;
    }

    public function showMovie($id)
    {
        return Movie::findOrFail($id);
    }

    public function storeMovie($data)
    {
        // $validator = Validator::make($data, [
        //     'title' => 'required',
        //     'director' => 'required',
        //     'duration' => 'required|numeric|min:1|max:500',
        //     'release_date' => 'required|date',
        //     'image_url' => 'url',
        // ]);

        // if ($validator->fails()) {
        //     throw new \InvalidArgumentException($validator->errors()->first());
        // }

        // $exists = $this->checkMovieExists($data['title'], $data['release_date']);
        // if ($exists) {
        //     throw new \InvalidArgumentException('Movie with the same title and release date already exists');
        // }

        return Movie::create($data);
    }

    public function updateMovie($id, $data)
    {
        //     $validator = Validator::make($data, [
        //     'title' => 'required',
        //     'director' => 'required',
        //     'duration' => 'required|numeric|min:1|max:500',
        //     'release_date' => 'required|date',
        //     'image_url' => 'url',
        // ]);

        // if ($validator->fails()) {
        //     throw new \InvalidArgumentException($validator->errors()->first());
        // }

        // $exists = $this->checkMovieExists($data['title'], $data['release_date'], $id);
        // if ($exists) {
        //     throw new \InvalidArgumentException('Movie with the same title and release date already exists');
        // }

        $movie = Movie::findOrFail($id);
        $movie->update($data);
        return $movie;
    }

    public function deleteMovie($id)
    {
        $car = Movie::findOrFail($id);
        $car->delete();
        return $car;
    }
}