const addOrUpdateUrlParam = (key, value) => {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set(key, value);
    const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString();
    history.pushState(null, "", newRelativePathQuery);
};

const field = document.getElementById('field')
const category = document.getElementById('category')
const order = document.getElementById('order')

field.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('field', field.value)
    window.location = window.location.href
};

category.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('category', category.value)
    window.location = window.location.href
};

order.onchange = function () {
    window.location = window.location.origin + window.location.pathname
    addOrUpdateUrlParam('order', order.value)
    window.location = window.location.href
};
