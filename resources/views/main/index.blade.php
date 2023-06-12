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
                <div class="card m-1" id="card-{{ $list->id }}">
                    <div class="card-body">
                        <h5 class="card-title" id="titleContent-{{$list->id}}">{{ $list->title }}</h5>
                        <p class="card-text" id="descriptionContent-{{$list->id}}">{{ $list->description }}</p>
                        <p class="card-text"><small class="text-muted">The last
                                task was <span class="text-danger-emphasis">3 mins ago</span></small>
                        </p>
                        <a data-bs-toggle="modal"
                           data-bs-target="#exampleModalEdit-{{$list->id}}">
                            <i class="bi link bi-pencil-fill text-primary m-1"
                               id="delete-list"></i>
                        </a>
                        @include('include.todolist.edit')

                        <a class="btn-delete-post"
                           data-route="{{ route('list.destroy', $list->id) }}"
                           data-id="{{ $list->id }}">
                            <i class="bi link bi-trash-fill text-danger m-1"
                               id="delete-list"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script type="module">
        $(document).ready(function () {

            $(document).on('click', '.btn-delete-post', function () {
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
