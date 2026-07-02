<style>
/* Estilos específicos para el nuevo Login Profesional SENA */
body {
    background-color: #ffffff !important;
    padding: 0 !important;
    margin: 0 !important;
}
main.container-fluid {
    padding: 0 !important;
}
footer {
    display: none !important; /* Ocultamos el footer general en la pantalla de login para lograr inmersión total */
}
.login-split {
    min-height: 100vh;
}
.login-bg {
    background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop') no-repeat center center;
    background-size: cover;
    position: relative;
}
.login-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 120, 50, 0.92) 0%, rgba(57, 169, 0, 0.82) 100%);
}
.btn-sena {
    background-color: #39A900;
    border-color: #39A900;
    color: #ffffff;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-sena:hover {
    background-color: #007832;
    border-color: #007832;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
}
.text-sena {
    color: #39A900;
}
.form-floating input:focus {
    border-color: #39A900;
    box-shadow: 0 0 0 0.25rem rgba(57, 169, 0, 0.25);
}
</style>

<div class="row g-0 login-split">
    <!-- COLUMNA IZQUIERDA: IMAGEN E IDENTIDAD SENA (Oculta en pantallas móviles) -->
    <div class="col-lg-7 d-none d-lg-flex login-bg">
        <div class="login-overlay d-flex flex-column justify-content-between p-5 text-white">
            <div>
                <div class="d-flex align-items-center mb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sena_Colombia_logo.svg/120px-Sena_Colombia_logo.svg.png" alt="Logo SENA" style="width: 55px; height: auto;" class="me-3 bg-white p-2 rounded-3 shadow">
                    <h3 class="fw-bold mb-0 tracking-tight">Servicio Nacional de Aprendizaje</h3>
                </div>
                <span class="badge bg-white text-dark fw-bold px-3 py-2 text-uppercase tracking-wider shadow-sm mb-3">SGA - Gestión Académica Integral</span>
            </div>

            <div class="mb-5 pe-5">
                <h1 class="display-4 fw-bold mb-4">Transformando la formación profesional en Colombia</h1>
                <p class="lead fw-normal opacity-90 mb-4" style="max-width: 600px;">
                    Accede a nuestra plataforma institucional para gestionar fichas de formación, programación de sesiones, disponibilidad de ambientes y seguimiento de asistencia en tiempo real.
                </p>
                <div class="d-flex gap-4 small opacity-75 border-top border-white-50 pt-4 mt-4">
                    <div><i class="fa-solid fa-circle-check me-2"></i>Calidad Certificada</div>
                    <div><i class="fa-solid fa-shield-halved me-2"></i>Acceso Seguro</div>
                    <div><i class="fa-solid fa-laptop-code me-2"></i>Innovación Tecnológica</div>
                </div>
            </div>

            <div class="small opacity-75 d-flex justify-content-between">
                <span>© <?= date('Y'); ?> SENA Colombia - Todos los derechos reservados.</span>
                <span>Ministerio del Trabajo</span>
            </div>
        </div>
    </div>

    <!-- COLUMNA DERECHA: FORMULARIO DE INICIO DE SESIÓN -->
    <div class="col-12 col-lg-5 d-flex flex-column justify-content-center px-4 px-md-5 bg-white shadow-lg z-1">
        <div class="w-100 mx-auto" style="max-width: 440px;">
            
            <!-- Cabecera Móvil y Logo -->
            <div class="text-center mb-5">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sena_Colombia_logo.svg/2048px-Sena_Colombia_logo.svg.png" alt="Logo SENA Oficial" class="mb-4" style="width: 90px; height: auto;">
                <h3 class="fw-bold text-dark mb-1">Bienvenido al SGA</h3>
                <p class="text-muted small mb-0">Ingresa tus credenciales institucionales para continuar</p>
            </div>

            <!-- Alertas de Error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center rounded-3 p-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-4 me-3 text-danger"></i>
                    <div class="small fw-medium"><?= $error; ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <!-- Formulario de Login -->
            <form action="<?= URLROOT; ?>/index.php?route=auth/login" method="POST" class="needs-validation" novalidate>
                <div class="form-floating mb-4 shadow-sm">
                    <input type="number" class="form-control form-control-lg rounded-3" id="username" name="username" value="<?= htmlspecialchars($username ?? ''); ?>" placeholder="Ej: 1020304050" required min="10000" title="Debe ser un número de documento válido." autofocus>
                    <label for="username" class="text-secondary"><i class="fa-solid fa-id-card me-2 text-muted"></i>Documento de Identidad</label>
                    <div class="invalid-feedback px-2 small">
                        Ingresa un número de documento válido.
                    </div>
                </div>

                <div class="form-floating mb-4 shadow-sm">
                    <input type="password" class="form-control form-control-lg rounded-3" id="password" name="password" placeholder="Contraseña" required minlength="8" title="La contraseña debe tener al menos 8 caracteres.">
                    <label for="password" class="text-secondary"><i class="fa-solid fa-lock me-2 text-muted"></i>Contraseña</label>
                    <div class="invalid-feedback px-2 small">
                        La contraseña debe tener al menos 8 caracteres.
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                        <label class="form-check-label text-secondary" for="rememberMe">Recordar mi equipo</label>
                    </div>
                    <a href="#" class="text-decoration-none text-sena fw-medium" onclick="alert('Por favor comunícate con la oficina de sistemas del SENA para restaurar tu contraseña institucional.'); return false;">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-sena btn-lg rounded-3 py-3 shadow">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Ingresar al Sistema
                    </button>
                </div>
            </form>

            <!-- Información Soporte -->
            <div class="text-center mt-4 text-muted small">
                <i class="fa-solid fa-headset me-2 text-sena"></i>¿Necesitas ayuda? <a href="#" class="text-decoration-none text-secondary fw-medium" onclick="alert('Soporte SENA: (+57) 601 3430111'); return false;">Contactar Soporte Técnico</a>
            </div>

        </div>
    </div>
</div>

<script>
// Validación frontend usando Bootstrap (intercepta el submit)
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
