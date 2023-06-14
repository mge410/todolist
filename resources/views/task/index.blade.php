@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto justify-content-between w-100">
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
                <li>
                    <form action="" class="d-flex" method="get">
                        <h3 class="mt-2">Tags filter</h3>
                        <select multiple class="form-select m-1" size="4" aria-label="size 3 select example" name="tags[]">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"> {{ $tag->title }} </option>
                            @endforeach
                        </select>
                        <div class="d-flex flex-column justify-content-between">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a href="{{ route('task.index', $list->id) }}" class="btn btn-primary">Clear</a>
                        </div>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="card-deck">
            @foreach($tasks as $task)
                <script type="module">
                    import displayData from "{{ asset('js/task/load-card.js') }}";

                    displayData(JSON.parse(JSON.stringify(@json($task))))
                </script>
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
                        alert('Task successfully deleted!')
                        $(`#card-${cardId}`).remove()
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr)
                        alert('An error occurred while deleting the entry.');
                    }
                });
            });

            $(document).on('click', '.btn-delete-tag', function () {
                let tagId = $(this).data('id')
                $.ajax({
                    method: 'DELETE',
                    url: $(this).data('route'),
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        id: $(this).data('id'),
                    },
                    success: function (data) {
                        alert('Tag successfully deleted!')
                        $(`#tag-${tagId}`).remove()
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
