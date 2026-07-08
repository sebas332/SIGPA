<style>
/* Estilos específicos para el nuevo Login Premium SENA */
body {
    background-color: #ffffff !important;
    padding: 0 !important;
    margin: 0 !important;
}
main.container-fluid {
    padding: 0 !important;
}
footer {
    display: none !important; /* Ocultar el footer general en el login */
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

/* Badge SGA */
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
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* Elementos de Texto del Hero */
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

/* Feature Cards */
.features-grid {
    display: flex;
    gap: 1.2rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
}
.feature-card {
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 12px;
    padding: 0.6rem 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    background-color: rgba(255, 255, 255, 0.03);
    transition: all 0.2s ease;
}
.feature-card:hover {
    border-color: rgba(255, 255, 255, 0.35);
    background-color: rgba(255, 255, 255, 0.06);
}
.feature-icon {
    font-size: 1.15rem;
    color: #ffffff;
}
.feature-text {
    display: flex;
    flex-direction: column;
    font-size: 0.74rem;
    font-weight: 600;
    line-height: 1.25;
    color: rgba(255, 255, 255, 0.9);
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

/* Checkbox y Links */
.form-check-custom {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.custom-checkbox {
    width: 16px;
    height: 16px;
    accent-color: #39A900;
    cursor: pointer;
}
.custom-checkbox-label {
    color: #64748b;
    font-weight: 600;
    cursor: pointer;
    user-select: none;
}
.forgot-password-link {
    color: #39A900;
    text-decoration: none;
    font-weight: 700;
    transition: color 0.2s;
}
.forgot-password-link:hover {
    color: #007832;
}

/* Botón Submit */
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

/* Soporte */
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
.support-link {
    color: #475569;
    text-decoration: none;
    font-weight: 700;
}
.support-link:hover {
    color: #1e293b;
    text-decoration: underline;
}
</style>

<div class="row g-0 login-split">
    <!-- COLUMNA IZQUIERDA: IMAGEN E IDENTIDAD SENA (Oculta en pantallas móviles) -->
    <div class="col-lg-7 d-none d-lg-flex login-bg">
        <div class="login-overlay d-flex flex-column justify-content-between p-5 text-white">
            <!-- Header Marca -->
            <div class="brand-container">
                <div class="brand-logo-box">
                    <img src="<?= ASSETROOT; ?>/logo-sena.svg" alt="Logo SENA">
                </div>
                <div class="brand-text-wrapper">
                    <h3 class="brand-title">Servicio Nacional</h3>
                    <span class="brand-subtitle">de Aprendizaje</span>
                </div>
            </div>

            <!-- SGA Badge & Hero Titles -->
            <div class="mb-5 pe-5">
                <div class="mb-3">
                    <span class="sga-capsule-badge">SGA - GESTIÓN ACADÉMICA INTEGRAL</span>
                </div>
                <h1 class="display-5 fw-bold mb-3" style="max-width: 600px; line-height: 1.15;">
                    Gestión académica inteligente para la <span class="text-sena-light">formación profesional.</span>
                </h1>
                <div class="heading-divider"></div>
                <p class="lead fs-6 opacity-90 mb-4" style="max-width: 520px; font-weight: 400; line-height: 1.5;">
                    Plataforma institucional para la gestión de fichas, horarios, ambientes y asistencia en tiempo real.
                </p>

                <!-- Feature Grid -->
                <div class="features-grid">
                    <div class="feature-card">
                        <i class="fa-regular fa-circle-check feature-icon"></i>
                        <div class="feature-text">
                            <span>Calidad</span>
                            <span>Certificada</span>
                        </div>
                    </div>
                    <div class="feature-card">
                        <i class="fa-solid fa-shield-halved feature-icon"></i>
                        <div class="feature-text">
                            <span>Acceso</span>
                            <span>Seguro</span>
                        </div>
                    </div>
                    <div class="feature-card">
                        <i class="fa-regular fa-lightbulb feature-icon"></i>
                        <div class="feature-text">
                            <span>Innovación</span>
                            <span>Tecnológica</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Izquierdo -->
            <div class="small opacity-75 d-flex justify-content-between border-top border-white-10 pt-3" style="font-size: 0.72rem; border-color: rgba(255, 255, 255, 0.1) !important;">
                <span>© 2026 SENA Colombia. Todos los derechos reservados.</span>
                <span>Ministerio del Trabajo</span>
            </div>
        </div>
    </div>

    <!-- COLUMNA DERECHA: FORMULARIO DE INICIO DE SESIÓN -->
    <div class="col-12 col-lg-5 login-form-side px-4">
        <div class="login-card">
            <!-- Cabecera Formulario -->
            <div class="text-center mb-4">
                <img src="<?= ASSETROOT; ?>/logo-sena.svg" alt="Logo SENA Oficial" class="mb-3" style="width: 75px; height: auto;">
                <h3 class="fw-bold text-dark mb-1" style="font-size: 1.55rem; letter-spacing: -0.5px;">Bienvenido al <span class="text-sena-light">SGA</span></h3>
                <p class="text-muted small mb-0">Ingresa tus credenciales institucionales para continuar</p>
            </div>

            <!-- Alertas de Error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center rounded-3 p-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-exclamation fs-4 me-3 text-danger"></i>
                    <div class="small fw-medium" style="font-size: 0.8rem;"><?= $error; ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <!-- Formulario de Login -->
            <form action="<?= URLROOT; ?>/index.php?route=auth/login" method="POST" class="needs-validation" novalidate>
                <!-- Input Documento -->
                <div class="mb-3">
                    <div class="custom-input-group">
                        <i class="fa-regular fa-id-card input-icon"></i>
                        <input type="text" inputmode="numeric" maxlength="10" pattern="[0-9]{6,10}" class="custom-form-control" id="username" name="username" value="<?= htmlspecialchars($username ?? ''); ?>" placeholder="Documento de Identidad" required autofocus>
                    </div>
                    <div id="username-feedback" class="feedback-text text-muted mt-1 px-1">Ingresa tu documento (6-10 dígitos).</div>
                </div>

                <!-- Input Contraseña -->
                <div class="mb-4">
                    <div class="custom-input-group">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" class="custom-form-control" id="password" name="password" placeholder="Contraseña" required minlength="8" maxlength="30">
                        <button type="button" class="btn-toggle-password" id="togglePasswordBtn" tabindex="-1">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                    <div id="password-feedback" class="feedback-text text-muted mt-1 px-1" style="display: none; line-height: 1.4;"></div>
                </div>

                <!-- Opciones -->
                <div class="d-flex justify-content-between align-items-center mb-4" style="font-size: 0.78rem;">
                    <div class="form-check-custom">
                        <input type="checkbox" id="rememberMe" checked class="custom-checkbox">
                        <label class="custom-checkbox-label" for="rememberMe">Recordar mi equipo</label>
                    </div>
                    <a href="#" class="forgot-password-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">¿Olvidaste tu contraseña?</a>
                </div>

                <!-- Botón de Ingreso -->
                <div class="mb-4">
                    <button type="submit" class="btn-sena-submit">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar al Sistema
                    </button>
                </div>
            </form>

            <!-- Soporte -->
            <div class="support-help-container">
                <i class="fa-solid fa-headset support-icon"></i>
                <span class="support-text">¿Necesitas ayuda? <a href="#" class="support-link" onclick="alert('Soporte SENA: (+57) 601 3430111'); return false;">Contactar Soporte Técnico</a></span>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Recuperación de Contraseña -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.4);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg p-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-4">Ingresa tu correo electrónico registrado. Te enviaremos un enlace con las instrucciones para restablecer tu contraseña.</p>
                <form id="forgotPasswordForm" class="needs-validation" novalidate>
                    <div class="mb-4">
                        <div class="custom-input-group">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" class="custom-form-control" id="forgotEmail" name="correo" placeholder="Correo Electrónico Registrado" required>
                        </div>
                        <div id="forgotEmail-feedback" class="feedback-text text-muted mt-1 px-1">Ejemplo: usuario@sena.edu.co</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" id="btnSendRecovery" class="btn-sena-submit">
                            <i class="fa-solid fa-paper-plane"></i> Enviar Enlace de Recuperación
                        </button>
                    </div>
                </form>
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

// Control del Toggle de Contraseña
const togglePasswordBtn = document.getElementById('togglePasswordBtn');
const passwordInput = document.getElementById('password');
const togglePasswordIcon = document.getElementById('togglePasswordIcon');

if (togglePasswordBtn && passwordInput && togglePasswordIcon) {
    togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        if (type === 'text') {
            togglePasswordIcon.className = 'fa-regular fa-eye-slash';
        } else {
            togglePasswordIcon.className = 'fa-regular fa-eye';
        }
    });
}

// Validación en tiempo real para el documento
const usernameInput = document.getElementById('username');
const usernameFeedback = document.getElementById('username-feedback');

if (usernameInput) {
    usernameInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        const val = this.value;
        const minLength = 6;
        
        if (val.length === 0) {
            usernameFeedback.textContent = 'Ingresa tu documento (6-10 dígitos).';
            usernameFeedback.className = 'feedback-text text-muted mt-1 px-1';
            this.setCustomValidity("Campo requerido");
        } else if (val.length < minLength) {
            usernameFeedback.textContent = `Faltan ${minLength - val.length} dígitos como mínimo.`;
            usernameFeedback.className = 'feedback-text text-danger mt-1 px-1';
            this.setCustomValidity("Faltan dígitos");
        } else {
            usernameFeedback.textContent = `${val.length}/10 dígitos ingresados.`;
            usernameFeedback.className = 'feedback-text text-success mt-1 px-1';
            this.setCustomValidity("");
        }
    });
}

// Validación en tiempo real para la contraseña
const passwordFeedback = document.getElementById('password-feedback');

function validatePassword() {
    if (!passwordInput || !passwordFeedback) return;
    const val = passwordInput.value;
    let rulesFailed = [];
    
    if (val.length < 8 || val.length > 30) rulesFailed.push("Tener entre 8 y 30 caracteres.");
    if (!/^[A-Z]/.test(val)) rulesFailed.push("Iniciar con mayúscula.");
    if (!/[0-9]/.test(val)) rulesFailed.push("Contener al menos un número.");
    if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val)) rulesFailed.push("Contener un carácter especial.");
    
    if (val.length === 0) {
        passwordFeedback.innerHTML = "La contraseña debe tener 8 a 30 caracteres, iniciar con mayúscula, y tener al menos un número y un carácter especial.";
        passwordFeedback.className = 'feedback-text text-muted mt-1 px-1';
        passwordInput.setCustomValidity("Campo requerido");
    } else if (rulesFailed.length > 0) {
        passwordFeedback.innerHTML = "<span class='text-danger d-block mb-1'><i class='fa-solid fa-circle-xmark'></i> " + rulesFailed.join("</span><span class='text-danger d-block mb-1'><i class='fa-solid fa-circle-xmark'></i> ") + "</span>";
        passwordInput.setCustomValidity("Faltan requisitos en la contraseña");
    } else {
        passwordFeedback.innerHTML = "<span class='text-success'><i class='fa-solid fa-circle-check'></i> Contraseña válida y segura.</span>";
        passwordInput.setCustomValidity("");
    }
}

if (passwordInput && passwordFeedback) {
    passwordInput.addEventListener('focus', function() {
        passwordFeedback.style.display = 'block';
        validatePassword();
    });
    
    passwordInput.addEventListener('blur', function() {
        setTimeout(() => {
            passwordFeedback.style.display = 'none';
        }, 200);
    });
    
    passwordInput.addEventListener('input', validatePassword);
}

// Envío asíncrono para la recuperación de contraseña
const forgotPasswordForm = document.getElementById('forgotPasswordForm');
const forgotEmail = document.getElementById('forgotEmail');
const forgotEmailFeedback = document.getElementById('forgotEmail-feedback');

if (forgotPasswordForm && forgotEmail) {
    forgotPasswordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const val = forgotEmail.value.trim().toLowerCase();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (val === "" || !emailRegex.test(val)) {
            if (forgotEmailFeedback) {
                forgotEmailFeedback.textContent = "Por favor, ingresa un correo electrónico válido.";
                forgotEmailFeedback.className = "feedback-text text-danger mt-1 px-1";
            }
            return;
        }

        Swal.fire({
            title: 'Procesando solicitud...',
            text: 'Por favor espera un momento.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = new FormData();
        formData.append('correo', val);

        fetch('<?= URLROOT; ?>/index.php?route=auth/forgotPassword', {
            method: 'POST',
            body: formData
        })
        .then(res => {
            const contentType = res.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                return res.json();
            } else {
                return res.text().then(text => {
                    throw new Error("Respuesta no válida del servidor: " + text);
                });
            }
        })
        .then(data => {
            Swal.close();
            
            // Ocultar modal
            const modalEl = document.getElementById('forgotPasswordModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
            }
            
            // Mostrar SweetAlert2
            const swalOptions = {
                icon: 'success',
                title: 'Solicitud procesada',
                text: data.message || 'Si el correo está registrado, recibirás un enlace para recuperar tu contraseña.',
                confirmButtonColor: '#39A900'
            };

            if (data.reset_link) {
                swalOptions.html = `
                    <p class="mb-3">${data.message || 'Usa este enlace temporal para recuperar tu contraseña.'}</p>
                    <a href="${data.reset_link}" class="btn btn-success fw-bold" style="background:#39A900;border-color:#39A900;">
                        <i class="fa-solid fa-key me-2"></i>Abrir enlace temporal
                    </a>
                    <div class="small text-muted mt-3" style="word-break: break-all;">${data.reset_link}</div>
                `;
                delete swalOptions.text;
            }

            Swal.fire({
                ...swalOptions
            });

            // Limpiar input y feedback
            forgotEmail.value = "";
            if (forgotEmailFeedback) {
                forgotEmailFeedback.textContent = "Ejemplo: usuario@sena.edu.co";
                forgotEmailFeedback.className = "feedback-text text-muted mt-1 px-1";
            }
        })
        .catch(err => {
            Swal.close();
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Error de red / servidor',
                text: err.message || 'No se pudo establecer comunicación con el servidor.',
                confirmButtonColor: '#39A900'
            });
        });
    });
}
</script>

<?php if (isset($_SESSION['flash_success'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ocultar alertas estándar si existen
            document.querySelectorAll('.alert-dismissible').forEach(el => el.style.display = 'none');
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= htmlspecialchars($_SESSION['flash_success']); ?>',
                confirmButtonColor: '#39A900',
                timer: 4000
            });
        });
    </script>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ocultar alertas estándar si existen
            document.querySelectorAll('.alert-dismissible').forEach(el => el.style.display = 'none');
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: '<?= htmlspecialchars($_SESSION['flash_error']); ?>',
                confirmButtonColor: '#39A900'
            });
        });
    </script>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>
