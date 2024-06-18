function confirmOrder(id) {
    if (confirm("Confirm Order")) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert('Confirm order');
                getOrderCondition();
                getOrderCondition(1);
                getOrderCondition(2);
                getOrderCondition(3);
            }
        }
        xhttp.open("POST", './src/php/api/api-confirm-order.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`productId=${id}`);
    }

}

function cancelOrder(id) {

    if (confirm("Cancel Order")) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert('Cancel order');
                getOrderCondition();
                getOrderCondition(1);
                getOrderCondition(2);
                getOrderCondition(3);
            }
        }
        xhttp.open("POST", './src/php/api/api-cancel-order.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`productId=${id}`);
    }

}

// Model box
// Get the modal
var modal = document.getElementById("order-detail-modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close_modal")[0];

// When the user clicks the button, open the modal
function openDetailOrder(id) {
    modal.style.display = "block";
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById('table-body-order-detail').innerHTML = this.responseText;
        }
    }
    xhttp.open("POST", './src/php/api/api-render-order-detail.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`productId=${id}`);
}

function openInfoOrder(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const object = JSON.parse(this.responseText);
            document.getElementById('top-content-ord-detail').innerHTML = object[0];
            document.getElementById('bottom-content-ord-detail').innerHTML = object[1];
        }
    }
    xhttp.open("POST", './src/php/api/api-get-info-order-detail.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`productId=${id}`);
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