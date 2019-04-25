Array.prototype.forEach.call(document.getElementsByClassName('video-youtube'), (div) => {
  var link = div.firstElementChild;
  link.addEventListener('click', (ev) => {
    ev.preventDefault();
    div.className = div.className.replace(/\s*video-youtube\s*/, '');
    var iframe = document.createElement('iframe');
    iframe.src = 'https://www.youtube.com/embed/' + link.getAttribute('data-id') + '?autoplay=1';
    iframe.setAttribute('allowFullScreen', '');
    iframe.setAttribute('mozAllowFullScreen', '');
    iframe.setAttribute('webkitAllowFullScreen', '');
    div.replaceChild(iframe, link);
  }, false);
});
