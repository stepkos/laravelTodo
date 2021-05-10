<?php

namespace App\Http\Controllers;

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



    public function index() {

        $todos = Todo::where('user_id', auth()->user()->id)->paginate();
        
        return view('todo.index', compact('todos'));
    }


    public function store(Request $request) {

        Todo::create([
            'name' => $request->get('name'),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/todo');
    }

    public function destroy(Todo $todo) {
        $todo->delete();
        return response()->json(['message' => 'OK']);
    }

    public function update(Request $request, Todo $todo) {
    
        $todo->update([
            'name' => $request->get('name')
        ]);

        return response()->json(['message' => 'OK']);
    }

}