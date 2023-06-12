<div class="modal fade bd-example-modal-lg"
     id="exampleModalEdit" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="create-success">

        </div>
        <div class="modal-content">
            <h2 class="text-center mt-2">Edit category</h2>
            <form class="m-5" method="POST"
                  id="createListForm">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Category
                        title</label>
                    <input value="" name="title" type="text"
                           class="form-control"
                           id="title" placeholder="category title">
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
                <div class="text-danger">
                </div>
                <div class="row justify-content-center">
                    <button type="button" id="createListBtn"
                            class="col-3 btn btn-primary m-3 text-center">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        const createListForm = $('#createListForm')[0]

        $('#createListBtn').click(function () {

            let form = new FormData(createListForm)
            $('.error-messages').html('')
            $('.create-success').html('')

            $.ajax({
                url: '{{ route("list.store") }}',
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
                    }
                }
            })
        })
    })
</script>

