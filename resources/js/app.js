require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Function to confirm delete action
window.confirmDelete = function (event) {
    if (!confirm('Are you sure you want to delete this item?')) {
        event.preventDefault(); // Prevent the form submission if the user clicks 'Cancel'
    }
}

Alpine.start();