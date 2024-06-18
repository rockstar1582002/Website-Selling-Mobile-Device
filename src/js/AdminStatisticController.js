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


function getStatisticCondition() {
    let typeArray = getCheckboxChecked('categorystatistic');
    let brandArray = getCheckboxChecked('brandstatistic');
    let keyword = getKeyword('search-statistic');
    let start = getKeyword('date-from');
    let end = getKeyword('date-to');

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('footer-statistic').innerHTML = this.responseText;
            // alert(this.responseText);
        }
    }
    xhttp.open("POST", './src/php/api/api-statistic.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`typeArray=${JSON.stringify(typeArray)}&brandArray=${JSON.stringify(brandArray)}&keyword=${keyword}&start=${start}&end=${end}&`);

}