@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="btn btn-warning"
                       href="{{ route('list.index') }}">Back to list
                    </a>
                    <button class="btn btn-success" type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModalTaskCreate">Create new
                        task
                    </button>
                    @include('include.task.create')
                </li>
            </ul>
        </nav>
        <div class="card-deck">
            @foreach($tasks as $task)
                <div class="card m-1" id="card-{{ $task->id }}">
                    <div class="card-body">
                        <a class="link link-underline link-underline-opacity-0"
                           href=" {{ route('task.index', $list->id) }} "><h5
                                class="card-title"
                                id="titleContent-{{$list->id}}">{{ $task->title }}</h5>
                        </a>
                        <a class="link-dark link-underline link-underline-opacity-0"
                           href=" {{ route('task.index', $list->id) }} "><p
                                class="card-text"
                                id="descriptionContent-{{$list->id}}">{{ $task->description }}</p>
                        </a>
                        <p class="card-text"><small class="text-muted">The last
                                task was <span class="text-danger-emphasis">3 mins ago</span></small>
                        </p>

                        <a class="btn-delete-task"
                           data-route="{{ route('task.destroy', ['list_id' => $list->id, 'task_id' =>  $task->id]) }}"
                           data-id="{{ $task->id }}">
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

            $(document).on('click', '.btn-delete-task', function () {
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
                        console.log(xhr)
                        alert('An error occurred while deleting the entry.');
                    }
                });
            });
        });
    </script>
@endsection
