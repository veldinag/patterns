const carthandler = (good_id, action) => {
    const path = "index.php?path=cart/" + action + "/" + good_id + "/ajax";

    fetch(path, {
        method: "GET",
        headers:{"content-type": "application/x-www-form-urlencoded"}
    })
        .then(response => {
            if (response.status !== 200) {
                return Promise.reject();
            }
            return response.json();
        })
        .then(data => {
            //console.log(data);
            const status = Number(data.status);
            const row_items = Number(data.row_items);
            const quantity = Number(data.quantity);
            const total = Number(data.total).toFixed(2);
            let out = {};
            switch(status) {
                case 1:
                    out = {
                        'is_cart_cleared': true,
                        'row_items': 0,
                        'total': 0
                    }
                    return out;
                case 2:
                    out = {
                        'is_good_deleted': true,
                        'row_items': row_items,
                        'total': total
                    }
                    return out;
                case 3:
                    out = {
                        'row_items': row_items,
                        'quantity': quantity,
                        'total': total
                    }
                    return out;
                case 4:
                    out = {
                        'row_items': row_items,
                        'quantity': quantity,
                        'total': total
                    }
                    return out;
                case 5:
                    out = {
                        'is_db_error': true
                    }
                    return out;
                case 6:
                    out = {
                        'is_not_auth': true
                    }
                    return out;
            }
        })
        .then(inp => {
            if (inp.is_cart_cleared) {
                let el = document.getElementById('shCart');
                el.parentNode.removeChild(el);
                el = document.getElementById('status_str');
                el.innerHTML = "Shopping cart is empty. <a href='index.php'>Go shopping!</a>";
            }
            if (inp.is_good_deleted) {
                if (inp.row_items === 0) {
                    let el = document.getElementById('shCart');
                    el.parentNode.removeChild(el);
                    el = document.getElementById('status_str');
                    el.innerHTML = "Shopping cart is empty. <a href='index.php'>Go shopping!</a>";
                } else {
                    let el = document.getElementById('good_' + good_id);
                    el.innerText = "";
                }
            }
            if (inp.row_items > 0) {
                let el = document.getElementById('row_items');
                el.innerText = inp.row_items;
                el.className = "navbar_right_item_incart";
            } else {
                let el = document.getElementById('row_items');
                el.className = "navbar_right_item_incart dont_show";
            }
            if (inp.quantity > 0) {
                let el = document.getElementById('q_' + good_id);
                if (el) {
                    el.innerText = inp.quantity;
                }
            }
            if (inp.total > 0) {
                let sub_total = document.getElementById('sub_total');
                let grand_total = document.getElementById('grand_total');
                if (sub_total) {
                    sub_total.innerHTML = "Sub total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$" + inp.total;
                }
                if (grand_total) {
                    grand_total.innerHTML = "Grand total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>$" + inp.total + "</span>";
                }
            }
            if (inp.is_db_error) {
                return Promise.reject();
            }
            if (inp.is_not_auth) {
                window.location.href = 'index.php?path=user/login/4';
            }
        })
        .catch((error) => console.log(error));
}
