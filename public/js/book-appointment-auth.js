/**
 * Book Appointment Authentication Handler
 * This script handles authentication for the book-appointment route
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Book appointment auth script loaded');
    
    // Check if we're on the book-appointment page and not authenticated
    const isBookAppointmentPage = window.location.pathname.includes('/book-appointment');
    
    if (isBookAppointmentPage && !window.isAuthenticated) {
        console.log('On book appointment page and not authenticated');
        
        // Store the current URL for redirection after login
        localStorage.setItem('book_appointment_url', window.location.href);
        
        // Show the login modal
        if (typeof $ !== 'undefined') {
            console.log('Showing modal using jQuery');
            setTimeout(() => {
                $('#loginModal').modal('show');
            }, 500);
        } else if (typeof bootstrap !== 'undefined') {
            console.log('Showing modal using bootstrap');
            const loginModalElement = document.getElementById('loginModal');
            if (loginModalElement) {
                setTimeout(() => {
                    const modal = new bootstrap.Modal(loginModalElement);
                    modal.show();
                }, 500);
            }
        }
    }
});
