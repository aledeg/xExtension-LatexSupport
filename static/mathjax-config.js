window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']]
  }
};

document.body.addEventListener('freshrss:load-more', e => {
  if ('function' === typeof MathJax.typeset) {
    MathJax.typeset();
  }
});
