function getOrderDetails(order_ID) {
    const path = "index.php?path=admin/orderdetails/" + order_ID + "/ajax";
    let opened_elem = document.getElementById('order' + order_ID);
    if (opened_elem) {
        opened_elem.remove();
    } else {
        let old_elem = document.querySelector('.orderdetailsbox');
    if (old_elem) {
        old_elem.remove();
    }
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
                const box = document.createElement('div');
                      box.className='orderdetailsbox';
                      box.setAttribute('id', 'order' + order_ID);
                const goodsbox = document.createElement('ul'); // окно со списком заказов
                      goodsbox.className = 'orderdetails';
                const item_top = document.createElement('li'); // заголовок
                      item_top.className = 'orderdetails_item heading';
                const item_top_pos = document.createElement('p');
                      item_top_pos.innerText = "№";
                const item_top_title = document.createElement('p');
                      item_top_title.innerText = "Product";
                const item_top_price = document.createElement('p');
                      item_top_price.innerText = "Price";
                const item_top_quantity = document.createElement('p');
                      item_top_quantity.innerText = "Quantity";
                const item_top_amount = document.createElement('p');
                      item_top_amount.innerText = "Amount";
                      
                    item_top.appendChild(item_top_pos);
                    item_top.appendChild(item_top_title);
                    item_top.appendChild(item_top_price);
                    item_top.appendChild(item_top_quantity);
                    item_top.appendChild(item_top_amount);
                    goodsbox.appendChild(item_top);
    
                    let item_content, item_content_pos, item_content_title, item_content_price, item_content_quantity, item_content_amount;
                    let index = 1;
                    let total = 0;
    
                    data.forEach(str => {
                        total += Number(str.good_total);
                        item_content = document.createElement('li');
                        item_content.className = "orderdetails_item";
                        item_content_pos = document.createElement('p');
                        item_content_pos.innerText = index++;
                        item_content_title = document.createElement('p');
                        item_content_title.innerText = str.title;
                        item_content_price = document.createElement('p');
                        item_content_price.innerText = '$' + str.price;
                        item_content_quantity = document.createElement('p');
                        item_content_quantity.innerText = str.qty;
                        item_content_amount = document.createElement('p');
                        item_content_amount.innerText = '$' + str.good_total;
    
                        item_content.appendChild(item_content_pos);
                        item_content.appendChild(item_content_title);
                        item_content.appendChild(item_content_price);
                        item_content.appendChild(item_content_quantity);
                        item_content.appendChild(item_content_amount);
                        goodsbox.appendChild(item_content);
                    });
    
                    const item_total = document.createElement('li');
                          item_total.className = "orderdetails_item total";
                   
                    const item_total_value = document.createElement('p');
                          item_total_value.innerText = '$' + total.toFixed(2);
                          item_total.appendChild(document.createElement('p'));
                          item_total.appendChild(document.createElement('p'));
                          item_total.appendChild(document.createElement('p'));
                          item_total.appendChild(document.createElement('p'));
                          item_total.appendChild(item_total_value);
                          goodsbox.appendChild(item_total);
                          box.appendChild(goodsbox);
    
                    const buttonsbox = document.createElement('div');
                          buttonsbox.className = "buttonbox";                       
    
                    const button_processed = document.createElement('button');
                          button_processed.setAttribute('id', 'pr');
                          button_processed.innerText = 'Processed';
                          button_processed.setAttribute('onclick', 'set_processed(' + order_ID + ')');
    
                    const button_close = document.createElement('img');
                          button_close.className = 'orderdetais_close';
                          button_close.setAttribute('src', 'data/img/close_icon.svg');
                          button_close.setAttribute('onclick', 'closewindow(' + order_ID + ')');
                          buttonsbox.appendChild(button_close);
                          const status = document.getElementById('status' + order_ID).innerText;
                          if (status == 'new') {
                              const button_processed = document.createElement('button');
                              button_processed.setAttribute('id', 'pr');
                              button_processed.innerText = 'Completed';
                              button_processed.setAttribute('onclick', 'set_completed(' + order_ID + ')');
                              buttonsbox.appendChild(button_processed);
                          }
                          box.appendChild(buttonsbox);
    
                    const elem = document.getElementById('orderID_' + order_ID);
                          elem.after(box);
            })
            .catch(error => console.log("ERROR!!!!" + error));
    }
}

function closewindow(id) {
    let opened_elem = document.getElementById('order' + id);
    if (opened_elem) {
        opened_elem.remove();
    }
}

function set_completed(id) {
      const path = "index.php?path=admin/setcompleted/" + id + "/ajax";
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
               const status = data.status;
               if (status) {
                  const elem = document.getElementById('status'+id);
                  elem.innerText = "completed";
                  const btn = document.getElementById('pr');
                  btn.remove();
               } else {
                     console.log('ERROR!!!')
               }
            })
            .catch(error => console.log(error));
}

function get_new_orders() {
      let delay = 30 * 1000;
      setInterval(() => {
            const paramsString = document.location.search;
            let params = [];
            if (paramsString) {
                  const searchParams = new URLSearchParams(paramsString);
                  params = searchParams.get("path").split("/");
            } else {
                  params[0] = "catalog";
            }           
            if (params[0] == "admin") {
                 const elems = document.getElementsByClassName('orderlist');
                 const arr = [];
                 for (i=1; i<elems.length; i++) {
                      const id_str = elems[i].getAttribute('id');
                      const id_clear = id_str.split("_")[1];
                      arr.push(Number(id_clear));
                 }
                 const last_id = Math.max.apply(null, arr);
                 const path = "index.php?path=admin/getneworders/" + last_id + "/ajax";
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
                     if (data.orders != null) {
                         if ((params[1] == 'orders' && parseInt(params[2]) > 1) || params[1] != 'orders') {
                             const popup_window = document.querySelector('.popup_window');
                             popup_window.className = 'popup_window popup_window_show';
                         } else {
                             const fragment = document.createDocumentFragment();
                             data.orders.forEach(item => {
                                 const li = document.createElement('li');
                                 const str = document.createElement('div');
                                 str.className = 'orderlist';
                                 str.setAttribute('id', 'orderID_' + item.id);
                                 str.setAttribute('onclick', 'getOrderDetails('+item.id+')');
                                 const pos = document.createElement('p');
                                 pos.className = 'pos';
                                 const or_id = document.createElement('p');
                                 or_id.innerText = item.id;
                                 const user = document.createElement('p');
                                 user.className = 'ta_left';
                                 user.innerText = item.name;
                                 const dt = document.createElement('p');
                                 dt.innerText = item.date;
                                 const st = document.createElement('p');
                                 st.className = 'order_status';
                                 st.setAttribute('id', 'status' + item.id);
                                 st.innerText = item.status;
                                 str.appendChild(pos);
                                 str.appendChild(or_id);
                                 str.appendChild(user);
                                 str.appendChild(dt);
                                 str.appendChild(st);
                                 li.appendChild(str);
                                 fragment.appendChild(li);
                             });
                             const h_elem = document.getElementById('orderlist_header');
                             h_elem.after(fragment);
                             const markers = document.getElementsByClassName('pos');
                             for (i=1; i<markers.length; i++) {
                                 markers[i-1].innerText = i+'.';
                             }
                         }
                     }
                 })
                 .catch(error => console.log(error));
            }
      }, delay);
}

function switchhandler() {
      const switchBtn = document.getElementById('switch-btn');
      switchBtn.className = switchBtn.className == 'switch-btn' ? 'switch-btn switch-on' : 'switch-btn';
      const elems = document.querySelectorAll('.orderlist');
      let i = 1;
      if (switchBtn.className == 'switch-btn switch-on') {
            elems.forEach(item => {
                  const elem = item.querySelector('.order_status');
                  if(elem) {
                        if (elem.innerText == 'completed') {
                              item.style.display = 'none';
                        } else {
                              item.querySelector('.pos').innerText = i++ + '.';
                        }
                  }
            });
      } else {
            elems.forEach(item => {
                  if(item && item.className != 'orderlist orderlist_header') {
                        item.style.removeProperty('display');
                        item.querySelector('.pos').innerText = i++ + '.';
                  }
            });
      }
      
}