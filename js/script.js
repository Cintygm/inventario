document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('formProducto');
  if (!form) return;

  const campos = {
    nombre: {
      el: document.getElementById('nombre'),
      validar: (v) => v.trim().length >= 3 && v.trim().length <= 100,
      mensaje: 'El nombre debe tener entre 3 y 100 caracteres.'
    },
    categoria: {
      el: document.getElementById('categoria'),
      validar: (v) => v.trim() !== '',
      mensaje: 'Debe seleccionar una categoría.'
    },
    precio: {
      el: document.getElementById('precio'),
      validar: (v) => v.trim() !== '' && !isNaN(v) && parseFloat(v) >= 0,
      mensaje: 'Ingrese un precio numérico válido (mayor o igual a 0).'
    },
    cantidad: {
      el: document.getElementById('cantidad'),
      validar: (v) => v.trim() !== '' && /^\d+$/.test(v),
      mensaje: 'Ingrese una cantidad entera válida (0 o más).'
    },
    descripcion: {
      el: document.getElementById('descripcion'),
      validar: (v) => v.length <= 255,
      mensaje: 'La descripción no debe superar 255 caracteres.'
    }
  };

  function mostrarError(campo, mostrar) {
    const { el, mensaje } = campos[campo];
    const feedback = el.parentElement.querySelector('.invalid-feedback');
    if (mostrar) {
      el.classList.add('is-invalid');
      if (feedback) feedback.textContent = mensaje;
    } else {
      el.classList.remove('is-invalid');
      if (feedback) feedback.textContent = '';
    }
  }

  function validarCampo(nombreCampo) {
    const campo = campos[nombreCampo];
    const valor = campo.el.value;
    const esValido = campo.validar(valor);
    mostrarError(nombreCampo, !esValido);
    return esValido;
  }

  Object.keys(campos).forEach((nombreCampo) => {
    if (campos[nombreCampo].el) {
      campos[nombreCampo].el.addEventListener('blur', () => validarCampo(nombreCampo));
      campos[nombreCampo].el.addEventListener('input', () => {
        if (campos[nombreCampo].el.classList.contains('is-invalid')) {
          validarCampo(nombreCampo);
        }
      });
    }
  });

  form.addEventListener('submit', function (e) {
    let formValido = true;

    Object.keys(campos).forEach((nombreCampo) => {
      if (campos[nombreCampo].el && !validarCampo(nombreCampo)) {
        formValido = false;
      }
    });

    if (!formValido) {
      e.preventDefault();
      const primerError = form.querySelector('.is-invalid');
      if (primerError) primerError.focus();
    }
  });
});

function confirmarEliminar(nombre) {
  return confirm('¿Está seguro de eliminar "' + nombre + '"? Esta acción no se puede deshacer.');
}
