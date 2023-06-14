<div class="modal fade bd-example-modal-lg"
     id="exampleModalTaskCreate" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="create-success">

        </div>
        <div class="modal-content">
            <h2 class="text-center mt-2">Create task</h2>
            <form class="m-5" method="POST"
                  id="createTaskForm" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleFormControlInput1">
                        title</label>
                    <input value="" name="title" type="text"
                           class="form-control"
                           id="title" placeholder="title">
                    <span id="titleError"
                          class="text-danger error-messages"></span>
                </div>
                <div class="form-group">
                    <label
                        for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" class="form-control"
                              id="description"
                              rows="3"></textarea>
                    <span id="descriptionError"
                          class="text-danger error-messages"></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Task image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                   name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                    <span id="imageError"
                          class="text-danger error-messages"></span>
                </div>

                <div class="row justify-content-center">
                    <button type="button" id="createTaskBtn"
                            class="col-3 btn btn-primary m-3 text-center">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module">
    import displayData from "{{ asset('js/task/load-card.js') }}";

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        const createTaskForm = $('#createTaskForm')[0]

        $('#createTaskBtn').click(function () {

            let form = new FormData(createTaskForm)
            $('.error-messages').html('')
            $('.create-success').html('')

            $.ajax({
                url: '{{ route("task.store", $list->id) }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: form,

                success: function (response) {
                    $('.create-success').html(`
                    <div class="alert alert-success ">
                        ${response.success}
                    </div>
                    `)
                    displayData(response.data)
                },
                error: function (error) {
                    if (error) {
                        $('#titleError').html(error.responseJSON.errors.title)
                        $('#descriptionError').html(error.responseJSON.errors.description)
                        $('#imageError').html(error.responseJSON.errors.image)
                    }
                }
            })
        })
    })
</script>

