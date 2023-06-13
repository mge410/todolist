@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <button class="btn btn-success" type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModalCreate">Create new
                        todolist
                    </button>
                    @include('include.todolist.create')
                </li>
            </ul>
        </nav>
        <div class="card-deck">
            @foreach($toDoList as $list)
                <script type="module">
                    import displayData from "{{ asset('js/main/load-card.js') }}";

                    displayData(JSON.parse(JSON.stringify(@json($list))))
                </script>
            @endforeach
        </div>
    </div>
    <script type="module">
        $(document).ready(function () {

            $(document).on('click', '.btn-delete-list', function () {
                let cardId = $(this).data('id')
                $.ajax({
                    method: 'DELETE',
                    url: $(this).data('route'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        id: $(this).data('id'),
                    },
                    success: function (data) {
                        alert('List successfully deleted!')
                        $(`#card-${cardId}`).remove()
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('An error occurred while deleting the entry.');
                    }
                });
            });
        });
    </script>
@endsection
