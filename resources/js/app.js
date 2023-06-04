import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Plyr from 'plyr';

const player = new Plyr('audio', {});
// const player = new Plyr('#player');

// Expose player so it can be used from the console
window.player = player;
