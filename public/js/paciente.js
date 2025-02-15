document.addEventListener("DOMContentLoaded", function () {
    const detailedInfo = document.getElementById("detailed-info");
    const viewContactButtons = document.querySelectorAll(".view-contact-btn");
    const viewMedicalHistoryButtons = document.querySelectorAll(".view-medical-history-btn");

    viewContactButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Aquí podrías cargar y mostrar los contactos del residente correspondiente en "detailedInfo"
            detailedInfo.innerHTML = "Detalles de los contactos del residente.";
        });
    });

    viewMedicalHistoryButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Aquí podrías cargar y mostrar el historial médico del residente correspondiente en "detailedInfo"
            detailedInfo.innerHTML = "Historial médico del residente.";
        });
    });
});