// const titleInfo = [
//   {
//     title1: ["Thông số camera trước", "camTrc"],
//     title2: ["Thông số Camera sau", "camSau"],
//     title3: ["Kích thước màn hình", "ktmh"],
//     title4: ["Thông số bộ nhớ", "storage"],
//     title5: ["Dung lượng Ram", "ram"],
//     title6: ["Thông số pin", "pin"],
//     title7: ["Loại hệ điều hành", "os"],
//     title8: ["Loại Chip", "cpu"],
//     title9: ["Thông số trọng lượng", "weight"],
//     title10: ["Thông số kích thước", "size"]
//   },
//   {
//     title1: ["Thông số ổ cứng", "disk"],
//     title2: ["Loại card đồ họa", "gc"],
//     title3: ["Loại CPU", "cpu"],
//     title4: ["Loại hệ điều hành", "os"],
//     title5: ["Dung lượng Ram", "ram"],
//     title6: ["Công nghệ màn hình", "cnmh"],
//     title7: ["Thông số trọng lượng", "weight"],
//     title8: ["Thông số kích thước", "size"]
//   },
//   {
//     title1: ["Công suất", "congsuat"],
//     title2: ["Đầu ra", "daura"],
//     title3: ["Đầu vào", "dauvao"],
//     title4: ["Hãng", "hang"]
//   }
// ];
// Model box
// Get the modal
var modal = document.getElementById("product-detail-modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close_modal")[1];

// When the user clicks the button, open the modal
function editProduct(id, typeId) {
  modal.style.display = "block";
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const object = JSON.parse(this.responseText);
      document.getElementById('product-detail-top').innerHTML = object[0];
      console.log(JSON.parse(this.responseText));
      let html = '';
      let objectInfo2 = JSON.parse(object[1]);
      var i = 0;
      if (typeId == 'Phone' || typeId == 'Tablet') {
        for (var key in titleInfo[0]) {
          html += `<div class="mt-8">
                            <label for="">${titleInfo[0][key][0]}</label><br>
                            <input value="${objectInfo2[i++]}" name="${titleInfo[0][key][1]}" type="text" id=""><br>
                        </div>`;
        }
      } else if (typeId == 'Laptop') {
        for (var key in titleInfo[1]) {
          html += `<div class="mt-8">
                            <label for="">${titleInfo[1][key][0]}</label><br>
                            <input value="${objectInfo2[i++]}" name="${titleInfo[1][key][1]}" type="text" id=""><br>
                        </div>`;
        }
      } else if (typeId == 'Phukien') {
        for (var key in titleInfo[2]) {
          html += `<div class="mt-8">
                            <label for="">${titleInfo[2][key][0]}</label><br>
                            <input  value="${objectInfo2[i++]}" name="${titleInfo[2][key][1]}" type="text" id=""><br>
                        </div>`;
        }
      }
      document.getElementById('product-detail-bottom').innerHTML = html;

    }
  }
  xhttp.open("POST", './src/php/api/api-get-product-detail.php', true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`productId=${id}&typeId=${typeId}`);
}



// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
