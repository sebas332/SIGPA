<style>
/* Estilos específicos para Restablecer Contraseña */
body {
    background-color: #ffffff !important;
    padding: 0 !important;
    margin: 0 !important;
}
main.container-fluid {
    padding: 0 !important;
}
footer {
    display: none !important; /* Ocultar el footer general */
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
    background: linear-gradient(135deg, rgba(1, 38, 17, 0.92) 0%, rgba(0, 80, 38, 0.85) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 4.5rem !important;
}

/* Marca SENA Izquierda */
.brand-container {
    display: flex;
    align-items: center;
    gap: 1.2rem;
}
.brand-logo-box {
    background-color: #ffffff;
    padding: 0.6rem;
    border-radius: 12px;
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
.brand-logo-box img {
    max-width: 100%;
    max-height: 100%;
}
.brand-text-wrapper {
    display: flex;
    flex-direction: column;
}
.brand-title {
    font-weight: 700;
    font-size: 1.25rem;
    line-height: 1.2;
    color: #ffffff;
    margin: 0;
}
.brand-subtitle {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
}

.sga-capsule-badge {
    background-color: #005026;
    border: 1px solid rgba(0, 163, 86, 0.3);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.7rem;
    letter-spacing: 0.8px;
    padding: 0.45rem 1.1rem;
    border-radius: 20px;
    display: inline-block;
}

.text-sena-light {
    color: #39A900 !important;
}
.heading-divider {
    width: 45px;
    height: 4px;
    background-color: #39A900;
    margin: 1.5rem 0;
    border-radius: 2px;
}

/* Lado Derecho: Formulario */
.login-form-side {
    background-color: #f8fafc;
    background-image: radial-gradient(#e2e8f0 1.2px, transparent 1.2px);
    background-size: 24px 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.login-card {
    background-color: #ffffff;
    border-radius: 24px;
    padding: 3rem 2.5rem;
    width: 100%;
    max-width: 430px;
    box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.08), 0 10px 15px -8px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.01);
}

/* Inputs Custom */
.custom-input-group {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}
.custom-input-group .input-icon {
    position: absolute;
    left: 1.25rem;
    color: #94a3b8;
    font-size: 0.95rem;
    pointer-events: none;
}
.custom-form-control {
    width: 100%;
    height: 52px;
    padding: 0.375rem 1.25rem 0.375rem 2.85rem;
    font-size: 0.92rem;
    font-weight: 500;
    color: #1e293b;
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
}
.custom-form-control:focus {
    outline: none;
    border-color: #39A900;
    box-shadow: 0 0 0 4px rgba(57, 169, 0, 0.1);
}
.custom-form-control::placeholder {
    color: #94a3b8;
    font-weight: 400;
}
.btn-toggle-password {
    position: absolute;
    right: 1.25rem;
    background: none;
    border: none;
    color: #94a3b8;
    font-size: 0.95rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 0;
    transition: color 0.2s;
}
.btn-toggle-password:hover {
    color: #475569;
}
.feedback-text {
    font-size: 0.72rem;
    font-weight: 600;
    padding-left: 0.25rem;
}

.btn-sena-submit {
    width: 100%;
    height: 50px;
    background-color: #39A900;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.92rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(57, 169, 0, 0.2);
    transition: all 0.2s ease;
    cursor: pointer;
}
.btn-sena-submit:hover {
    background-color: #007832;
    box-shadow: 0 6px 16px rgba(57, 169, 0, 0.3);
    transform: translateY(-1px);
}
.btn-sena-submit:active {
    transform: translateY(1px);
}

.support-help-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.76rem;
    color: #64748b;
}
.support-icon {
    color: #39A900;
    font-size: 0.85rem;
}
.support-text {
    font-weight: 600;
}
</style>

<div class="row g-0 login-split">
    <!-- COLUMNA IZQUIERDA: IMAGEN E IDENTIDAD SENA (Oculta en pantallas móviles) -->
    <div class="col-lg-7 d-none d-lg-flex login-bg">
        <div class="login-overlay d-flex flex-column justify-content-between p-5 text-white">
            <div class="brand-container">
                <div class="brand-logo-box">
                    <img src="<?= ASSETROOT; ?>/logo-sena.svg" alt="Logo SENA">
                </div>
                <div class="brand-text-wrapper">
                    <h3 class="brand-title">Servicio Nacional</h3>
                    <span class="brand-subtitle">de Aprendizaje</span>
                </div>
            </div>

            <div class="mb-5 pe-5">
                <div class="mb-3">
                    <span class="sga-capsule-badge">SGA - GESTIÓN ACADÉMICA INTEGRAL</span>
                </div>
                <h1 class="display-5 fw-bold mb-3" style="max-width: 600px; line-height: 1.15;">
                    Establece una contraseña <span class="text-sena-light">segura y robusta.</span>
                </h1>
                <div class="heading-divider"></div>
                <p class="lead fs-6 opacity-90 mb-4" style="max-width: 520px; font-weight: 400; line-height: 1.5;">
                    Para proteger tu cuenta en el Sistema de Gestión Académica, tu contraseña debe incluir mayúsculas, minúsculas, números y caracteres especiales.
                </p>
            </div>

            <div class="small opacity-75 d-flex justify-content-between border-top border-white-10 pt-3" style="font-size: 0.72rem; border-color: rgba(255, 255, 255, 0.1) !important;">
                <span>© 2026 SENA Colombia. Todos los derechos reservados.</span>
                <span>Ministerio del Trabajo</span>
            </div>
        </div>
    </div>

    <!-- COLUMNA DERECHA: FORMULARIO -->
    <div class="col-12 col-lg-5 login-form-side px-4">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="<?= ASSETROOT; ?>/logo-sena.svg" alt="Logo SENA Oficial" class="mb-3" style="width: 75px; height: auto;">
                <h3 class="fw-bold text-dark mb-1" style="font-size: 1.55rem; letter-spacing: -0.5px;">Nueva Contraseña</h3>
                <p class="text-muted small mb-0">Completa los campos para actualizar tus credenciales</p>
            </div>

            <!-- Formulario de Actualización -->
            <form action="<?= URLROOT; ?>/index.php?route=auth/updatePassword" method="POST" class="needs-validation" novalidate id="resetPasswordForm">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <div class="custom-input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" class="custom-form-control" id="contrasena" name="contrasena" placeholder="Nueva Contraseña" required minlength="8" maxlength="30">
                        <button type="button" class="btn-toggle-password" id="togglePasswordBtn1" tabindex="-1">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon1"></i>
                        </button>
                    </div>
                    <div id="password-feedback" class="feedback-text text-muted mt-1 px-1" style="display: none; line-height: 1.4;"></div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4">
                    <div class="custom-input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" class="custom-form-control" id="contrasena_confirm" name="contrasena_confirm" placeholder="Confirmar Nueva Contraseña" required minlength="8" maxlength="30">
                        <button type="button" class="btn-toggle-password" id="togglePasswordBtn2" tabindex="-1">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon2"></i>
                        </button>
                    </div>
                    <div id="confirm-feedback" class="feedback-text text-muted mt-1 px-1" style="display: none;"></div>
                </div>

                <!-- Botón Guardar -->
                <div class="mb-4">
                    <button type="submit" class="btn-sena-submit">
                        <i class="fa-solid fa-key"></i> Guardar Nueva Contraseña
                    </button>
                </div>
            </form>

            <div class="support-help-container">
                <i class="fa-solid fa-headset support-icon"></i>
                <span class="support-text">SGA • Soporte Técnico de Sede</span>
            </div>
        </div>
    </div>
</div>

<script>
// Validación frontend usando Bootstrap
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

// Control del Toggle de Contraseñas
function setupTogglePassword(btnId, inputId, iconId) {
    const btn = document.getElementById(btnId);
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (btn && input && icon) {
        btn.addEventListener('click', function() {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            if (type === 'text') {
                icon.className = 'fa-regular fa-eye-slash';
            } else {
                icon.className = 'fa-regular fa-eye';
            }
        });
    }
}
setupTogglePassword('togglePasswordBtn1', 'contrasena', 'togglePasswordIcon1');
setupTogglePassword('togglePasswordBtn2', 'contrasena_confirm', 'togglePasswordIcon2');

// Validación en tiempo real
const passwordInput = document.getElementById('contrasena');
const confirmInput = document.getElementById('contrasena_confirm');
const passwordFeedback = document.getElementById('password-feedback');
const confirmFeedback = document.getElementById('confirm-feedback');

function validatePassword() {
    if (!passwordInput || !passwordFeedback) return;
    const val = passwordInput.value;
    let rulesFailed = [];
    
    if (val.length < 8 || val.length > 30) rulesFailed.push("Tener entre 8 y 30 caracteres.");
    if (!/^[A-Z]/.test(val)) rulesFailed.push("Iniciar con mayúscula.");
    if (!/[0-9]/.test(val)) rulesFailed.push("Contener al menos un número.");
    if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val)) rulesFailed.push("Contener un carácter especial.");
    
    if (val.length === 0) {
        passwordFeedback.innerHTML = "Mínimo 8 caracteres (A-Z, a-z, 0-9, especial).";
        passwordFeedback.className = 'feedback-text text-muted mt-1 px-1';
        passwordInput.setCustomValidity("Campo requerido");
    } else if (rulesFailed.length > 0) {
        passwordFeedback.innerHTML = "<span class='text-danger d-block mb-1'><i class='fa-solid fa-circle-xmark'></i> " + rulesFailed.join("</span><span class='text-danger d-block mb-1'><i class='fa-solid fa-circle-xmark'></i> ") + "</span>";
        passwordInput.setCustomValidity("Faltan requisitos");
    } else {
        passwordFeedback.innerHTML = "<span class='text-success'><i class='fa-solid fa-circle-check'></i> Contraseña válida y segura.</span>";
        passwordInput.setCustomValidity("");
    }
    validateConfirm();
}

function validateConfirm() {
    if (!confirmInput || !confirmFeedback || !passwordInput) return;
    const val = confirmInput.value;
    
    if (val.length === 0) {
        confirmFeedback.textContent = "";
        confirmFeedback.style.display = 'none';
        confirmInput.setCustomValidity("Campo requerido");
    } else if (val !== passwordInput.value) {
        confirmFeedback.textContent = "Las contraseñas no coinciden.";
        confirmFeedback.className = 'feedback-text text-danger mt-1 px-1';
        confirmFeedback.style.display = 'block';
        confirmInput.setCustomValidity("No coinciden");
    } else {
        confirmFeedback.textContent = "Las contraseñas coinciden.";
        confirmFeedback.className = 'feedback-text text-success mt-1 px-1';
        confirmFeedback.style.display = 'block';
        confirmInput.setCustomValidity("");
    }
}

if (passwordInput && passwordFeedback) {
    passwordInput.addEventListener('focus', function() {
        passwordFeedback.style.display = 'block';
        validatePassword();
    });
    passwordInput.addEventListener('blur', function() {
        setTimeout(() => { passwordFeedback.style.display = 'none'; }, 200);
    });
    passwordInput.addEventListener('input', validatePassword);
}

if (confirmInput && confirmFeedback) {
    confirmInput.addEventListener('input', validateConfirm);
}
</script>
