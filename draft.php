export default {
    data() {
        return {
            formMonday: {
                salad_name: '',
                time: '',
            },
            formTuesday: {
                salad_name: '',
                time: '',
            },
        };
    },
    methods: {
        orderForDay(day) {
            const formData = this[`form${this.capitalize(day)}`];
            axios.post('api/script.php?action=orderForDay', {
                salad_name: formData.salad_name,
                time: formData.time,
                dayOfWeek: day,
            })
            .then(response => {
                if (response.data && response.data.status === 'success') {
                    alert(`Abonnement effectué avec succès pour ${day}`);
                    this.resetForm(day);
                } else {
                    const message = response.data.message || 'Une erreur est survenue.';
                    alert(`Erreur pour ${day}: ${message}`);
                }
            })
            .catch(error => {
                console.error(`Erreur lors de la soumission pour ${day}:`, error);
                alert(`Une erreur technique est survenue pour ${day}. Veuillez réessayer.`);
            });
        },
        resetForm(day) {
            const formKey = `form${this.capitalize(day)}`;
            this[formKey].salad_name = '';
            this[formKey].time = '';
        },
        capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
    },
};
