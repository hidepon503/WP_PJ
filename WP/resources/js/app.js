import './bootstrap';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


function openModal() {
  document.getElementById("myModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("myModal").classList.add("hidden");
}

document.addEventListener("DOMContentLoaded", function() {
  document.querySelector("a[href='']").addEventListener("click", function(e) {
    e.preventDefault();
    openModal();
  });
});
