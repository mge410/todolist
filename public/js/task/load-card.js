import editList from "./edit-list.js";

function displayData(data) {
    const cardContent = `
        <div class="card m-1 card-item" id="card-${data.id}" data-id="${data.id}">
            <div class="card-body">
                <div class="row">
                <div>
                <a class="m-1" id="taskImgLink-${data.id}" href="${data.image.url}">
                     <img id="taskImg-${data.id}" src="${data.image.preview_url}" alt="..." class="img-thumbnail">
                </a>
                </div>
                <div>
                <h5 class="card-title mt-3" id="titleContent-${data.id}">${data.title}</h5>
                    <p class="card-text" id="descriptionContent-${data.id}">${data.description}</p>
                    <p class="card-text"><small class="text-muted">The last task was <span class="text-danger-emphasis">3 mins ago</span></small></p>
                </div>
                    <div class="m-2" id="tags">
                    <h5>Tags: <a data-bs-toggle="modal"
                               data-bs-target="#addTagTask-${data.id}"><i class="bi-plus text-success">
                               </a></i></h5>
                               <div id="tags-${data.id}">
                                  ${data.tags && data.tags.map(tag => tag.title &&
                                `<span id="tag-${tag.id}" class="bg-primary badge badge-pill badge-primary m-1">` + tag.title +
                                `<a class="btn-delete-tag" data-route="/main/${data.list_id}/task/${data.id}/tag/destroy/${tag.id}" data-id="${tag.id}">` +
                                `<i class="bi link bi-trash-fill text-danger m-1" id="delete-list"></i></a></span>`).join('')}
                               </div>
                    </div>
                    <div class="mt-3"><a data-bs-toggle="modal"
                               data-bs-target="#exampleModalTaskEdit-${data.id}">
                                <i class="bi link bi-pencil-fill text-primary m-1"
                                   id="delete-list"></i>
                            </a>                <a class="btn-delete-task" data-route="/main/${data.list_id}/task/destroy/${data.id}" data-id="${data.id}">
                        <i class="bi link bi-trash-fill text-danger m-1" id="delete-list"></i>
                    </a></div>
                    <div class="modal fade bd-example-modal-lg"
     id="addTagTask-${data.id}" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="create-success-tag">

        </div>
        <div class="modal-content">
            <h2 class="text-center mt-2">Add a new tag</h2>
            <form class="m-5" method="POST"
                  id="addNewTag-${data.id}">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tag
                        title</label>
                    <input name="title" type="text"
                           class="form-control"
                           id="title" placeholder="Tag title">
                    <span id="tagError"
                          class="text-danger error-messages-tag"></span>
                </div>

                <div class="row justify-content-center">
                    <button type="button" id="createTagBtn-${data.id}"
                            class="col-3 btn btn-primary m-3 text-center">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

                </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg"
     id="exampleModalTaskEdit-${data.id}" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="edit-success">

        </div>
        <div class="modal-content">
            <h2 class="text-center mt-2">Edit</h2>
            <form class="m-5" method="POST"
                  id="editTaskForm-${data.id}"
                  enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Task
                        title</label>
                    <input value="${data.title}" name="title" type="text"
                           class="form-control"
                           id="title" placeholder="Task title">
                    <span id="titleErrorEdit-${data.id}"
                          class="text-danger error-messages-edit"></span>
                </div>
                <div class="form-group">
                    <label
                        for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" class="form-control"
                              id="description"
                              rows="3">${data.description}</textarea>
                    <span id="descriptionError-${data.id}"
                          class="text-danger error-messages-edit"></span>
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
                    <button type="button" id="editListBtn-${data.id}"
                            class="col-3 btn btn-primary m-3 text-center">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>`
    $('.card-deck').append(cardContent)

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    })

    const createTaskForm = $(`#addNewTag-${data.id}`)[0]

    $(`#createTagBtn-${data.id}`).click(function () {

        let form = new FormData(createTaskForm)

        $('.error-messages-tag').html('')
        $('.create-success-tag').html('')

        $.ajax({
            url: `/main/${data.list_id}/task/${data.id}/tag/store/`,
            method: 'POST',
            processData: false,
            contentType: false,
            data: form,

            success: function (response) {
                $('.create-success-tag').html(`
                    <div class="alert alert-success ">
                        ${response.success}
                    </div>
                    `)
                $(`#tags-${data.id}`).append(`<span id="tag-${response.data.id}" class="bg-primary badge badge-pill badge-primary m-1">` + response.data.title +
                    `<a class="btn-delete-tag" data-route="/main/${response.listId}/task/${response.taskId}/tag/destroy/${response.data.id}" data-id="${response.data.id}">` +
                    `<i class="bi link bi-trash-fill text-danger m-1" id="delete-list"></i></a></span>`)
            },
            error: function (error) {
                if (error) {
                    console.error(error)
                    $('#tagError').html(error.responseJSON.errors.title)
                }
            }
        })
    })

    $(`#editListBtn-${data.id}`).click(function () {
        editList(data.id, `/main/${data.list_id}/task/update/${data.id}`)
    })
}

export default displayData
