document.addEventListener('DOMContentLoaded', function() {
    const datePicker = flatpickr("#datePicker", {
        dateFormat: "Y-m-d",
        minDate: "today",
        disableMobile: "true",
        locale: {
            firstDayOfWeek: 1
        },
        onChange: function(selectedDates, dateStr, instance) {
            updateButtons(dateStr);
        },
        onOpen: function(selectedDates, dateStr, instance) {
            // Add Today and Tomorrow buttons if they don't exist
            if (!document.querySelector('.today-tomorrow-buttons')) {
                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'today-tomorrow-buttons';
                
                const anyDateBtn = document.createElement('button');
                anyDateBtn.textContent = 'Any date';
                anyDateBtn.className = 'date-button active';

                const todayBtn = document.createElement('button');
                todayBtn.textContent = 'Today';
                todayBtn.className = 'date-button';

                const tomorrowBtn = document.createElement('button');
                tomorrowBtn.textContent = 'Tomorrow';
                tomorrowBtn.className = 'date-button';

                buttonContainer.appendChild(anyDateBtn);
                buttonContainer.appendChild(todayBtn);
                buttonContainer.appendChild(tomorrowBtn);

                instance.calendarContainer.insertBefore(buttonContainer, instance.calendarContainer.firstChild);

                [anyDateBtn, todayBtn, tomorrowBtn].forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.date-button').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        
                        if (this.textContent === 'Today') {
                            instance.setDate(new Date());
                        } else if (this.textContent === 'Tomorrow') {
                            const tomorrow = new Date();
                            tomorrow.setDate(tomorrow.getDate() + 1);
                            instance.setDate(tomorrow);
                        } else {
                            instance.clear();
                            document.getElementById('datePicker').placeholder = 'Any date';
                        }
                    });
                });
            }
        }
    });

    function updateButtons(dateStr) {
        const buttons = document.querySelectorAll('.date-button');
        buttons.forEach(btn => btn.classList.remove('active'));
        
        const today = new Date().toISOString().split('T')[0];
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];

        if (dateStr === today) {
            buttons[1].classList.add('active'); // Today button
        } else if (dateStr === tomorrowStr) {
            buttons[2].classList.add('active'); // Tomorrow button
        } else {
            buttons[0].classList.add('active'); // Any date button
        }
    }
});