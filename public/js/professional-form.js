document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('appointmentForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if all required fields are filled
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Check if terms are accepted
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            isValid = false;
            terms.classList.add('is-invalid');
        } else {
            terms.classList.remove('is-invalid');
        }
        
        // If form is valid, show success message
        if (isValid) {
            Swal.fire({
                title: 'Success!',
                text: 'Our team is setting up your profile. We will send you a message so you can download the app once everything is ready. You\'re about to take your business to the next level!',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#000'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.reset();
                }
            });
        }
    });
});