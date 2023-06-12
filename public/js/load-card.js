function displayData(data, cardIdReplace = null) {
    const cardContent = `
        <div class="card m-1 card-item" id="card-${data.id}" data-id="${data.id}">
            <div class="card-body">
                <h5 class="card-title">${data.title}</h5>
                <p class="card-text">${data.description}</p>
                <p class="card-text"><small class="text-muted">The last task was <span class="text-danger-emphasis">3 mins ago</span></small></p>
                <i class="bi link bi-pencil-fill text-primary m-1" type="button"></i>
                <a class="btn-delete-post" data-route="main/destroy/${data.id}" data-id="${data.id}">
                    <i class="bi link bi-trash-fill text-danger m-1" id="delete-list"></i>
                </a>
            </div>
        </div>
        `

    if (cardIdReplace) {
        $(`#card-${cardIdReplace}`).replaceWith(cardContent)
    } else {
        $('.card-deck').append(cardContent)
    }
}
