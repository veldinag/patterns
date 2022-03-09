const goodsloadhandler = (part) => {
    const path = "index.php?path=catalog/show/" + part + "/ajax";

    fetch(path, {
        method: "GET",
        headers: {"content-type": "application/x-www-form-urlencoded"}
    })
    .then(response => {
        if (response.status !== 200) {
            return Promise.reject();
        }
        return response.json();
    })
    .then(data => {
        if (data.nextPart == 0) {
            showBtn = document.getElementById('showBtn');
            showBtn.remove();
        }
        goodsBox = document.createDocumentFragment();
        data.goods.forEach(item => {
            //---------
            let catalogCardTopHoverImg = document.createElement("img");
            catalogCardTopHoverImg.className = "catalog_card_top_hover_img";
            catalogCardTopHoverImg.setAttribute("src","data/img/cart_icon.svg");
            catalogCardTopHoverImg.setAttribute("alt", "cart_icon");
            //--------
            let catalogCardTopHoverText = document.createElement("p");
            catalogCardTopHoverText.className = "catalog_card_top_hover_text";
            catalogCardTopHoverText.innerText = "Add to Cart";
            //--------
            let catalogCardTopHoverBtn = document.createElement("a");
            catalogCardTopHoverBtn.className = "catalog_card_top_hover_btn";
            catalogCardTopHoverBtn.setAttribute("onclick", "carthandler(" + item.id + ", 'add')");
            //--------
            catalogCardTopHoverBtn.appendChild(catalogCardTopHoverImg);
            catalogCardTopHoverBtn.appendChild(catalogCardTopHoverText);
            //--------
            let catalogCardTopHover = document.createElement("div");
            catalogCardTopHover.className = "catalog_card_top_hover";
            catalogCardTopHover.appendChild(catalogCardTopHoverBtn);
            //--------
            let catalogCardImg = document.createElement("img");
            catalogCardImg.className = "catalog_card_img";
            catalogCardImg.setAttribute("src", "data/img/catalog/"+item.img);
            catalogCardImg.setAttribute("alt", "img");
            //--------
            let catalogCardTop = document.createElement("div");
            catalogCardTop.className = "catalog_card_top";
            catalogCardTop.appendChild(catalogCardTopHover);
            catalogCardTop.appendChild(catalogCardImg);
            //--------
            let catalogCardHeading = document.createElement("h3");
            catalogCardHeading.className = "catalog_card_heading";
            catalogCardHeading.innerText = item.title;
            //--------
            let catalogCardInfoLink = document.createElement("a");
            catalogCardInfoLink.setAttribute("href", "index.php?path=Product/show/" + item.id);
            catalogCardInfoLink.appendChild(catalogCardHeading);
            //--------
            let catalogCardText = document.createElement("p");
            catalogCardText.className = "text catalog_card_text";
            catalogCardText.innerText = item.short_desc;
            //--------
            let catalogCardPrice = document.createElement("p");
            catalogCardPrice.className = "catalog_card_price";
            catalogCardPrice.innerText = "$"+item.price;
            //--------
            let catalogCardInfo = document.createElement("div");
            catalogCardInfo.className = "catalog_card_info";
            catalogCardInfo.appendChild(catalogCardInfoLink);
            catalogCardInfo.appendChild(catalogCardText);
            catalogCardInfo.appendChild(catalogCardPrice);
            //--------
            let  catalogCard = document.createElement("div");
            catalogCard.className = "catalog_card";
            catalogCard.setAttribute('id', 'good_' + item.id);
            catalogCard.appendChild(catalogCardTop);
            catalogCard.appendChild(catalogCardInfo);
            //--------
            goodsBox.appendChild(catalogCard);
        });
        catalogMain = document.getElementById("catalog_main");
        catalogMain.append(goodsBox);
        showBtn = document.getElementById('showBtn');
        if (showBtn) {
            showBtn.setAttribute("onclick", "goodsloadhandler("+data.nextPart+")");
        }
    })
    .catch((error) => console.log("ERROR: " + error));
}