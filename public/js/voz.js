document.addEventListener('DOMContentLoaded', function () {
    const voiceInput = document.getElementById('voice-input');
    const voiceButton = document.getElementById('voice-button');

    // Comienza a grabar cuando se hace clic en el botón
    voiceButton.addEventListener('click', function () {
        const recognition =  new webkitSpeechRecognition() || new SpeechRecognition();  
        
        recognition.start();

        recognition.onresult = function (event) {
            const transcript = event.results[0][0].transcript;
            voiceInput.value = transcript;

            // Envía la consulta de voz al servidor Laravel
            axios.post('/search-patients', { query: transcript })
                .then(response => {
                    // Muestra los resultados en la interfaz de usuario
                    const results = response.data;
                    // Implementa cómo deseas mostrar los resultados
                })
                .catch(error => {
                    console.error(error);
                });
        };
    });
});