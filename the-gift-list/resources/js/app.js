import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


//Edit List Page - Show/Hide the list information
var noEditMode = document.getElementById('noEditMode');
var editMode = document.getElementById('editMode');

$(function () {
    noEditMode.style.display = 'block';
    editMode.style.display = 'none';

    $('#noEditMode #editBtn').on('click', function () {
        $('#noEditMode').toggle();
        $('#editMode').toggle();
    });
    $('#editMode #cancelBtn').on('click', function () {
        $('#noEditMode').toggle();
        $('#editMode').toggle();
    });
});