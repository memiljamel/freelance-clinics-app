import TypeIt from 'typeit';

const typeItElement = document.getElementById('typeit');

new TypeIt(typeItElement, {
  strings: ['Responsibility', 'Purpose', 'Ambition'],
  breakLines: false,
  waitUntilVisible: true,
  loop: true,
}).go();
