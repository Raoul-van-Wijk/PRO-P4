if(document.querySelector('[data-open-aside]')) {
document.querySelector('[data-open-aside]').addEventListener('click', () => {
  document.querySelector('main').classList.toggle('active-chat');
})
}

const ProfileButton = document.querySelector('[data-edit-profile-btn]')
ProfileButton.addEventListener('click', () => {
  document.querySelector('[data-edit-profile]').classList.toggle('active');
})