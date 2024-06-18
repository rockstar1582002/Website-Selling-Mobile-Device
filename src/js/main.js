// Toggle active sidebar-nav for admin
const sidebarBtns = document.querySelectorAll('.sidebar-menu div');
// Show block-content
const contentBlocks = document.querySelectorAll('.block-content');

sidebarBtns.forEach(function (sidebarBtn, i) {
    sidebarBtn.onclick = function () {
        sidebarBtns.forEach(function (btn) {
            btn.classList.remove('active');
        });
        sidebarBtn.classList.add('active');

        contentBlocks.forEach((b) => {
            b.setAttribute('style', 'display:none;');
        });

        contentBlocks[i].setAttribute('style', 'display:block;');
    }
});

// Show/hide classify radio box
const dropDownBtns = document.querySelectorAll('.title-col');
const dropDownList = document.querySelectorAll('.checkbox-list');
const angleBtns = document.querySelectorAll('i.uil-angle-up');

dropDownBtns.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        if (dropDownList[index].getAttribute('style') == 'display:block') {
            dropDownList[index].setAttribute('style', 'display:none');
            angleBtns[index].className = 'uil uil-angle-up';
        } else {
            dropDownList[index].setAttribute('style', 'display:block');
            angleBtns[index].className = 'uil uil-angle-down';
        }
    });
});

// Choose type of orders
const typeBtns = document.querySelectorAll('.type-order');
const orderTables = document.querySelectorAll('.table-order');

typeBtns.forEach((typeBtn, i) => {
    typeBtn.onclick = () => {
        typeBtns.forEach((btn) => {
            btn.classList.remove('active');
        });
        typeBtn.classList.add('active');

        orderTables.forEach((box) => {
            box.setAttribute('style', 'display:none;');
        });
        orderTables[i].setAttribute('style', 'display:block;');
    }
});

// Choose top btns top on product page
const productBtns = document.querySelectorAll('.btn-product');
const productContainers = document.querySelectorAll('.product-container');
productBtns.forEach((productBtn, i) => {
    productBtn.addEventListener('click', () => {
        productBtns.forEach((btn) => {
            btn.classList.remove('active');
        });
        productBtn.classList.add('active');

        // Show / hide main content product
        productContainers.forEach((box) => {
            box.setAttribute('style', 'display:none;');
        });
        productContainers[i].setAttribute('style', 'display:block;');
    });
});


// Display form information by product category
const titleInfo = [
    {
        title1: ["Thông số camera trước", "camTrc"],
        title2: ["Thông số Camera sau", "camSau"],
        title3: ["Kích thước màn hình", "ktmh"],
        title4: ["Thông số bộ nhớ", "storage"],
        title5: ["Dung lượng Ram", "ram"],
        title6: ["Thông số pin", "pin"],
        title7: ["Loại hệ điều hành", "os"],
        title8: ["Loại Chip", "cpu"],
        title9: ["Thông số trọng lượng", "weight"],
        title10: ["Thông số kích thước", "size"]
    },
    {
        title1: ["Thông số ổ cứng", "disk"],
        title2: ["Loại card đồ họa", "gc"],
        title3: ["Loại CPU", "cpu"],
        title4: ["Loại hệ điều hành", "os"],
        title5: ["Dung lượng Ram", "ram"],
        title6: ["Công nghệ màn hình", "cnmh"],
        title7: ["Thông số trọng lượng", "weight"],
        title8: ["Thông số kích thước", "size"]
    },
    {
        title1: ["Công suất", "congsuat"],
        title2: ["Đầu ra", "daura"],
        title3: ["Đầu vào", "dauvao"],
        title4: ["Hãng", "hang"]
    }
];
function displayForm(obj) {
    let category = obj.value;
    let html = '';
    if(category == 'Phone' || category == 'Tablet') {
        for(var key in titleInfo[0]) {
            html += `<div class="col l-8 l-o-2">
                        <label for="">${titleInfo[0][key][0]}</label><br>
                        <input name="${titleInfo[0][key][1]}" type="text" id=""><br>
                    </div>`;
        }
    } else if(category == 'Laptop') {
        for(var key in titleInfo[1]) {
            html += `<div class="col l-8 l-o-2">
                        <label for="">${titleInfo[1][key][0]}</label><br>
                        <input name="${titleInfo[1][key][1]}" type="text" id=""><br>
                    </div>`;
        }
    } else if(category == 'Phukien'){
        for(var key in titleInfo[2]) {
            html += `<div class="col l-8 l-o-2">
                        <label for="">${titleInfo[2][key][0]}</label><br>
                        <input name="${titleInfo[2][key][1]}" type="text" id=""><br>
                    </div>`;
        }
    }
    document.getElementById('product-description').innerHTML = html;
}

