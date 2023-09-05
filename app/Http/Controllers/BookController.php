<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    use Response;
    public function index(Request $request)
    {
        $book = Book::where(function ($q) use ($request) {
            if ($request->has('q')) {
                $q->where('title', 'like', "%$request->q%")
                    ->where('authors', 'like', "%$request->q%");
            }
        })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return $this->success($book);
    }

    public function detail($book)
    {
        $data = Book::with(['user'])
            ->find($book);
        return $this->success($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            "title" => 'required',
            "authors" => 'required',
            "published" => 'required',
        ]);

        $image = '';
        if ($request->has('file')) {
            $patch = "/files/uploads/" . now()->format('Y-m-d');
            $file = $request->file('file');
            $name = $request->title . "." . $file->getClientOriginalExtension();
            $file->move(public_path($patch), $name);
            $image = $patch . '/' . $name;
        }

        Book::updateOrCreate(['id' => $request->id], [
            "title" => $request->title,
            "authors" => $request->authors,
            "description" => $request->description,
            "published" => $request->published,
            "image" => $image,
        ]);

        return $this->success(null, config('msg.save'));
    }


    public function destroy(Book $book)
    {
        File::delete($book->image);
        $book->delete();
        return $this->success(null, config('msg.delete'));
    }

    public function bookUser(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);

        $book = Book::find($request->id);


        if (!$book->ready && $request->type == 'add') {
            return $this->error('Book Not Ready');
        }

        $book->update([
            'ready' => $request->type == 'add' ? false : true,
        ]);

        if ($request->type != 'add') {
            $bu = BookUser::find($request->id);
            $bu->update([
                'return_at' => now()
            ]);
            return $this->success(null, config('msg.save'));
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('123456')
            ]);
        }



        if ($request->type === 'add') {
            $book->user()->attach($user->id, [
                'received_at' => now(),
                'note' => $request->note
            ]);
        }

        return $this->success(null, config('msg.save'));
    }
}
