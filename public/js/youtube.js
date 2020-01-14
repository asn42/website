Array.prototype.forEach.call(document.getElementsByClassName('video-youtube'), (div) => {
  const link = div.firstElementChild;
  link.addEventListener('click', (ev) => {
    ev.preventDefault();
    div.className = div.className.replace(/\s*video-youtube\s*/, '');
    const iframe = document.createElement('iframe');
    iframe.src = 'https://www.youtube.com/embed/' + link.getAttribute('data-id') + '?autoplay=1';
    iframe.setAttribute('allowFullScreen', '');
    iframe.setAttribute('mozAllowFullScreen', '');
    iframe.setAttribute('webkitAllowFullScreen', '');
    div.replaceChild(iframe, link);
  }, false);
});
