var CHOSENLIST = [];
function getNameProduct() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('product-update').innerHTML = this.responseText;
        }
    }
    xhttp.open("POST", './src/php/api/api-render-name-product.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Auto render ID when chosen from  Select option

const selectNameProduct = document.querySelector('#product-update');
const idChosenProduct = document.querySelector('#id-chosen-item');
selectNameProduct.onchange = () => {
    const listNameProduct = document.querySelectorAll('option.item');
    const length = listNameProduct.length;
    for(let i = 0; i < length; i++) {
        if(listNameProduct[i].selected) {
            idChosenProduct.value = listNameProduct[i].value;
            break;
        }
    }
};

// Handle Add Button into the table

const qtyTextField = document.getElementById('qty-update');
function addChosenItem() {
    if(idChosenProduct.value == '') {
        // toast message
        alert('Please Choose a Product ID');
    } else if (qtyTextField.value == '' || qtyTextField.value <= 0){
        alert('Invalid Quantity');
    } else {
        const listNameProduct = document.querySelectorAll('option.item');
        const length = listNameProduct.length;
        
        for(let i = 0; i < length; i++) {
            if(listNameProduct[i].selected) {
                const flag = checkDuplicateItem(CHOSENLIST, 
                    listNameProduct[i].value, qtyTextField.value);
                if(flag == false) {
                    let tmpArr = listNameProduct[i].id.split('-');
                    let object = {
                        'id': listNameProduct[i].value,
                        'name': listNameProduct[i].innerHTML,
                        'category': tmpArr[0],
                        'brand': tmpArr[1],
                        'quantity': qtyTextField.value
                    }
                    CHOSENLIST.push(object);
                    displayChosenItemInTable(CHOSENLIST);
                    break;
                }
            }
        }
    }
}

function checkDuplicateItem(arrObject, id, quantity) {
    const length = arrObject.length;
    for(let i = 0; i < length; i++) {
        if(arrObject[i]['id'] === id) {
            arrObject[i]['quantity'] = parseInt(arrObject[i]['quantity']) + parseInt(quantity);
            displayChosenItemInTable(CHOSENLIST);
            return true;
        }
    }
    return false;
}


function displayChosenItemInTable(arrObj) {
    let html;
    html = arrObj.map((item) => {
        return `<tr class='text-center'>
                    <td>${item['id']}</td>
                    <td>${item['name']}</td>
                    <td>${item['category']}</td>
                    <td>${item['category']}</td>
                    <td>${item['quantity']}</td>
                    <td><i id='${item['id']}' class='uil uil-trash-alt text-center icon-trash' onclick='deleteItem(this);'></i></td>
                </tr>`;
    });
    document.getElementById('table-body-product-update-qty').innerHTML = html.join('');
}

function deleteItem(obj) {
    const length = CHOSENLIST.length;
    for(let i = 0; i < length; i++) {
        if(CHOSENLIST[i]['id'] === obj['id']) {
            if(confirm("Confirm Delete")==true) {
                CHOSENLIST.splice(i, 1);
                displayChosenItemInTable(CHOSENLIST);
                return true;
            }
        }
    }
    return false;
}

function confirmUpdate() {
    let idProductArr = [];
    let qtyArr = [];
    if(CHOSENLIST.length > 0) {
        CHOSENLIST.forEach((object) => {
            idProductArr.push(object['id']);
            qtyArr.push(object['quantity']);
        })
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert("Update Successfully");
                CHOSENLIST = [];
                location.reload();
            }
        }
        xhttp.open("POST", './src/php/api/api-update-quantity.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`idProductArr=${JSON.stringify(idProductArr)}&qtyArr=${JSON.stringify(qtyArr)}`);
    } else {
        alert("Empty List!");
    }
    
}