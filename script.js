document.addEventListener('DOMContentLoaded', () => {
    const calendar = document.getElementById('calendar');
    const timeSlots = document.getElementById('time-slots');
    const selectedDatesList = document.getElementById('selected-dates-list');
    const submitBtn = document.getElementById('submit-btn');
    const timeSlotButtons = document.querySelectorAll('.time-slot');

    let currentDate = new Date();
    let selectedDates = [];
    const maxSelectionsPerWeek = 3; // Change this to 2 or 5 based on the subscription
    const daysOfWeek = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

    function generateCalendar() {
        calendar.innerHTML = '';

        // Add day headers
        daysOfWeek.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.classList.add('calendar-header');
            dayHeader.textContent = day;
            calendar.appendChild(dayHeader);
        });

        const startDate = new Date(currentDate);
        startDate.setDate(startDate.getDate() - startDate.getDay()); // Start from Sunday

        for (let i = 0; i < 35; i++) {
            const date = new Date(startDate);
            date.setDate(date.getDate() + i);

            const dayElement = document.createElement('div');
            dayElement.classList.add('calendar-day');
            dayElement.textContent = date.getDate();
            dayElement.dataset.date = date.toISOString().split('T')[0];

            if (date < currentDate || date > new Date(currentDate.getTime() + 30 * 24 * 60 * 60 * 1000) || date.getDay() === 0 || date.getDay() === 6) {
                dayElement.classList.add('disabled');
            } else {
                dayElement.addEventListener('click', () => toggleDateSelection(dayElement));
            }

            calendar.appendChild(dayElement);
        }
    }

    function toggleDateSelection(dayElement) {
        const selectedDate = dayElement.dataset.date;
        const index = selectedDates.findIndex(d => d.date === selectedDate);

        if (index === -1) {
            if (canSelectDate(selectedDate)) {
                dayElement.classList.add('selected');
                selectedDates.push({ date: selectedDate, time: null });
                showTimeSlots();
            }
        } else {
            dayElement.classList.remove('selected');
            selectedDates.splice(index, 1);
            if (selectedDates.length === 0) {
                timeSlots.classList.add('hidden');
            }
        }

        updateSelectedDatesList();
    }

    function canSelectDate(date) {
        const selectedWeek = getWeekNumber(new Date(date));
        const selectionsThisWeek = selectedDates.filter(d => getWeekNumber(new Date(d.date)) === selectedWeek).length;
        return selectionsThisWeek < maxSelectionsPerWeek;
    }

    function getWeekNumber(date) {
        const d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
        const dayNum = d.getUTCDay() || 7;
        d.setUTCDate(d.getUTCDate() + 4 - dayNum);
        const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
        return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    }

    function showTimeSlots() {
        timeSlots.classList.remove('hidden');
    }

    function updateSelectedDatesList() {
        selectedDatesList.innerHTML = '';
        selectedDates.forEach(dateObj => {
            const li = document.createElement('li');
            li.innerHTML = `<i class="fas fa-calendar-check"></i> ${formatDate(dateObj.date)}${dateObj.time ? ' à ' + dateObj.time : ''}`;
            selectedDatesList.appendChild(li);
        });

        submitBtn.classList.toggle('hidden', selectedDates.length === 0);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long' });
    }

    timeSlotButtons.forEach(button => {
        button.addEventListener('click', () => {
            const time = button.textContent.trim();
            const lastSelectedDate = selectedDates[selectedDates.length - 1];
            if (lastSelectedDate && !lastSelectedDate.time) {
                lastSelectedDate.time = time;
                updateSelectedDatesList();
                timeSlots.classList.add('hidden');
            }
        });
    });

    submitBtn.addEventListener('click', () => {
        console.log('Réservation confirmée:', selectedDates);
        // Ici, vous pouvez ajouter la logique pour envoyer les données au serveur
    });

    generateCalendar();
});

