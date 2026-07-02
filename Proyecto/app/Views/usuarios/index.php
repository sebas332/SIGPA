<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Administración de Usuarios y Roles</h3>
            <p class="text-muted small mb-0">Gestión de cuentas de acceso, perfiles académicos y niveles de privilegio</p>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn btn-primary shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
                <i class="fa-solid fa-user-plus me-2"></i> Nuevo Usuario
            </button>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase py-3">
                        <tr>
                            <th class="ps-4">Usuario</th>
                            <th>Nombre de Usuario / Login</th>
                            <th>Titulación</th>
                            <th>Contacto</th>
                            <th>Roles Asignados</th>
                            <?php if ($current_role === 'Coordinador'): ?>
                                <th class="text-end pe-4">Asignar Rol</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%;">
                                            <?= substr($u->nombre, 0, 1); ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark"><?= $u->nombre . ' ' . $u->apellido; ?></div>
                                            <span class="text-muted small"><?= $u->correo; ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1 fs-6">@<?= $u->usuario; ?></span>
                                </td>
                                <td><div class="text-secondary small fw-medium"><?= $u->titulacion; ?></div></td>
                                <td><span class="text-muted small"><i class="fa-solid fa-phone me-1 text-secondary"></i> <?= $u->telefono; ?></span></td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php 
                                        $misRoles = $rolesUsuario[$u->id_usuario] ?? [];
                                        foreach ($misRoles as $rol): 
                                            $badgeBg = 'bg-secondary';
                                            if ($rol->nombre_rol === 'Coordinador') $badgeBg = 'bg-danger';
                                            if ($rol->nombre_rol === 'Instructor') $badgeBg = 'bg-primary';
                                            if ($rol->nombre_rol === 'Aprendiz') $badgeBg = 'bg-success';
                                        ?>
                                            <span class="badge <?= $badgeBg; ?> px-3 py-1 shadow-sm"><?= $rol->nombre_rol; ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <?php if ($current_role === 'Coordinador'): ?>
                                    <td class="text-end pe-4">
                                        <form action="<?= URLROOT; ?>/index.php?route=usuarios/asignarRol" method="POST" class="d-flex align-items-center justify-content-end gap-2">
                                            <input type="hidden" name="id_usuario" value="<?= $u->id_usuario; ?>">
                                            <select class="form-select form-select-sm shadow-sm" name="id_rol" style="width: 130px;" required>
                                                <option value="">Añadir rol...</option>
                                                <?php foreach ($roles as $r): ?>
                                                    <option value="<?= $r->id_rol; ?>"><?= $r->nombre_rol; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-outline-success btn-sm shadow-sm" data-bs-toggle="tooltip" title="Asignar Rol">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Usuario -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearUsuarioLabel"><i class="fa-solid fa-user-shield me-2 text-primary"></i>Registrar Nuevo Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=usuarios/create" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium text-secondary">Nombres</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Carlos Arturo" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El nombre solo debe contener letras.">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label fw-medium text-secondary">Apellidos</label>
                            <input type="text" class="form-control form-control-lg" id="apellido" name="apellido" placeholder="Ej. Gómez" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El apellido solo debe contener letras.">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label fw-medium text-secondary">Teléfono de Contacto</label>
                            <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" placeholder="Ej. 3019876543" required inputmode="numeric" pattern="[0-9]{10}" maxlength="10" title="El teléfono debe tener exactamente 10 números.">
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label fw-medium text-secondary">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg" id="correo" name="correo" placeholder="Ej. correo@soy.sena.edu.co" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="El correo debe tener un formato válido (ejemplo@dominio.com).">
                        </div>
                        <div class="col-md-12">
                            <label for="titulacion" class="form-label fw-medium text-secondary">Titulación o Nivel Académico</label>
                            <input type="text" class="form-control form-control-lg" id="titulacion" name="titulacion" placeholder="Ej. Ingeniero de Sistemas o Bachiller" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="La titulación solo debe contener letras.">
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-md-4">
                            <label for="documento" class="form-label fw-medium text-secondary">Documento de Identidad (Login)</label>
                            <input type="text" inputmode="numeric" class="form-control form-control-lg" id="documento" name="documento" placeholder="Ej. 1020304050" required pattern="[0-9]{6,10}" maxlength="10" title="El documento debe contener solo números, entre 6 y 10 dígitos.">
                        </div>
                        <div class="col-md-4">
                            <label for="contrasena" class="form-label fw-medium text-secondary">Contraseña Inicial<span class="d-none d-md-inline"><br>&nbsp;</span></label>
                            <input type="text" class="form-control form-control-lg" id="contrasena" name="contrasena" placeholder="Ej. Pass123*" required pattern="(?=[A-ZÑÁÉÍÓÚ])(?=.*\d)(?=.*[!@#$%^&amp;*(),.?&quot;:{}|&lt;&gt;[\]\\/_\-+=~'`;]).{8,30}" title="La contraseña debe iniciar con mayúscula, tener de 8 a 30 caracteres, e incluir un número y un carácter especial.">
                        </div>
                        <div class="col-md-4">
                            <label for="id_rol" class="form-label fw-medium text-secondary">Rol Principal<span class="d-none d-md-inline"><br>&nbsp;</span></label>
                            <select class="form-select form-select-lg" id="id_rol" name="id_rol" required>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r->id_rol; ?>"><?= $r->nombre_rol; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn fw-bold shadow-sm" style="background-color: #39A900; color: white; padding: 0.6rem 1.4rem; border-radius: 25px; border: 0;" onmouseover="this.style.backgroundColor='#007832'" onmouseout="this.style.backgroundColor='#39A900'"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
// Validaciones para formularios de usuarios (Crear)
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form[action*='usuarios/create']");
    forms.forEach(function (form) {
        // Restringir entrada a letras y espacios en tiempo real
        const textFields = form.querySelectorAll("input[name='nombre'], input[name='apellido'], input[name='titulacion']");
        textFields.forEach(input => {
            input.addEventListener("input", function() {
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });
        });

        // Restringir entrada a números en tiempo real
        const numericFields = form.querySelectorAll("input[name='telefono'], input[name='documento']");
        numericFields.forEach(input => {
            input.addEventListener("input", function() {
                this.value = this.value.replace(/\D/g, '');
            });
        });

        // Restringir y truncar el campo de correo en tiempo real
        const emailFields = form.querySelectorAll("input[type='email']");
        emailFields.forEach(input => {
            input.addEventListener("input", function() {
                const val = this.value;
                const atIndex = val.indexOf('@');
                if (atIndex !== -1) {
                    const afterAt = val.substring(atIndex + 1);
                    const comMatch = afterAt.match(/\.(com|co)/i);
                    if (comMatch) {
                        const suffixIndex = atIndex + 1 + comMatch.index + comMatch[0].length;
                        if (val.length > suffixIndex) {
                            this.value = val.substring(0, suffixIndex);
                        }
                    }
                }
            });
        });

        // Obtener campos relevantes
        const inputs = form.querySelectorAll("input[name='nombre'], input[name='apellido'], input[name='telefono'], input[type='email'], input[name='titulacion'], input[name='documento'], input[name='contrasena']");
        
        inputs.forEach(input => {
            // Contenedor para mensajes de validación personalizados
            const container = document.createElement("div");
            container.className = "validation-feedback-container mt-1";
            
            const errorMsg = document.createElement("div");
            errorMsg.className = "validation-feedback text-danger small fw-semibold";
            errorMsg.style.cssText = "display: none; font-size: 0.78rem; margin-top: 3px;";
            
            const successMsg = document.createElement("div");
            successMsg.className = "validation-feedback text-success small fw-semibold";
            successMsg.style.cssText = "display: none; font-size: 0.78rem; margin-top: 3px;";
            
            container.appendChild(errorMsg);
            container.appendChild(successMsg);
            input.parentNode.appendChild(container);

            function updateFeedback(isValid, text) {
                if (isValid) {
                    errorMsg.style.display = "none";
                    successMsg.style.display = "none";
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                    input.setCustomValidity("");
                } else {
                    successMsg.style.display = "none";
                    errorMsg.textContent = "❌ " + text;
                    errorMsg.style.display = "block";
                    input.classList.remove("is-valid");
                    input.classList.add("is-invalid");
                    input.setCustomValidity(text);
                }
            }

            function clearFeedback() {
                errorMsg.style.display = "none";
                successMsg.style.display = "none";
                input.classList.remove("is-valid", "is-invalid");
                input.setCustomValidity("");
            }

            function validate() {
                const val = input.value;
                const name = input.name;
                const type = input.type;

                if (val === "") {
                    updateFeedback(false, "Este campo es requerido.");
                    return;
                }

                if (name === "nombre" || name === "apellido") {
                    if (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(val)) {
                        updateFeedback(true, "Formato de " + (name === "nombre" ? "nombre" : "apellido") + " válido.");
                    } else {
                        updateFeedback(false, "Solo debe contener letras.");
                    }
                }
                else if (name === "telefono") {
                    if (/^\d{10}$/.test(val)) {
                        updateFeedback(true, "Número de teléfono válido.");
                    } else {
                        updateFeedback(false, "Debe contener exactamente 10 números (actual: " + val.length + ").");
                    }
                }
                else if (type === "email") {
                    // Validaciones específicas para el correo
                    if (!val.includes('@')) {
                        updateFeedback(false, "Debe incluir el carácter '@'.");
                        return;
                    }
                    
                    const atIndex = val.indexOf('@');
                    const afterAt = val.substring(atIndex + 1);
                    
                    if (afterAt === "" || !/^[a-zA-Z]/.test(afterAt)) {
                        updateFeedback(false, "Debe haber letras después de el '@'.");
                        return;
                    }
                    
                    const dotIndex = afterAt.indexOf('.');
                    if (dotIndex === -1) {
                        updateFeedback(false, "Debe incluir un punto '.' después del dominio.");
                        return;
                    }
                    
                    const afterDot = afterAt.substring(dotIndex + 1);
                    if (afterDot.toLowerCase() !== "com" && afterDot.toLowerCase() !== "co") {
                        updateFeedback(false, "Solo se permite '.com' o '.co' al final.");
                        return;
                    }
                    
                    updateFeedback(true, "Correo electrónico válido.");
                }
                else if (name === "titulacion") {
                    if (/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(val)) {
                        updateFeedback(true, "Formato de titulación válido.");
                    } else {
                        updateFeedback(false, "Solo debe contener letras.");
                    }
                }
                else if (name === "documento") {
                    if (/^\d{6,10}$/.test(val)) {
                        updateFeedback(true, "Número de documento válido.");
                    } else {
                        if (val.length < 6) {
                            updateFeedback(false, "Debe contener mínimo 6 dígitos (actual: " + val.length + ").");
                        } else if (val.length > 10) {
                            updateFeedback(false, "Debe contener máximo 10 dígitos (actual: " + val.length + ").");
                        } else {
                            updateFeedback(false, "Solo debe contener números.");
                        }
                    }
                }
                else if (name === "contrasena") {
                    if (val.length < 8 || val.length > 30) {
                        updateFeedback(false, "La contraseña debe tener entre 8 y 30 caracteres (actual: " + val.length + ").");
                        return;
                    }
                    if (!/^[A-ZÑÁÉÍÓÚ]/.test(val)) {
                        updateFeedback(false, "La primera letra debe ser mayúscula.");
                        return;
                    }
                    if (!/\d/.test(val)) {
                        updateFeedback(false, "Debe contener al menos un número.");
                        return;
                    }
                    if (!/[!@#$%^&*(),.?":{}|<>[\]\\/_\-+=~`';]/.test(val)) {
                        updateFeedback(false, "Debe contener al menos un carácter especial.");
                        return;
                    }
                    updateFeedback(true, "Contraseña segura y válida.");
                }
            }

            input.addEventListener("input", validate);
            input.addEventListener("focus", validate);
            input.addEventListener("blur", validate);
        });

        form.addEventListener("submit", function (e) {
            let formValid = true;
            inputs.forEach(input => {
                // Forzar validación al enviar
                input.focus();
                input.blur();
                if (!input.checkValidity()) {
                    formValid = false;
                }
            });
            if (!formValid) {
                e.preventDefault();
            }
        });
    });
});
</script>
