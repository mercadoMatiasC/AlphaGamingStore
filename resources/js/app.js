import './bootstrap';
import.meta.glob([
'../images/**'
]);

import.meta.glob([
'../images/banners/**'
]);

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//NUMBER COUNTER SCRIPT
document.addEventListener('DOMContentLoaded', function () {
    const decrementBtn = document.getElementById('decrement-button');
    const incrementBtn = document.getElementById('increment-button');
    const input = document.getElementById('quantity-input');

    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || Infinity;

    decrementBtn.addEventListener('click', () => {
        let value = parseInt(input.value) || min;
        if (value > min) {
            input.value = value - 1;
        }
    });

    incrementBtn.addEventListener('click', () => {
        let value = parseInt(input.value) || min;
        if (value < max) {
            input.value = value + 1;
        }
    });
});

//HAMBURGER MOBILE MENU
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });
});