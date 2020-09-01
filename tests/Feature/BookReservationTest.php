<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBookCanBeAdded()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Bookety book!',
            'author' => 'Vladimir',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function titleIsRequired()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Vladimir',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function authorIsRequired()
    {
        $response = $this->post('/books', [
            'title' => 'Vladimir\'s book',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function bookCanBeUpdated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Vladimir\'s book',
            'author' => 'Vladimir',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'Vladimir\'s cooool book',
            'author' => 'Vladimir Pejic',
        ]);

        $this->assertEquals('Vladimir\'s cooool book', Book::first()->title);
        $this->assertEquals('Vladimir Pejic', Book::first()->author);
    }
}
