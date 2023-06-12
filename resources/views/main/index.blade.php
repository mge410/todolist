@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <button class="btn btn-success" type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModalEdit">Create new
                        todolist
                    </button>
                    @include('include.todolist.create')
                </li>
            </ul>
        </nav>
        <div class="card-deck">
            @foreach($toDoList as $list)
                <div class="card m-1">
                    <div class="card-body">
                        <h5 class="card-title">{{ $list->title }}</h5>
                        <p class="card-text">{{ $list->description }}</p>
                        <p class="card-text"><small class="text-muted">The last
                                task
                                was <span
                                    class="text-danger-emphasis">3 mins ago</span></small>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
