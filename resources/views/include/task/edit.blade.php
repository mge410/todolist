<div class="modal fade bd-example-modal-lg"
     id="exampleModalTaskEdit-{{$task->id}}" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="edit-success">

        </div>
        <div class="modal-content">
            <h2 class="text-center mt-2">Edit category</h2>
            <form class="m-5" method="POST"
                  id="editListForm-{{$task->id}}">
                @method('PATCH')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Category
                        title</label>
                    <input value="{{ $task->title }}" name="title" type="text"
                           class="form-control"
                           id="title" placeholder="category title">
                    <span id="titleErrorEdit-{{$task->id}}"
                          class="text-danger error-messages-edit"></span>
                </div>
                <div class="form-group">
                    <label
                        for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" class="form-control"
                              id="description"
                              rows="3">{{ $task->description }}</textarea>
                    <span id="descriptionError-{{$task->id}}"
                          class="text-danger error-messages-edit"></span>
                </div>
                <div class="text-danger">
                </div>
                <div class="row justify-content-center">
                    <button type="button" id="editTaskBtn-{{$task->id}}"
                            class="col-3 btn btn-primary m-3 text-center">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module">
    import editList from "{{ asset('js/task/edit-list.js') }}";

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

    })

    $('#editTaskBtn-{{$task->id}}').click(function () {
        editList({{$task->id}}, '{{ route("task.update", $task->id) }}')
    })
</script>
