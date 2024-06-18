function getProductHTML(type = 0,idhtml = 0){
    const idhtmlArray = ['telephone_product','laptop_product','tablet_product','sound_product'];
    
    const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(idhtmlArray[idhtml]).innerHTML = this.responseText;
            }
        }
        xhttp.open("GET",'./src/php/api/api-product.php' + "?type=" + type, true);
        xhttp.send();
}
// function getDetailHTML(){
//     let id = 0,type = 0,tradeamrk = 0;
//     const xhttp = new XMLHttpRequest();
//         xhttp.onreadystatechange = function (){
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("content").innerHTML = this.responseText;
//             }
//         }
//         xhttp.open("GET",'./src/php/api/api-productDetail.php' + "?id=" + id + "?type=" + type + "?trademark=" + tradeamrk, true);
//         xhttp.send();
// }
// function getProductType(type = 0){
    
//     const xhttp = new XMLHttpRequest();
//         xhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("Product").innerHTML = this.responseText;
//             }
//         }
//         xhttp.open("GET",'./src/php/api/api-productType.php' + "?classify=" + type, true);
//         xhttp.send();
// }

// Thêm sản phẩm vào giỏ hàng   
function addCart(idP){
    // alert(idP);
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            alert("Đã thêm!");
        }
    };
    xhttp.open("POST", "./src/php/api/api-addcart.php", false);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("ProductID="+idP);
}
// Mua ngay
function buynow(idP){
    const xhttp = new  XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("POST", "./src/php/api/api-buynow.php", false);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("ProductID="+idP);
    window.location.assign("thanhtoan.php");
    // window.location.assign("thanhtoan.php");
}
//Gio hang 
function showCart(){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };
    xhttp.open("POST", "./src/php/api/api-shoppingcart.php", false);
    xhttp.send();
}

//Print brand by category in product page
function getBrandForProductPage(category = 0){
    const categoryArray = ['', 'Phone','Laptop','Tablet','Phukien'];
    const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("filter__brand").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET",'./src/php/api/api-brand-checkbox-product.php' + "?category=" + categoryArray[category], true);
        xhttp.send();
}




// Filter and Paging for Product Page

function getHTML(url, page = 1, typeArray, brandArray , keyword, from, to) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('Product').innerHTML = this.responseText;
        }
    }
    xhttp.open("POST", url, true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   

    xhttp.send(`page=${page}&typeArray=${JSON.stringify(typeArray)}
    &brandArray=${JSON.stringify(brandArray)}&keyword=${keyword}&from=${from}&to=${to}`);
}


// Handle button page number at footer (handle by quantity is return by advanced conditions)
function pageBtnsBuilder(total, typeArray, brandArray, keyword, from, to) {
    let pages = Math.ceil(total / 12);
    let html = '';
    for (let i = 1; i <= pages; i++) {
        html += `<div class="page-number" onclick="getHTML('./src/php/api/api-render-productpage.php', ${i}, '${typeArray}', '${brandArray}', '${keyword}', '${from}', '${to}')">${i}</div>`;
    }
    document.getElementById('number_page_product').innerHTML = html;
}

/**
 * Check checkbox is checked or unchecked
 * @param className class attribute of html element
 * @return array of checked checkboxes
 */
function getCheckboxChecked(className) {
    var typeIdCheckedArr = [];
    var checkboxList = document.querySelectorAll('.'+className);
    const length = checkboxList.length;
    for(let i = 0; i < length; i++) {
        if(checkboxList[i].checked) {
            typeIdCheckedArr.push(checkboxList[i].value);
        }
    }
    return typeIdCheckedArr;
}

function getKeyword(className) {
    return document.querySelector('.'+className).value;
}


/**
 * get all of conditions (keywords, array type, array brand) return quantity of products
 * handle button by just returned quantity
*/
function getConditions(category = 0) {
    const categoryArray = ['', 'Phone','Laptop','Tablet','Phukien'];

    let typeArray = [categoryArray[category]];
    let brandArray = getCheckboxChecked('brand_productpage');
    let keyword = getKeyword('search-product-user');

    let from = getKeyword('input-min')*1000;
    let to = getKeyword('input-max')*1000;

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            pageBtnsBuilder(this.responseText, (typeArray),
            (brandArray), keyword, from, to);
            getHTML('./src/php/api/api-render-productpage.php', 1, typeArray.toString(), brandArray.toString(), keyword, from, to);
        }
    }
    xhttp.open("POST", './src/php/api/api-qtycondition-productpage.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`typeArray=${JSON.stringify(typeArray)}
    &brandArray=${JSON.stringify(brandArray)}&keyword=${keyword}&from=${from}&to=${to}`);
}
