function editList(listId, url) {
    const editListForm = $(`#editListForm-${listId}`)[0]

    let form = new FormData(editListForm)
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
        },
        error: function (error) {
            if (error) {
                console.log(error)
                $(`#titleErrorEdit-${listId}`).html(error.responseJSON.errors.title)
                $(`#descriptionError-${listId}`).html(error.responseJSON.errors.description)
            }
        }
    })
}
export default editList;
