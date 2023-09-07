<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Movie;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MovieControllerTest extends TestCase
{
    public $total = 0;

    public function init(){
        $user = User::where('email', 'jauharimalikupil@gmail.com')->first();
        $login = Auth::loginUsingId($user->id);
        $this->total = Movie::get('id')->count();
    }

    public function test_get_movies(){
        $this->init();
        $this->assertDatabaseCount('movies', $this->total);
    }

    public function test_create_movie()
    {
        $this->init();
        $movieData = [
            'title' => 'Pengabdi Setan',
            'description' => 'Sebuah film horor',
            'rating' => 7.0,
            'image' => '',
            'kode' => '123',
            'created_at' => '2022-08-01 10:56:31',
            'updated_at' => '2022-08-01 10:56:31',
        ];
        Movie::create($movieData);
        $this->assertDatabaseCount('movies', $this->total + 1);

        // Delete the product as need to keep it in database for other tests
        $data = Movie::where('kode', '123')->first();
        $data->delete();
    }

    public function test_update_movie()
    {
        $this->init();
        // Buat entri film sebelumnya dengan kode '123'.
        $movieData = [
            'title' => 'Pengabdi Setan',
            'description' => 'Sebuah film horor',
            'rating' => 7.0,
            'image' => '',
            'kode' => '123',
            'created_at' => '2022-08-01 10:56:31',
            'updated_at' => '2022-08-01 10:56:31',
        ];
        Movie::create($movieData);

        // Temukan film yang akan diperbarui.
        $movie = Movie::where('kode', '123')->first();

        $updatedData = [
            'title' => 'Updated Title',
            'rating' => 8.0,
            'kode' => '123', // Perbarui kode yang sesuai.
        ];

        Movie::where('kode','123')->update($movieData);
        $this->assertDatabaseCount('movies', $this->total + 1);

        // Delete the product as need to keep it in database for other tests
        $data = Movie::where('kode', '123')->first();
        $data->delete();
    }

    public function test_delete_movie()
    {
        $this->init();
        // Buat entri film sebelumnya dengan kode '123'.
        $movieData = [
            'title' => 'Pengabdi Setan',
            'description' => 'Sebuah film horor',
            'rating' => 7.0,
            'image' => '',
            'kode' => '123',
            'created_at' => '2022-08-01 10:56:31',
            'updated_at' => '2022-08-01 10:56:31',
        ];
        $movie = Movie::create($movieData);
        $movie->delete();

        $this->assertDatabaseCount('movies', $this->total);

        // Delete the product as need to keep it in database for other tests
        Movie::where('kode', '123')->delete();
    }
}
