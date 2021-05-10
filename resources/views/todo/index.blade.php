@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Dodawanie nowego todo</div>
                <div class="card-body">
                    <form action="/todo" method="POST">
                    
                        @csrf

                        <input type="text" name="name">

                        <input type="submit" value="Add">

                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header">Lista todo</div>

                <div class="card-body">
                        
                    <table class="table">
                        
                        <tr>
                            <th>Name</th>
                            <th class="float-right">Actions</th>
                        </tr>

                        @foreach($todos as $todo)
                            <tr>
                                <td style="user-select: none;" class="todoClass" id="{{$todo->id}}">{{ $todo->name }}</td>
                                <td class="float-right">

                                    <a href="">
                                        <i class="fas fa-search"></i>
                                    </a>

                                    <a href="#" onclick="removeTodo({{ $todo->id }});">
                                        <i class="fas fa-times"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach


                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="js/todo/index.js"></script>
@endpush