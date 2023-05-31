const sign_in_btn = document.querySelector('#sign-in-btn');
const sign_up_btn = document.querySelector('#sign-up-btn');
const container = document.querySelector('.container');

sign_up_btn.addEventListener('click', () => {
  container.classList.add('sign-up-mode');
});

sign_in_btn.addEventListener('click', () => {
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.delete('register');
    const newRelativePathQuery = window.location.pathname + searchParams.toString();
    history.pushState(null, "", newRelativePathQuery);
  container.classList.remove('sign-up-mode');
});
