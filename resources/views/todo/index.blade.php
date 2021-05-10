@extends('layouts.app')

@section('content')

<script>

    const removeTodo = id => {
        this.event.preventDefault();

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

<script>

    document.querySelectorAll('.todoClass').forEach(element => {
        element.addEventListener('dblclick', () => {

            if (element.classList.contains('clicked')) {
                axios.put(`/todo/${element.getAttribute('id')}`, { name: element.querySelector('input').value }).then(
                    response => (response.data.message === 'OK') ? location.reload() : console.log('Something was wrong'),
                    rejected => console.log(rejected)
                );
                // element.innerHTML = element.querySelector('input').getAttribute('value');
            }
            else {
                element.innerHTML = `
                    <input 
                        type="text" 
                        value="${element.textContent}" 
                        name="name${element.getAttribute('id')}"
                    >
                `;
            }

            element.classList.toggle('clicked');

        })
    });

</script>

@endsection
