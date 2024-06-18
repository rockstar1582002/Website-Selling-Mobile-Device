class AjaxNoPaging {
    constructor(HTMLElementId, url, position) {
        this.HTMLElementId = HTMLElementId;
        this.url = url;
        this.position = position;
    }

    ajax() {
        let elementId = this.HTMLElementId;
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(elementId).innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", this.url + "?position=" + this.position, true);
        xhttp.send();
    }

}

class cardUIDashboard {
    constructor(cardName, cardColor, cardIcon, data) {
        this.cardName = cardName;
        this.cardColor = cardColor;
        this.cardIcon = cardIcon;
        this.data = data;
    }

    render() {
        return str = `<div class="col l-4 m-6 c-12">
                        <div class="${this.cardColor}">
                            <div>
                                <div class="number-customers">
                                    ${this.data};
                                </div>
                                <div>${this.cardName}</div>
                            </div>
                            <div><i class="${this.cardIcon}"></i></div>
                        </div>
                    </div>`;
    }
}

// Ajax get product with advance conditions
function getHTML(url, page = 1, typeArray, brandArray , keyword) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('table-body-product').innerHTML = this.responseText;
            // alert(this.responseText);
        }
    }
    xhttp.open("POST", url, true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   

    xhttp.send(`page=${page}&typeArray=${JSON.stringify(typeArray)}
    &brandArray=${JSON.stringify(brandArray)}&keyword=${keyword}`);
}


// Handle button page number at footer (handle by quantity is return by advanced conditions)
function pageBtnsBuilder(total, typeArray, brandArray, keyword) {
    // typeArray = ['Phone', 'Tablet'];
    let pages = Math.ceil(total / 10);
    let html = '';
    for (let i = 1; i <= pages; i++) {
        html += `<div class="page-number" onclick="getHTML('./src/php/api/api-prod.php', ${i}, '${typeArray}', '${brandArray}', '${keyword}')">${i}</div>`;
    }
    document.getElementById('footer-product').innerHTML = html;
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
function getConditions() {
    let typeArray = getCheckboxChecked('categoryproduct');
    let brandArray = getCheckboxChecked('brandproduct');
    let keyword = getKeyword('search-product-1');
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            pageBtnsBuilder(this.responseText, (typeArray),
            (brandArray), keyword);
            getHTML('./src/php/api/api-prod.php', 1, typeArray.toString(), brandArray.toString(), keyword);
        }
    }
    xhttp.open("POST", './src/php/api/api-quantity-condition.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`typeArray=${JSON.stringify(typeArray)}&brandArray=${JSON.stringify(brandArray)}&keyword=${keyword}`);
}

// Code order
function getOrderHTML(page, currState, keyword) {
    const bodyTableOrderArr = ['all-orders', 'processing-orders', 'processed-orders', 'canceled-orders'];
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById( bodyTableOrderArr[currState]).innerHTML = this.responseText;
            // alert(this.responseText);
        }
    }
    xhttp.open("POST", './src/php/api/api-order.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   
    xhttp.send(`page=${page}&currState=${currState}&keyword=${keyword}`);
}

function pageBtnsBuilderOrder(total, currState=0, keyword='') {
    let pages = Math.ceil(total / 10);
    let html = '';
    for (let i = 1; i <= pages; i++) {
        html += `<div class="page-number" onclick="getOrderHTML(${i}, '${currState}', '${keyword}')">${i}</div>`;
    }
    const footerOrderArray = ['footer-all-order', 'footer-processing-order', 'footer-processed-order', 'footer-canceled-order'];
    document.getElementById(footerOrderArray[currState]).innerHTML = html;
}

function getOrderCondition(currState = 0) {
    let keyword = getKeyword('search-order');
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            pageBtnsBuilderOrder(this.responseText, currState, keyword);
            getOrderHTML(1, currState, keyword);
        }
    }
    xhttp.open("POST", './src/php/api/api-quantity-order.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`currState=${currState}&keyword=${keyword}`);
}

// Code Delete product
function deleteProduct(id) {
    let text = "Are you sure to delete this product?\nYou can not recovery this action"
    if(confirm(text) == true) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText == 1) {
                    alert("Delete Successfully");
                    getConditions();
                } else if(this.responseText == 0) {
                    alert("You can not delete this product because it has been bought");
                }

            }
        }
        xhttp.open("POST", './src/php/api/api-delete-product.php', true)
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`idProduct=${id}`);
    }
    
}

// Code add new product
/**
* get all of types and display select-option format
* @param
* @return
*/
function getAllTypes() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('frm-select-type').innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", './src/php/api/api-type-newproduct.php', true);
    xhttp.send();
}

/** 
 * get all of types and display select-option format
 * @param
 * @return
*/
function getHtmlBrandByType(object) {
    const typeId = object.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById('frm-select-brand').innerHTML = this.responseText;
            // alert(this.responseText);
        }
    }
    xhttp.open("POST", './src/php/api/api-get-brand-by-type.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`typeId=${typeId}&status=${1}`);
}




// Customer
function checkall(source){
    checkboxes = document.getElementsByName('check[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
}
const searchFun = () =>{
    let filter = document.getElementById('search-customer').value.toUpperCase();
    filter = filter.trimEnd();
    let table = document.getElementById('table-customer');
    let tr = table.getElementsByTagName('tr');
    for (var i=0 ; i < tr.length; i++){
        let td = tr[i].getElementsByTagName('td')[3];
        if(td){
            let textvalue = td.textContent || td.innerHTML ;
            if  (textvalue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else {
                tr[i].style.display = "none";
            }
  
        }
    }
  }
  //Xóa một khách hàng
  function delCustomer(id){ 
    // if(confirm("Xác nhận!")==true){
        var xhttp; 
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
            }
        };
        xhttp.open("POST", "./src/php/api/api-customer.php", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("CustomerID="+id);
        window.location.reload();
    // }
  }
  //Xóa theo checkbox
  function DelAllCus(){
    if(confirm("Xác nhận!")==true){
        checkboxes = document.getElementsByName('check[]');
        for (var i = 0, n=checkboxes.length; i<n;i++){
            if(checkboxes[i].checked==true){
                delCustomer(checkboxes[i].value);   
            }
        }
    }
  }
  //Thay đổi trạng thái khách hàng
  function changestateCustomer(id){
    if(confirm("Xác nhận!")==true){
        var xhttp; 
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                    window.location.reload();
            }
        };
        xhttp.open("POST", "./src/php/api/api-changestateCus.php", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("CustomerID="+id);

    }
  }
  function BlockCustomer(id){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
                window.load = function(){
                    
                }
        }
    };
    xhttp.open("POST", "./src/php/api/api-blockcustomer.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("CustomerID="+id);
  }
  function UnblockCustomer(id){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
                window.load = function(){
                    
                }
        }
    };
    xhttp.open("POST", "./src/php/api/api-unblockcustomer.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("CustomerID="+id);
  }
  function BlockCheckbox(){
    if(confirm("Xác nhận!")==true){
        checkboxes = document.getElementsByName('check[]');
        for (var i = 0, n=checkboxes.length; i<n;i++){
            if(checkboxes[i].checked==true){
                BlockCustomer(checkboxes[i].value);   
            }
        }
    }
  }
  function UnblockCheckbox(){
    if(confirm("Xác nhận!")==true){
        checkboxes = document.getElementsByName('check[]');
        for (var i = 0, n=checkboxes.length; i<n;i++){
            if(checkboxes[i].checked==true){
                UnblockCustomer(checkboxes[i].value);   
            }
        }
    }
  }
  function changestateCus_checkbox(){
    alert('clicked');
    checkboxes = document.getElementsByName('check[]');
    for (var i = 0, n=checkboxes.length; i<n;i++){
        if(checkboxes[i].checked==true){
            changestateCustomer(checkboxes[i].value);   
        }
    }
  }
//End customer



// Load page
let categoryStatistic = new AjaxNoPaging('filter-category-statistic', './src/php/api/api-category.php', 'statistic');
let brandStatistic = new AjaxNoPaging('filter-brand-statistic', './src/php/api/api-brand.php', 'statistic');
let categoryProd = new AjaxNoPaging('filter-category-prod', './src/php/api/api-category.php', 'product');
let brandProd = new AjaxNoPaging('filter-brand-prod', './src/php/api/api-brand.php', 'product');
let categoryEditQuan = new AjaxNoPaging('filter-category-edit-quan', './src/php/api/api-category.php', 'editQuan');
let brandEditQuan = new AjaxNoPaging('filter-brand-edit-quan', './src/php/api/api-brand.php', 'editQuan');
categoryStatistic.ajax();
brandStatistic.ajax();
categoryProd.ajax();
brandProd.ajax();
categoryEditQuan.ajax();
brandEditQuan.ajax();

getAllTypes();