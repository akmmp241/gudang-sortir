const kolom = document.getElementById('field-select')
const order = document.getElementById('order-select')

kolom.onchange = function () {
    window.location = "?field=" + kolom.value + "&order=" + order.value
};

order.onchange = function () {
    window.location = "?field=" + kolom.value + "&order=" + order.value
};

