import editList from "./edit-list.js";

function displayData(data) {
    const cardContent = `
        <div class="card m-1 card-item" id="card-${data.id}" data-id="${data.id}">
            <div class="card-body">
                <div class="row">
                <a class="m-1" href="${data.image.url}">
                       <img src="${data.image.preview_url}" alt="..." class="img-thumbnail">
                </a>
                <div>
                <h5 class="card-title mt-3" id="titleContent-${data.id}">${data.title}</h5>
                    <p class="card-text" id="descriptionContent-${data.id}">${data.description}</p>
                    <p class="card-text"><small class="text-muted">The last task was <span class="text-danger-emphasis">3 mins ago</span></small></p>
                    <a data-bs-toggle="modal"
                               data-bs-target="#exampleModalTaskEdit-${data.id}">
                                <i class="bi link bi-pencil-fill text-primary m-1"
                                   id="delete-list"></i>
                            </a>                <a class="btn-delete-task" data-route="/main/${data.list_id}/task/destroy/${data.id}" data-id="${data.id}">
                        <i class="bi link bi-trash-fill text-danger m-1" id="delete-list"></i>
                    </a>
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
            <h2 class="text-center mt-2">Edit category</h2>
            <form class="m-5" method="POST"
                  id="editListForm-${data.id}">
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Category
                        title</label>
                    <input value="${data.title}" name="title" type="text"
                           class="form-control"
                           id="title" placeholder="category title">
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
                <div class="text-danger">
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

    $(`#editListBtn-${data.id}`).click(function () {
        editList(data.id, `/main/${data.list_id}/task/update/${data.id}`)
    })
}

export default displayData
