@extends('layouts.app')

@section('content')

<script>

    const removeTodo = id => {
        this.event.preventDefault()

        axios.delete(`/todo/${id}`).then(
            response => (response.data.message === 'OK') ? location.reload() : console.log('Something was wrong'),
            rejected => console.log(rejected)
        )
    }

</script>

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
                                <td>{{ $todo->name }}</td>
                                <td class="float-right">
                                    
                                    <a href="">
                                        <i class="fas fa-pen"></i>
                                    </a>

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
