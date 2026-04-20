import './bootstrap';

document.querySelectorAll('.nav-dropdown').forEach(dropdown => {
  const trigger = dropdown.querySelector('.nav-link');

  trigger.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown.classList.toggle('open');
  });
});

// Close when tapping outside
document.addEventListener('click', () => {
  document.querySelectorAll('.nav-dropdown.open')
    .forEach(d => d.classList.remove('open'));
});