document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
        const nombre = form.nombre.value.trim();
        const email = form.email.value.trim();
        const sexo = form.sexo.value;
        const area = form.area_id.value;
        const descripcion = form.descripcion.value.trim();
        const roles = document.querySelectorAll('input[name="roles[]"]:checked');

        // Validación: nombre solo letras y espacios
        const nombreValido = /^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/.test(nombre);
        if (!nombreValido) {
            alert('⚠️ El nombre solo debe contener letras y espacios.');
            e.preventDefault();
            return;
        }

        // Validación: email básico
        const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if (!emailValido) {
            alert('⚠️ El correo electrónico no es válido.');
            e.preventDefault();
            return;
        }

        // Validación: sexo obligatorio
        if (!sexo) {
            alert('⚠️ Debes seleccionar el sexo.');
            e.preventDefault();
            return;
        }

        // Validación: área obligatoria
        if (!area) {
            alert('⚠️ Debes seleccionar un área.');
            e.preventDefault();
            return;
        }

        // Validación: descripción obligatoria
        if (descripcion.length < 5) {
            alert('⚠️ La descripción debe tener al menos 5 caracteres.');
            e.preventDefault();
            return;
        }

        // Validación: al menos un rol seleccionado
        if (roles.length === 0) {
            alert('⚠️ Debes seleccionar al menos un rol.');
            e.preventDefault();
            return;
        }

        // Si todo está bien, se envía el formulario
    });
});
