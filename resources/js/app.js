require('./bootstrap');
// require('./components/App')
const feather = require('feather-icons')
feather.replace({'stroke-width': 1.5})
window.feather = feather;
require('alpinejs');

import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

// ### Swal
const Swal = require('sweetalert2/dist/sweetalert2.min');
window.Swal = Swal;
window.toast = {
    success(message, options = {}) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Success',
            text: message,
            showConfirmButton: false,
            timer: 1500,
            ...options
        })
    },
    error(message, options = {}) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Error',
            text: message,
            showConfirmButton: false,
            timer: 1500,
            ...options
        })
    }
}

// Toast
const Toast = require('toastr');
window.toast = Toast;

for(let item of document.getElementsByTagName('img')) {
    item.addEventListener("error", function(e) {
        e.target.src = '/images/no-image.jpg';
    })
}
