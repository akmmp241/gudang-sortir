function addOrUpdateUrlParam(key, value) {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.delete('search');
    searchParams.set(key, value);
    const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString();
    history.pushState(null, "", newRelativePathQuery);
}

const field = document.getElementById('field')
const type = document.getElementById('type')
const item = document.getElementById('item')
const order = document.getElementById('order')

field.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('field', field.value)
    window.location = window.location.href
};

type.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('type', type.value)
    window.location = window.location.href
};

item.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('item', item.value)
    window.location = window.location.href
};

order.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('order', order.value)
    window.location = window.location.href
};
