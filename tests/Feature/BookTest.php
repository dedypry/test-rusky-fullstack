<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_books()
    {
        // Create some sample books in the database.
        Book::factory()->count(5)->create();

        // Make a request to the index endpoint.
        $response = $this->get('api/v1/book');

        // Assert that the response status code is 200 (OK).
        $response->assertStatus(200);

        // Assert that the response contains data related to books.
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'authors',
                    'description',
                    'published',
                    'image',
                ],
            ],
        ]);
    }
    public function test_can_create_book()
    {
        // Mock a file upload (if needed).
        $file = UploadedFile::fake()->image('book_image.jpg');

        // Make a request to the create endpoint.
        $response = $this->post('api/v1/book', [
            'title' => 'Test Book',
            'authors' => 'Test Author',
            'description' => 'Test Description',
            'published' => '2023-09-05',
            'file' => $file,
        ]);

        // Assert that the response status code is 200 (OK) or 201 (Created).
        $response->assertStatus(200); // Change this to 201 if you're returning 201 upon successful creation.

        // Assert that the response contains the success message or relevant data.
        $response->assertJson([
            'message' => 'Successfully saved.', // Change this to match your success message.
        ]);

        // You can also assert that the book was created in the database if needed.
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'authors' => 'Test Author',
        ]);
    }
}
