document.querySelector('[data-open-aside]').addEventListener('click', () => {
  document.querySelector('main').classList.toggle('active-chat');
})

document.querySelector('[data-edit-profile-btn]').addEventListener('click', () => {
  document.querySelector('[data-edit-profile]').classList.toggle('active');
})