const edit_phone = document.querySelector('.c__item-edit-phone')
const edit_birthday = document.querySelector('.c__item-edit-birthday')
const edit_close = document.querySelector('.c__edit-close')
const customer = document.querySelector('.c__content-infor')

function openCustomer(){
    customer.style.display = 'block';
    document.querySelector('.c__content-history').style.display = 'none';
    document.querySelector('.c__content-home').style.display = 'none';
    document.querySelector('.c__content-support').style.display = 'none';
    document.querySelector('.c__content-changepass').style.display = 'none';
}
function openHome(){
    customer.style.display = 'none';
    document.querySelector('.c__content-history').style.display = 'none';
    document.querySelector('.c__content-home').style.display = 'block';
    document.querySelector('.c__content-support').style.display = 'none';
    document.querySelector('.c__content-changepass').style.display = 'none';

}
function openHistory(){
    customer.style.display = 'none';
    document.querySelector('.c__content-history').style.display = 'block';
    document.querySelector('.c__content-home').style.display = 'none';
    document.querySelector('.c__content-support').style.display = 'none';
    document.querySelector('.c__content-changepass').style.display = 'none';
}
function openSupport(){
    customer.style.display = 'none';
    document.querySelector('.c__content-history').style.display = 'none';
    document.querySelector('.c__content-home').style.display = 'none';
    document.querySelector('.c__content-support').style.display = 'block';
    document.querySelector('.c__content-changepass').style.display = 'none';
}
function openChangePass(){
    customer.style.display = 'none';
    document.querySelector('.c__content-history').style.display = 'none';
    document.querySelector('.c__content-home').style.display = 'none';
    document.querySelector('.c__content-support').style.display = 'none';
    document.querySelector('.c__content-changepass').style.display = 'block';
}
function openEdit(){
    document.querySelector('.overlay').style.display = 'flex';
    // window.location.reload();
}
function openUpload(){
    document.querySelector('.overlayUpload').style.display = 'flex';
}
function closeEdit(){
    document.querySelector('.overlay').style.display = 'none';
    document.querySelector('.overlayUpload').style.display = 'none';
    // window.location.reload();
    window.location.assign("khachhang.php");
}
function submit(){
    var name = document.getElementById('e__content-name').value;
    var dob = document.getElementById('e__content-dob').value;
    var phone = document.getElementById('e__content-phone').value;
    var email = document.getElementById('e__content-email').value;
    var str = name+','+dob+','+phone+','+email;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    xhttp.open("POST", "./src/php/api/api-editProfile.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("String="+str);
    window.location.reload();
}
function submitChangePass(){
    var oldPass = document.getElementById('old_pass').value;
    var newPass = document.getElementById('new_pass').value;
    var renewPass = document.getElementById('re_new_pass').value;
    var strpass = oldPass+','+renewPass;
    if(newPass != renewPass){
        alert("Mật khẩu không giống nhau ! Mời nhập lại !");
    }else{
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        xhttp.open("POST", "./src/php/api/api-changePass.php", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("Password="+strpass);
    }
}
function cancelOrder(id){
    if(confirm("Bạn có chắc chắn hủy đơn hàng này không ?")==true){
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "./src/php/api/api-cancelorder.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("IdOrder="+id);
    window.location.reload();
    }
}
function openDetailOrder(id){
    document.querySelector('.modal_wrapper').style.display = 'flex';
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById('table-body-order-detail').innerHTML = this.responseText;
        }
    }
    xhttp.open("POST", './src/php/api/api-renderOrD-profile.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`productId=${id}`);
}
function closeOrderDetail(){
    document.querySelector('.modal_wrapper').style.display = 'none';
}
window.onload = function(){
    openCustomer();
}