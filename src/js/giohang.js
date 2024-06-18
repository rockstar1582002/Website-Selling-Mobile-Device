
function checkall(source){
    checkboxes = document.getElementsByName('check[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
}
// Tính tổng giá trị sản phẩm đã chọn
function total(){
  $s = 0;
  checkboxes = document.getElementsByName('check[]');
  PriceProduct = document.getElementsByName('totalP[]');
  for (var i = 0, n=checkboxes.length; i<n;i++){
      const x = PriceProduct[i].value * 1;
      if(checkboxes[i].checked==true){
        $s = $s + x;
      }   
  }
  document.getElementById('totalPrice').innerHTML = $s.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});;
}
// Thay đổi số lượng của một sản phẩm
function add(idP){
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
          window.location.reload();
      }
  };
  xhttp.open("POST", "./src/php/api/api-quantityAdd.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("ProductID="+idP);
}
function subtract(idP){
  var xhttp; 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        window.location.reload();
      }
  };
  xhttp.open("POST", "./src/php/api/api-quantitySubtract.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("ProductID="+idP);
}
// Xóa sản phẩm
function deleteProduct(idP){
  if(confirm("Bạn có muốn xóa sản phẩm này không ?")){
    var xhttp; 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
          window.location.reload();
        }
    };
    xhttp.open("POST", "./src/php/api/api-delProdCart.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("ProductID="+idP);
  }
}
//send idP
function sendIdPAjax(idP){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {

    }
  };
  xhttp.open("POST", "./src/php/api/api-payment.php", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("ProductID="+idP);
}
// Mua hàng trong giỏ hàng
function buyInShoppingCart(){
  const xhttp = new XMLHttpRequest();
  var idP = '';
  checkboxes = document.getElementsByName('check[]');
  for (var i = 0, n=checkboxes.length; i<n;i++){
      if(checkboxes[i].checked==true){
        idP = idP +',' + checkboxes[i].value;
      }   
  }
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
      // alert(this.responseText);
    }
  };
  xhttp.open("POST", "./src/php/api/api-payment.php", false);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("ProductID="+idP);
  window.location.assign("thanhtoan.php");
  window.location.assign("thanhtoan.php");
}

// Thanh toán 
function xacnhan(){
  const xhttp = new XMLHttpRequest();
  var CustomerPhone = document.getElementById('TT__form-phone').value;
  var CustomerAddress = document.getElementById('TT__form-address').value;
  var CustomerName = document.getElementById('TT__form-name').value;
  // alert(CustomerPhone);
  var Customer = CustomerName+','+CustomerPhone+','+CustomerAddress;
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200) {
      // alert(this.responseText);
    }
  };
  xhttp.open("POST", "./src/php/api/api-changeAddress.php", false);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("Customer="+Customer);

  document.querySelector('.overlay').style.display = 'none';
  window.location.reload();
}
function thaydoi(){
  document.querySelector('.overlay').style.display = 'flex';
}
function thanhtoan(){
  if(confirm("Xác nhận thanh toán !")==true){
    const xhttp = new XMLHttpRequest(); 
   // alert (CustomerPhone);
    xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
      }
    };
    xhttp.open("POST", "./src/php/api/api-pay.php",false);
    xhttp.setRequestHeader("Content-type","application/x-wwwform-urlencoded");
    xhttp.send();
    window.location.reload();
    // window.location ="didongVN.php";
  }
}