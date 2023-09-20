function scrollToDiv(divId) {
  var element = document.getElementById(divId);
  element.scrollIntoView({ behavior: 'smooth' });
  
  showCover();
}

function showCover() {
  var cover = document.querySelector('.cover');
  cover.style.display = 'block';
}
 // JavaScript to toggle responsive navigation
 var navToggle = document.createElement('div');
 navToggle.className = 'nav-toggle';
 navToggle.addEventListener('click', function() {
   document.querySelector('nav ul').classList.toggle('show');
 });
 
 document.querySelector('nav').appendChild(navToggle);