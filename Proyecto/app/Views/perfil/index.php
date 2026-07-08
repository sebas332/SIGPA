<div class="profile-page mx-auto">
    <nav class="profile-breadcrumb-row" aria-label="breadcrumb">
        <a href="<?= URLROOT; ?>/index.php?route=dashboard/index" class="profile-breadcrumb-home">
            <i class="fa-solid fa-house"></i>
            <span>Inicio</span>
        </a>
        <span class="profile-breadcrumb-separator">/</span>
        <span class="profile-breadcrumb-current">Mi perfil</span>
    </nav>

    <section class="profile-cover">
        <div class="cover-pattern"></div>

        <div class="profile-identity">
            <div class="profile-photo-container">
                <div class="position-relative w-100 h-100">
                    <?php if ($fotoPerfil): ?>
                        <img id="profilePreview" src="<?= htmlspecialchars($fotoPerfil); ?>" alt="Fotografía de perfil">
                    <?php else: ?>
                        <img id="profilePreview" src="https://ui-avatars.com/api/?name=<?= urlencode($usuario->nombre . ' ' . $usuario->apellido); ?>&background=065F46&color=fff&size=256&bold=true" alt="Fotografía de perfil">
                    <?php endif; ?>
                    <button type="button" class="profile-photo-action border-0" onclick="document.getElementById('foto').click()" title="Cambiar fotografía">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                </div>
            </div>

            <div class="profile-title-area">
                <div class="profile-name-row">
                    <h3><?= htmlspecialchars($usuario->nombre . ' ' . $usuario->apellido); ?></h3>
                    <span class="profile-role-chip">
                        <i class="fa-solid fa-crown"></i>
                        <?= htmlspecialchars($current_role); ?>
                    </span>
                </div>
                <div class="profile-meta-line">
                    <span><i class="fa-regular fa-envelope"></i><?= htmlspecialchars($usuario->correo); ?></span>
                    <?php if ($usuario->titulacion): ?>
                        <span><i class="fa-solid fa-briefcase"></i><?= htmlspecialchars($usuario->titulacion); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="profile-hero-side">
            <div class="institutional-info">
                <div class="profile-stat">
                    <span class="profile-stat-icon"><i class="fa-regular fa-building"></i></span>
                    <span>
                        <span class="info-label">ROL INSTITUCIONAL</span>
                        <span class="info-value"><?= htmlspecialchars($current_role); ?></span>
                    </span>
                </div>
                <div class="profile-stat">
                    <span class="profile-stat-icon"><i class="fa-regular fa-user"></i></span>
                    <span>
                        <span class="info-label">ID USUARIO</span>
                        <span class="info-value">#<?= htmlspecialchars($usuario->id_usuario); ?></span>
                    </span>
                </div>
            </div>
            <button type="button" class="profile-upload-btn" onclick="document.getElementById('foto').click()">
                <i class="fa-solid fa-upload"></i>
                Subir foto
            </button>
        </div>
    </section>

    <div class="profile-tabs-wrap">
        <ul class="nav nav-pills custom-profile-tabs gap-2" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-tab" data-bs-toggle="pill" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                    <i class="fa-regular fa-user"></i>Información Personal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">
                    <i class="fa-solid fa-shield-halved"></i>Seguridad y Acceso
                </button>
            </li>
        </ul>
    </div>

    <!-- Forms Container (Single Form for absolute compatibility) -->
    <form action="<?= URLROOT; ?>/index.php?route=perfil/update" method="POST" enctype="multipart/form-data" id="profileForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
        <!-- Hidden actual file input -->
        <input type="file" class="d-none" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">

        <div class="tab-content" id="profileTabsContent">
            <!-- TAB 1: Información Personal -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <div class="profile-form-card">
                    <div class="profile-section-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon-box">
                                <i class="fa-regular fa-id-card"></i>
                            </div>
                            <div>
                                <h4>Datos identificativos e institucionales</h4>
                                <p>Modifica tu información registrada en la base de datos de gestión académica del centro.</p>
                            </div>
                        </div>
                        <button type="submit" id="btnSavePersonal" class="btn btn-save-custom d-inline-flex align-items-center gap-2">
                            <i class="fa-regular fa-floppy-disk" style="font-size: 0.95rem;"></i> Guardar Cambios Académicos
                        </button>
                    </div>

                    <div class="row g-4 profile-field-grid">
                        <div class="col-md-6">
                            <label class="form-label-custom">NOMBRES</label>
                            <div class="input-group-custom">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" name="nombre" id="nombre" class="form-control-custom" value="<?= htmlspecialchars($usuario->nombre); ?>" required maxlength="100">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-nombre"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">APELLIDOS</label>
                            <div class="input-group-custom">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" name="apellido" id="apellido" class="form-control-custom" value="<?= htmlspecialchars($usuario->apellido); ?>" required maxlength="100">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-apellido"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">CORREO ELECTRÓNICO</label>
                            <div class="input-group-custom">
                                <i class="fa-regular fa-envelope input-icon"></i>
                                <input type="email" name="correo" id="correo" class="form-control-custom" value="<?= htmlspecialchars($usuario->correo); ?>" required maxlength="150">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-correo"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label-custom mb-0">TELÉFONO MÓVIL</label>
                                <span id="phone-counter" class="text-muted" style="font-size: 0.7rem; font-weight: 600;">10/10</span>
                            </div>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-phone input-icon"></i>
                                <input type="tel" name="telefono" id="telefono" class="form-control-custom" value="<?= htmlspecialchars($usuario->telefono); ?>" required maxlength="10">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-telefono"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">TITULACIÓN O PROFESIÓN</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-graduation-cap input-icon"></i>
                                <input type="text" name="titulacion" id="titulacion" class="form-control-custom" value="<?= htmlspecialchars($usuario->titulacion); ?>" required maxlength="100">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-titulacion"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">DOCUMENTO DE IDENTIDAD (BLOQUEADO)</label>
                            <div class="input-group-custom disabled-group" style="cursor: not-allowed;" onclick="Swal.fire({ icon: 'info', title: 'Campo Bloqueado', text: 'Por seguridad, el documento de identidad solo puede ser modificado por un administrador de la sede.', confirmButtonColor: '#00A356' })">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="text" class="form-control-custom" value="<?= htmlspecialchars($usuario->documento ?? ''); ?>" disabled style="cursor: not-allowed;">
                            </div>
                            <span class="form-text text-muted mt-1 d-block" style="font-size: 0.72rem; padding-left: 0.25rem;">
                                Por seguridad, el cambio de identificación requiere aprobación de administración de sede.
                            </span>
                        </div>
                    </div>

                    <!-- Ley 1581 Info Panel -->
                    <div class="data-protection-panel d-flex align-items-center justify-content-between p-3 mt-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="protection-icon-box">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.88rem;">Tu información está segura</h6>
                                <p class="mb-0 text-muted" style="font-size: 0.78rem;">SENA protege tus datos personales según la Ley 1581 de 2012 de protección de datos.</p>
                            </div>
                        </div>
                        <div class="protection-badge-box d-none d-sm-block">
                            <i class="fa-solid fa-shield-halved" style="color: #00A356; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Seguridad y Acceso -->
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <div class="profile-form-card">
                    <div class="profile-section-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="card-header-icon-box">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h4>Actualizar credencial de acceso</h4>
                                <p>Configura una contraseña segura y robusta para tu cuenta de SIGPA.</p>
                            </div>
                        </div>
                        <button type="submit" id="btnSaveSecurity" class="btn btn-save-custom d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-lock" style="font-size: 0.95rem;"></i> Cambiar Contraseña Segura
                        </button>
                    </div>

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label-custom">CONTRASEÑA ACTUAL</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-key input-icon"></i>
                                <input type="password" name="contrasena_actual" id="contrasena_actual" class="form-control-custom" placeholder="Ingresa tu contraseña actual">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-contrasena_actual"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">NUEVA CONTRASEÑA</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-key input-icon"></i>
                                <input type="password" name="contrasena" id="new_password" class="form-control-custom" placeholder="Mínimo 8 caracteres (A-Z, a-z, 0-9, especial)" minlength="8">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-new_password"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">CONFIRMAR NUEVA CONTRASEÑA</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-key input-icon"></i>
                                <input type="password" name="contrasena_confirm" id="confirm_password" class="form-control-custom" placeholder="Vuelve a escribir la nueva contraseña">
                                <span class="validation-status-icon"></span>
                            </div>
                            <div class="invalid-feedback-custom" id="error-confirm_password"></div>
                        </div>
                    </div>

                    <!-- Ley 1581 Info Panel -->
                    <div class="data-protection-panel d-flex align-items-center justify-content-between p-3 mt-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="protection-icon-box">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.88rem;">Tu información está segura</h6>
                                <p class="mb-0 text-muted" style="font-size: 0.78rem;">SENA protege tus datos personales según la Ley 1581 de 2012 de protección de datos.</p>
                            </div>
                        </div>
                        <div class="protection-badge-box d-none d-sm-block">
                            <i class="fa-solid fa-shield-halved" style="color: #00A356; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.profile-page {
    max-width: 1220px;
    padding: 1.4rem;
    padding-bottom: 2rem;
    background: #ffffff;
    border: 1px solid rgba(15, 23, 42, 0.06);
    border-radius: 16px;
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
}

.profile-breadcrumb-row {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0.2rem 0.65rem 1.35rem;
    color: #6b7280;
    font-size: 0.92rem;
    font-weight: 600;
}

.profile-breadcrumb-home {
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    color: #4b5563;
    text-decoration: none;
}

.profile-breadcrumb-home:hover {
    color: #008747;
}

.profile-breadcrumb-separator {
    color: #9ca3af;
}

.profile-breadcrumb-current {
    color: #008747;
    font-weight: 800;
}

.profile-cover {
    min-height: 178px;
    background:
        radial-gradient(circle at 64% 50%, rgba(57, 169, 0, 0.22), transparent 35%),
        linear-gradient(135deg, #064e3b 0%, #065f46 100%);
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    padding: 1.85rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    color: #ffffff;
    box-shadow: 0 14px 36px rgba(6, 78, 59, 0.18);
}

.cover-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.12;
    background-image:
        radial-gradient(circle at 78% 25%, rgba(255,255,255,0.35) 1px, transparent 1px),
        repeating-radial-gradient(circle at 58% 52%, transparent 0 10px, rgba(255,255,255,0.08) 11px 12px);
    background-size: 18px 18px, 760px 500px;
    pointer-events: none;
}

.profile-cover > *:not(.cover-pattern) {
    position: relative;
    z-index: 1;
}

.profile-identity {
    display: flex;
    align-items: center;
    gap: 2rem;
    min-width: 0;
}

.profile-photo-container {
    width: 118px;
    height: 118px;
    flex: 0 0 auto;
}

.profile-photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 4px solid #ffffff;
    border-radius: 50%;
    box-shadow: 0 10px 26px rgba(0, 0, 0, 0.16);
}

.profile-photo-action {
    position: absolute;
    right: -2px;
    bottom: 10px;
    display: grid;
    width: 34px;
    height: 34px;
    place-items: center;
    border-radius: 50%;
    background: #00A356;
    color: #ffffff;
    font-size: 0.9rem;
    cursor: pointer;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.16);
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.profile-photo-action:hover {
    transform: scale(1.08);
    background-color: #008747;
}

.profile-title-area {
    min-width: 0;
}

.profile-name-row {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    flex-wrap: wrap;
    margin-bottom: 1.35rem;
}

.profile-name-row h3 {
    margin: 0;
    color: #ffffff;
    font-size: clamp(1.55rem, 2.8vw, 2.15rem);
    font-weight: 850;
    letter-spacing: 0;
}

.profile-role-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    min-height: 28px;
    padding: 0.25rem 0.7rem;
    border-radius: 8px;
    background: rgba(0, 163, 86, 0.72);
    color: #ffffff;
    font-size: 0.74rem;
    font-weight: 850;
    text-transform: uppercase;
    letter-spacing: 0.35px;
}

.profile-meta-line {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    font-weight: 600;
}

.profile-meta-line span {
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
}

.profile-hero-side {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1.45rem;
    min-width: 350px;
}

.institutional-info {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1.4rem;
}

.profile-stat {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding-left: 1.4rem;
    border-left: 1px solid rgba(255, 255, 255, 0.18);
}

.profile-stat:first-child {
    border-left: 0;
    padding-left: 0;
}

.profile-stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: rgba(255, 255, 255, 0.13);
    color: #ffffff;
    font-size: 1rem;
}

.info-label {
    display: block;
    font-size: 0.68rem;
    letter-spacing: 0.7px;
    color: rgba(255, 255, 255, 0.82);
    font-weight: 850;
}

.info-value {
    font-size: 1rem;
    font-weight: 800;
    color: #ffffff;
    margin-top: 0.2rem;
    display: block;
}

.profile-upload-btn {
    border: 0;
    min-height: 42px;
    padding: 0 1.3rem;
    border-radius: 999px;
    background: #ffffff;
    color: #07823d;
    box-shadow: 0 10px 18px rgba(0, 0, 0, 0.14);
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    font-weight: 800;
    font-size: 0.86rem;
}

.profile-upload-btn:hover {
    background: #ecfdf3;
}

.profile-tabs-wrap {
    margin-top: 1.4rem;
    border-bottom: 1px solid #e5e7eb;
}

.custom-profile-tabs .nav-link {
    background: #ffffff;
    color: #536179;
    font-size: 0.92rem;
    font-weight: 750;
    padding: 0.9rem 1.55rem;
    border-radius: 10px 10px 0 0;
    border: 1px solid transparent;
    border-bottom: 0;
    transition: color 0.2s ease, background 0.2s ease, border-color 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    position: relative;
}

.custom-profile-tabs .nav-link:hover {
    color: #008747;
    background-color: #f8fafc;
}

.custom-profile-tabs .nav-link.active {
    color: #008747 !important;
    background-color: #ffffff !important;
    border-color: #e5e7eb;
}

.custom-profile-tabs .nav-link.active::after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 1.25rem;
    right: 1.25rem;
    height: 3px;
    background-color: #00A356;
    border-radius: 999px 999px 0 0;
}

.profile-form-card {
    margin-top: 1.7rem;
    background: #ffffff;
    border: 1px solid rgba(15, 23, 42, 0.08);
    border-radius: 12px;
    padding: 1.9rem;
    box-shadow: 0 12px 32px rgba(15, 23, 42, 0.05);
}

.profile-section-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.9rem;
}

.profile-section-header h4 {
    margin: 0 0 0.35rem;
    color: #111827;
    font-size: 1.12rem;
    font-weight: 850;
    letter-spacing: 0;
}

.profile-section-header p {
    margin: 0;
    color: #64748b;
    font-size: 0.88rem;
}

.profile-field-grid {
    margin-top: 0.3rem;
}

/* 5. Header Icons in Form Cards */
.card-header-icon-box {
    width: 44px;
    height: 44px;
    display: grid;
    place-items: center;
    background-color: rgba(0, 163, 86, 0.08);
    color: #00A356;
    border-radius: 12px;
    font-size: 1.35rem;
}

/* 6. Form Fields Styling */
.form-label-custom {
    display: block;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #00A356;
    margin-bottom: 0.5rem;
}

.input-group-custom {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}

.input-group-custom .input-icon {
    position: absolute;
    left: 1rem;
    color: #94a3b8;
    font-size: 0.95rem;
    pointer-events: none;
}

.form-control-custom {
    width: 100%;
    height: 52px;
    padding: 0.375rem 2.5rem 0.375rem 2.75rem;
    font-size: 0.92rem;
    font-weight: 500;
    color: #1e293b;
    background-color: #f8fafc;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
}

.form-control-custom:focus {
    outline: none;
    background-color: #ffffff;
    border-color: #00A356;
    box-shadow: 0 0 0 4px rgba(57, 169, 0, 0.1);
}

.disabled-group .form-control-custom {
    background-color: #f8fafc;
    opacity: 0.85;
    color: #64748b;
    border-color: rgba(0, 0, 0, 0.06);
    cursor: not-allowed;
    padding-right: 1rem;
}

/* 7. Save Changes Button Styling */
.btn-save-custom {
    background-color: #00A356 !important;
    border-color: #00A356 !important;
    color: #ffffff !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    padding: 0.65rem 1.5rem !important;
    font-size: 0.9rem !important;
    box-shadow: 0 4px 12px rgba(0, 163, 86, 0.15) !important;
    transition: all 0.2s ease !important;
}

.btn-save-custom:hover {
    background-color: #008747 !important;
    border-color: #008747 !important;
    box-shadow: 0 6px 18px rgba(0, 163, 86, 0.25) !important;
    transform: translateY(-1px) !important;
}

/* 8. Data Protection Panel */
.data-protection-panel {
    background-color: rgba(0, 163, 86, 0.04);
    border: 1px solid rgba(0, 163, 86, 0.15);
    border-radius: 12px;
}

.protection-icon-box {
    width: 36px;
    height: 36px;
    display: grid;
    place-items: center;
    background-color: #ffffff;
    color: #00A356;
    border-radius: 50%;
    border: 1px solid rgba(0, 163, 86, 0.15);
    font-size: 0.95rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
}

/* Status Validation Icons */
.validation-status-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.95rem;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease, color 0.2s ease;
}

/* Invalid Feedback */
.invalid-feedback-custom {
    display: block;
    font-size: 0.76rem;
    font-weight: 600;
    color: #DC3545;
    margin-top: 0;
    padding-left: 0.25rem;
    height: 0;
    opacity: 0;
    overflow: hidden;
    transition: height 0.2s ease, opacity 0.2s ease, margin-top 0.2s ease;
}
.invalid-feedback-custom.show {
    height: auto;
    opacity: 1;
    margin-top: 0.35rem;
}

/* Responsive tweaks */
@media (max-width: 767px) {
    .profile-page {
        padding: 1rem;
        border-radius: 12px;
    }

    .profile-breadcrumb-row {
        padding-inline: 0.25rem;
    }

    .profile-cover {
        min-height: 0;
        padding: 1.35rem;
        align-items: flex-start;
        flex-direction: column;
    }

    .profile-identity {
        align-items: flex-start;
        gap: 1rem;
        flex-direction: column;
    }

    .profile-photo-container {
        width: 100px;
        height: 100px;
    }

    .profile-title-area,
    .profile-name-row {
        width: 100%;
    }

    .profile-meta-line {
        gap: 0.8rem;
        flex-direction: column;
        align-items: flex-start;
    }

    .profile-hero-side {
        align-items: stretch;
        min-width: 0;
        width: 100%;
    }

    .institutional-info {
        justify-content: flex-start;
        align-items: flex-start;
        flex-direction: column;
        gap: 0.85rem;
    }

    .profile-stat,
    .profile-stat:first-child {
        border-left: 0;
        padding-left: 0;
    }

    .profile-upload-btn {
        justify-content: center;
        width: 100%;
    }

    .profile-section-header {
        flex-direction: column;
    }

    .profile-section-header .btn-save-custom {
        width: 100%;
        justify-content: center;
    }

    .profile-form-card {
        padding: 1.25rem;
    }

    .custom-profile-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 0;
    }

    .custom-profile-tabs .nav-link {
        white-space: nowrap;
    }
}
</style>

<!-- SweetAlert2 Redirection Observers -->
<?php if (isset($_SESSION['flash_success'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: '<?= htmlspecialchars($_SESSION['flash_success']); ?>',
                confirmButtonColor: '#00A356',
                timer: 3000
            });
        });
    </script>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: '<?= htmlspecialchars($_SESSION['flash_error']); ?>',
                confirmButtonColor: '#00A356'
            });
        });
    </script>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Hide standard bootstrap alerts if they occur
    document.querySelectorAll('.alert-dismissible').forEach(el => el.style.display = 'none');

    // 1. Image Preview & Validation & AJAX Upload
    const fotoInput = document.getElementById('foto');
    if (fotoInput) {
        fotoInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) return;

            // Validar extensión/tipo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no permitido',
                    text: 'Solo se permiten imágenes en formato JPG, JPEG, PNG o WEBP.',
                    confirmButtonColor: '#00A356'
                });
                this.value = '';
                return;
            }

            // Validar tamaño (máximo 5 MB)
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Imagen muy grande',
                    text: 'La fotografía no puede superar los 5 MB.',
                    confirmButtonColor: '#00A356'
                });
                this.value = '';
                return;
            }

            // Crear objeto URL temporal para la previsualización
            const objectUrl = URL.createObjectURL(file);

            // Confirmar y subir mediante SweetAlert2
            Swal.fire({
                title: '¿Confirmar nueva foto de perfil?',
                text: '¿Deseas guardar esta imagen como tu nueva foto de perfil?',
                imageUrl: objectUrl,
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: 'Vista previa de la foto',
                showCancelButton: true,
                confirmButtonColor: '#00A356',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Subir vía AJAX
                    const formData = new FormData();
                    formData.append('foto', file);

                    Swal.fire({
                        title: 'Subiendo fotografía...',
                        text: 'Por favor espera un momento.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('<?= URLROOT; ?>/index.php?route=perfil/uploadFotoAjax', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Actualizar la foto en toda la interfaz en tiempo real
                            document.querySelectorAll('.sga-sidebar-avatar-img, .sga-topbar-avatar-img, #profilePreview, .banner-welcome-avatar-img').forEach(img => {
                                img.src = data.newUrl;
                            });

                            Swal.fire({
                                icon: 'success',
                                title: '¡Guardada!',
                                text: 'Tu foto de perfil se ha actualizado correctamente.',
                                confirmButtonColor: '#00A356',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al subir',
                                text: data.message || 'Hubo un error procesando tu imagen en el servidor.',
                                confirmButtonColor: '#00A356'
                            });
                        }
                        fotoInput.value = '';
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de red',
                            text: 'No se pudo establecer comunicación con el servidor.',
                            confirmButtonColor: '#00A356'
                        });
                        fotoInput.value = '';
                    });
                } else {
                    // Limpiar el input si cancela
                    fotoInput.value = '';
                }
            });
        });
    }

    // 2. Real-time form validation mapping
    const inputs = {
        nombre: document.getElementById('nombre'),
        apellido: document.getElementById('apellido'),
        correo: document.getElementById('correo'),
        telefono: document.getElementById('telefono'),
        titulacion: document.getElementById('titulacion')
    };

    const initialValues = {
        nombre: inputs.nombre ? inputs.nombre.value : '',
        apellido: inputs.apellido ? inputs.apellido.value : '',
        correo: inputs.correo ? inputs.correo.value : '',
        telefono: inputs.telefono ? inputs.telefono.value : '',
        titulacion: inputs.titulacion ? inputs.titulacion.value : ''
    };

    const validationStates = {
        nombre: true,
        apellido: true,
        correo: true,
        telefono: true,
        titulacion: true
    };

    function validateField(input, showUI = true) {
        if (!input) return;
        const id = input.id;
        const val = input.value;
        let isValid = false;
        let errorMsg = "";

        if (id === 'nombre' || id === 'apellido') {
            const trimmed = val.trim();
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]{2,50}$/;
            if (trimmed === "") {
                errorMsg = "Este campo es obligatorio.";
            } else if (!regex.test(trimmed)) {
                errorMsg = "Permite únicamente letras, tildes y espacios (entre 2 y 50 caracteres).";
            } else {
                isValid = true;
            }
        } else if (id === 'correo') {
            const cleaned = val.replace(/\s+/g, '').toLowerCase();
            if (input.value !== cleaned) {
                input.value = cleaned;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (cleaned === "") {
                errorMsg = "El correo electrónico es obligatorio.";
            } else if (!emailRegex.test(cleaned)) {
                errorMsg = "Formato de correo electrónico no válido.";
            } else {
                isValid = true;
            }
        } else if (id === 'telefono') {
            const cleaned = val.replace(/[^0-9]/g, '');
            if (input.value !== cleaned) {
                input.value = cleaned;
            }
            const counter = document.getElementById('phone-counter');
            if (counter) {
                counter.textContent = `${cleaned.length}/10`;
                counter.style.color = (cleaned.length === 10) ? '#39A900' : '#64748b';
            }
            if (cleaned === "") {
                errorMsg = "El teléfono móvil es obligatorio.";
            } else if (cleaned.length !== 10) {
                errorMsg = "Debe tener exactamente 10 dígitos numéricos.";
            } else {
                isValid = true;
            }
        } else if (id === 'titulacion') {
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s\.\-]{1,80}$/;
            if (val.trim() === "") {
                errorMsg = "La titulación o profesión es obligatoria.";
            } else if (!regex.test(val)) {
                errorMsg = "Permite únicamente letras, espacios, puntos y guiones (máx. 80 caracteres).";
            } else {
                isValid = true;
            }
        }

        validationStates[id] = isValid;

        if (showUI) {
            updateUIState(input, isValid, errorMsg);
        }

        // Handle AJAX check for email separately when locally valid
        if (id === 'correo') {
            const cleaned = val.replace(/\s+/g, '').toLowerCase();
            const group = input.closest('.input-group-custom');
            const statusIcon = group ? group.querySelector('.validation-status-icon') : null;

            if (isValid) {
                if (cleaned === initialValues.correo) {
                    validationStates.correo = true;
                    if (showUI) updateUIState(input, true, "");
                    checkFormValidity();
                } else {
                    validationStates.correo = false;
                    checkFormValidity();

                    if (statusIcon && showUI) {
                        statusIcon.className = "validation-status-icon fa-solid fa-circle-notch fa-spin";
                        statusIcon.style.color = "#00A356";
                        statusIcon.style.opacity = "1";
                    }

                    fetch(`<?= URLROOT; ?>/index.php?route=perfil/checkEmailAjax&email=${encodeURIComponent(cleaned)}`)
                        .then(res => {
                            if (!res.ok) throw new Error("Error de red.");
                            return res.json();
                        })
                        .then(data => {
                            if (data.valid) {
                                validationStates.correo = true;
                                if (showUI) updateUIState(input, true, "");
                            } else {
                                validationStates.correo = false;
                                if (showUI) updateUIState(input, false, data.message);
                            }
                            checkFormValidity();
                        })
                        .catch(err => {
                            console.error(err);
                            validationStates.correo = false;
                            if (showUI) updateUIState(input, false, "Error al verificar el correo.");
                            checkFormValidity();
                        });
                }
            } else {
                validationStates.correo = false;
                if (showUI) updateUIState(input, false, errorMsg);
                checkFormValidity();
            }
        } else {
            checkFormValidity();
        }
    }

    function updateUIState(input, isValid, errorMsg) {
        const id = input.id;
        const group = input.closest('.input-group-custom');
        const statusIcon = group ? group.querySelector('.validation-status-icon') : null;
        const errorDiv = document.getElementById(`error-${id}`);

        if (isValid) {
            input.style.borderColor = "#39A900";
            input.style.boxShadow = "0 0 0 4px rgba(57, 169, 0, 0.1)";
            input.style.backgroundColor = "#ffffff";
            if (statusIcon) {
                statusIcon.className = "validation-status-icon fa-solid fa-circle-check";
                statusIcon.style.color = "#39A900";
                statusIcon.style.opacity = "1";
            }
            if (errorDiv) {
                errorDiv.classList.remove('show');
                setTimeout(() => {
                    if (!errorDiv.classList.contains('show')) {
                        errorDiv.textContent = "";
                    }
                }, 200);
            }
        } else {
            input.style.borderColor = "#DC3545";
            input.style.boxShadow = "0 0 0 4px rgba(220, 53, 69, 0.1)";
            input.style.backgroundColor = "#ffffff";
            if (statusIcon) {
                statusIcon.className = "validation-status-icon fa-solid fa-circle-exclamation";
                statusIcon.style.color = "#DC3545";
                statusIcon.style.opacity = "1";
            }
            if (errorDiv) {
                errorDiv.textContent = errorMsg;
                errorDiv.classList.add('show');
            }
        }
    }

    function checkFormValidity() {
        const btn = document.getElementById('btnSavePersonal');
        if (!btn) return;

        const hasChanges = Object.keys(inputs).some(key => {
            return inputs[key] && inputs[key].value !== initialValues[key];
        });

        const allValid = Object.values(validationStates).every(state => state === true);

        if (hasChanges && allValid) {
            btn.disabled = false;
            btn.style.opacity = "1";
            btn.style.cursor = "pointer";
        } else {
            btn.disabled = true;
            btn.style.opacity = "0.65";
            btn.style.cursor = "not-allowed";
        }
    }

    // Bind real-time input and blur events
    Object.values(inputs).forEach(input => {
        if (!input) return;

        input.addEventListener('input', function () {
            if (input.id === 'telefono') {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
            validateField(input, true);
        });

        input.addEventListener('blur', function () {
            if (input.id === 'nombre' || input.id === 'apellido') {
                input.value = input.value.trim();
            }
            validateField(input, true);
        });
    });

    // Run initial validation silently on page load to set states
    Object.values(inputs).forEach(input => {
        if (input) validateField(input, false);
    });

    // Prevent default form submit (enter key, etc.)
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    }

    // Submit handler for Personal Information
    const btnSavePersonal = document.getElementById('btnSavePersonal');
    if (btnSavePersonal) {
        btnSavePersonal.addEventListener('click', function(e) {
            e.preventDefault();

            const changedFields = {};
            let hasChanges = false;
            Object.keys(inputs).forEach(key => {
                if (inputs[key] && inputs[key].value !== initialValues[key]) {
                    changedFields[key] = inputs[key].value;
                    hasChanges = true;
                }
            });

            if (!hasChanges) {
                Swal.fire({
                    icon: 'info',
                    title: 'Atención',
                    text: 'No se detectaron cambios para guardar.',
                    confirmButtonColor: '#00A356'
                });
                return;
            }

            const allValid = Object.values(validationStates).every(state => state === true);
            if (!allValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formulario inválido',
                    text: 'Por favor, corrige los errores en el formulario antes de guardar.',
                    confirmButtonColor: '#00A356'
                });
                return;
            }

            Swal.fire({
                title: 'Guardando cambios académicos...',
                text: 'Por favor espera un momento.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData();
            formData.append('action', 'personal');
            formData.append('csrf_token', document.querySelector('input[name="csrf_token"]').value);
            Object.keys(changedFields).forEach(key => {
                formData.append(key, changedFields[key]);
            });

            fetch('<?= URLROOT; ?>/index.php?route=perfil/update', {
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
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: data.message || 'Tu perfil fue actualizado correctamente.',
                        confirmButtonColor: '#00A356',
                        timer: 3000
                    });

                    // Update initial values
                    Object.keys(changedFields).forEach(key => {
                        initialValues[key] = changedFields[key];
                    });

                    // Update layouts
                    if (changedFields.nombre || changedFields.apellido) {
                        const newName = `${inputs.nombre.value} ${inputs.apellido.value}`;
                        document.querySelectorAll('.sga-sidebar-user span strong, .sga-topbar-user span strong, .profile-title-area h3').forEach(el => {
                            el.textContent = newName;
                        });
                    }

                    checkFormValidity();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: data.message || 'No fue posible guardar los cambios.',
                        confirmButtonColor: '#00A356'
                    });
                }
            })
            .catch(err => {
                Swal.close();
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red / servidor',
                    text: err.message || 'No se pudo establecer comunicación con el servidor.',
                    confirmButtonColor: '#00A356'
                });
            });
        });
    }

    // 3. PASSWORD VALIDATION (Tab 2)
    const passInputs = {
        actual: document.getElementById('contrasena_actual'),
        nueva: document.getElementById('new_password'),
        confirmar: document.getElementById('confirm_password')
    };

    function validatePasswords(showUI = true) {
        const actualVal = passInputs.actual.value;
        const nuevaVal = passInputs.nueva.value;
        const confirmVal = passInputs.confirmar.value;
        const btn = document.getElementById('btnSaveSecurity');

        let isActualValid = true;
        let isNuevaValid = true;
        let isConfirmValid = true;

        let actualError = "";
        let nuevaError = "";
        let confirmError = "";

        if (nuevaVal !== "") {
            const hasUpper = /[A-Z]/.test(nuevaVal);
            const hasLower = /[a-z]/.test(nuevaVal);
            const hasNumber = /[0-9]/.test(nuevaVal);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>_\-\[\]]/.test(nuevaVal);
            const isLongEnough = nuevaVal.length >= 8;

            if (actualVal === "") {
                isActualValid = false;
                actualError = "Debes ingresar tu contraseña actual.";
            }

            if (!isLongEnough) {
                isNuevaValid = false;
                nuevaError = "La contraseña debe tener al menos 8 caracteres.";
            } else if (!hasUpper) {
                isNuevaValid = false;
                nuevaError = "Debe contener al menos una letra mayúscula.";
            } else if (!hasLower) {
                isNuevaValid = false;
                nuevaError = "Debe contener al menos una letra minúscula.";
            } else if (!hasNumber) {
                isNuevaValid = false;
                nuevaError = "Debe contener al menos un número.";
            } else if (!hasSpecial) {
                isNuevaValid = false;
                nuevaError = "Debe contener al menos un carácter especial.";
            } else if (nuevaVal === actualVal) {
                isNuevaValid = false;
                nuevaError = "La nueva contraseña debe ser diferente a la actual.";
            }

            if (confirmVal !== nuevaVal) {
                isConfirmValid = false;
                confirmError = "Las contraseñas no coinciden.";
            }
        } else {
            if (actualVal !== "" || confirmVal !== "") {
                isNuevaValid = false;
                nuevaError = "Escribe primero una nueva contraseña.";
            }
        }

        if (showUI) {
            if (nuevaVal !== "") {
                updateUIState(passInputs.actual, isActualValid, actualError);
                updateUIState(passInputs.nueva, isNuevaValid, nuevaError);
                updateUIState(passInputs.confirmar, isConfirmValid && confirmVal !== "", confirmError);
            } else {
                resetPasswordUI(passInputs.actual);
                resetPasswordUI(passInputs.nueva);
                resetPasswordUI(passInputs.confirmar);
            }
        }

        if (btn) {
            const formValid = (nuevaVal !== "" && isActualValid && isNuevaValid && isConfirmValid);
            btn.disabled = !formValid;
            btn.style.opacity = formValid ? "1" : "0.65";
            btn.style.cursor = formValid ? "pointer" : "not-allowed";
        }
    }

    function resetPasswordUI(input) {
        input.style.borderColor = "rgba(0, 0, 0, 0.08)";
        input.style.boxShadow = "none";
        input.style.backgroundColor = "#f8fafc";
        const group = input.closest('.input-group-custom');
        const statusIcon = group ? group.querySelector('.validation-status-icon') : null;
        if (statusIcon) statusIcon.style.opacity = "0";
        const errorDiv = document.getElementById(`error-${input.id}`);
        if (errorDiv) errorDiv.classList.remove('show');
    }

    if (passInputs.actual && passInputs.nueva && passInputs.confirmar) {
        passInputs.actual.addEventListener('input', () => validatePasswords(true));
        passInputs.nueva.addEventListener('input', () => validatePasswords(true));
        passInputs.confirmar.addEventListener('input', () => validatePasswords(true));
        passInputs.actual.addEventListener('blur', () => validatePasswords(true));
        passInputs.nueva.addEventListener('blur', () => validatePasswords(true));
        passInputs.confirmar.addEventListener('blur', () => validatePasswords(true));
    }

    // Submit handler for Password change
    const btnSaveSecurity = document.getElementById('btnSaveSecurity');
    if (btnSaveSecurity) {
        btnSaveSecurity.addEventListener('click', function(e) {
            e.preventDefault();

            const actualVal = passInputs.actual.value;
            const nuevaVal = passInputs.nueva.value;
            const confirmVal = passInputs.confirmar.value;

            if (actualVal === "" || nuevaVal === "" || confirmVal === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Debes rellenar todos los campos de contraseña.',
                    confirmButtonColor: '#00A356'
                });
                return;
            }

            Swal.fire({
                title: 'Actualizando contraseña...',
                text: 'Por favor espera un momento.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData();
            formData.append('action', 'security');
            formData.append('csrf_token', document.querySelector('input[name="csrf_token"]').value);
            formData.append('contrasena_actual', actualVal);
            formData.append('contrasena', nuevaVal);
            formData.append('contrasena_confirm', confirmVal);

            fetch('<?= URLROOT; ?>/index.php?route=perfil/update', {
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
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: data.message || 'Tu contraseña fue actualizada correctamente.',
                        confirmButtonColor: '#00A356',
                        timer: 3000
                    });

                    // Clear inputs and reset UI
                    passInputs.actual.value = "";
                    passInputs.nueva.value = "";
                    passInputs.confirmar.value = "";
                    resetPasswordUI(passInputs.actual);
                    resetPasswordUI(passInputs.nueva);
                    resetPasswordUI(passInputs.confirmar);
                    validatePasswords(false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atención',
                        text: data.message || 'No fue posible cambiar la contraseña.',
                        confirmButtonColor: '#00A356'
                    });
                }
            })
            .catch(err => {
                Swal.close();
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de red / servidor',
                    text: err.message || 'No se pudo establecer comunicación con el servidor.',
                    confirmButtonColor: '#00A356'
                });
            });
        });
    }
});
</script>
