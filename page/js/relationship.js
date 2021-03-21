document.getElementById('select_relation').addEventListener('input', function () {
    if (this.value == 'Single') {
        document.getElementById('first_page_continue').setAttribute('onclick', " document.getElementById('form').submit;document.getElementById('form').submit(); document.querySelector('.loader').style.display='flex';");
    } else {
        document.getElementById('first_page_continue').removeAttribute('onclick');
    }
})