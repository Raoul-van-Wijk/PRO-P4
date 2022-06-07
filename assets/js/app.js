if(document.querySelector('[data-open-aside]')) {
document.querySelector('[data-open-aside]').addEventListener('click', () => {
  document.querySelector('main').classList.toggle('active-chat');
})
}




document.querySelectorAll('[data-popup-open]').forEach(button => {
  button.addEventListener('click', event => {
    const target = button.getAttribute('data-popup-open');
    if (!target) return;
    const element = document.querySelector(`[data-popup="${target}"]`);
    element.showModal();
  });
});

document.querySelectorAll('[data-popup-close]').forEach(button => {
  button.addEventListener('click', event => {
    event.preventDefault();
    const target = button.getAttribute('data-popup-close');
    if (!target) return;
    const element = document.querySelector(`[data-popup="${target}"]`);
    element.close();
  });
});