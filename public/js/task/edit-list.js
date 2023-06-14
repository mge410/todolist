function editList(listId, url) {
    const editTaskForm = $(`#editTaskForm-${listId}`)[0]

    let form = new FormData(editTaskForm)

    $('.error-messages-edit').html('')
    $('.edit-success').html('')

    $.ajax({
        url: url,
        method: 'POST',
        type: 'PATCH',
        processData: false,
        contentType: false,
        data: form,
        success: function (response) {
            $('.edit-success').html(`
                        <div class="alert alert-success ">
                            ${response.success}
                        </div>
                    `)
            $(`#titleContent-${listId}`).html(`${response.data.title}`)
            $(`#descriptionContent-${listId}`).html(`${response.data.description}`)
            $(`#taskImg-${listId}`).attr('src', `${response.data.image.preview_url}`)
            $(`#taskImgLink-${listId}`).attr('href', `${response.data.image.url}`)
        },
        error: function (error) {
            if (error) {
                $(`#titleErrorEdit-${listId}`).html(error.responseJSON.errors.title)
                $(`#descriptionError-${listId}`).html(error.responseJSON.errors.description)
            }
        }
    })
}
export default editList;
