// Control header on scroll
window.onscroll = function() {
  scrollFunction()
}

function scrollFunction() {
  if (document.body.scrollTop > 32 || document.documentElement.scrollTop > 32) {
    document.querySelector('.middle-row').className = 'middle-row min'
  } else {
    document.querySelector('.middle-row').classList.remove('min')
  }
}
