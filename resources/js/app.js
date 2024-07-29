import './bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js';

document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.querySelector('meta[name="success-message"]').getAttribute('content');
    const errorMessage = document.querySelector('meta[name="error-message"]').getAttribute('content');

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: successMessage,
            confirmButtonText: 'OK'
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    }
});
