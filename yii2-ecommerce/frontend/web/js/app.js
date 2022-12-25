//增加商品到购物车操作
const add_to_card_buttons = [...document.querySelectorAll('.add-to-card')]

add_to_card_buttons.forEach((add_to_card_dom) => {
    add_to_card_dom.addEventListener('click', (e) => {
        const id = e.target.dataset.key;
        $.post("/cart/create", { id },function(data) {
            const cart_count = document.querySelector('.cart-count')
            cart_count.innerHTML = data.cartItemCount
        });
    })
})


//在购物车中 增加或减少 商品数量
let quantity_operate_doms = document.querySelectorAll('.quantity_operate');
quantity_operate_doms = [...quantity_operate_doms]

let total_price_doms = document.querySelectorAll('.total_price')
total_price_doms = [...total_price_doms]

total_price_mapping = {}
total_price_doms.forEach((total_price) => {
    total_price_mapping[total_price.dataset.key] = total_price
})


quantity_operate_doms.forEach((quantity_operate) =>
{
    const children = [...quantity_operate.children]
    let quantity_count_node = children[1]
    let id = quantity_operate.dataset.key

    children.forEach((child) =>
    {
        //点击的是 “减” 按钮
        if((child.className).indexOf('subtract') !== -1 )
        {
            child.addEventListener('click', () => {
                let quantity_count = parseInt(quantity_count_node.innerHTML)
                if(quantity_count > 1) {
                    $.post("/cart/update",
                        {
                            id,
                            "quantity_count": quantity_count - 1
                        },
                        function(data) {
                            quantity_count_node.innerHTML = data.quantity_count;
                            total_price_mapping[id].innerHTML = '¥' + data.total_price
                        }
                    );
                }
            })
        }

        //点击的是 “加” 按钮
        if((child.className).indexOf('append') !== -1 )
        {
            child.addEventListener('click', () => {
                let quantity_count = parseInt(quantity_count_node.innerHTML)
                $.post("/cart/update",
                    {
                        id,
                        "quantity_count": quantity_count + 1
                    },
                    function(data) {
                        quantity_count_node.innerHTML = data.quantity_count;
                        total_price_mapping[id].innerHTML = '¥' + data.total_price
                    }
                );
            })
        }
    })
})

