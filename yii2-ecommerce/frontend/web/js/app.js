const add_to_card_buttons = [...document.querySelectorAll('.add-to-card')]
add_to_card_buttons.forEach((add_to_card_dom) => {
    add_to_card_dom.addEventListener('click', (e) => {
        const id = e.target.dataset.key;
        $.post("/cart/create", { id },function(data) {
            console.log(data)
        });
    })
})
