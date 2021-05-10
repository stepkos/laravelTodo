<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\TodoDestroyRequest;
use App\Http\Requests\Todo\TodoIndexRequest;
use App\Http\Requests\Todo\TodoStoreRequest;
use App\Http\Requests\Todo\TodoUpdateRequest;
use App\Models\Todo;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller {
    

    // VERB         URI                     ACTION      ROUTE NAME
    // ------------------------------------------------------------
    // GET 	        /photos 	            index 	    photos.index
    // GET 	        /photos/create 	        create 	    photos.create
    // POST         /photos 	            store 	    photos.store
    // GET 	        /photos/{photo} 	    show 	    photos.show
    // GET 	        /photos/{photo}/edit 	edit 	    photos.edit
    // PUT/PATCH 	/photos/{photo} 	    update 	    photos.update
    // DELETE 	    /photos/{photo} 	    destroy     photos.destroy



    public function index(TodoIndexRequest $request) {

        $todos = Todo::where('user_id', auth()->user()->id);
        
        if ($request->wantsJson())
            return response()->json($todos->get());

        $todos = $todos->paginate();
        return view('todo.index', compact('todos'));
    }


    public function store(TodoStoreRequest $request) {

        // ['name' => request->name', 'user_id' => auth()->user()->id]
        Todo::create(array_merge($request->validated(), [
            'user_id' => auth()->user()->id
        ]));

        return redirect('/todo');
    }


    public function destroy(TodoDestroyRequest $request, Todo $todo) {
        $todo->delete();
        return response()->json(['message' => 'OK']);
    }


    public function update(TodoUpdateRequest $request, Todo $todo) {
    
        $todo->update($request->validated());

        return response()->json(['message' => 'OK']);
    }

}