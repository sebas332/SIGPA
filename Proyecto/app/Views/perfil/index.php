<div class="profile-page mx-auto">
    <!-- Page Title & Breadcrumbs -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="text-success fw-bold small text-uppercase" style="color: #00A356 !important; font-size: 0.72rem; letter-spacing: 0.5px;">Cuenta personal</span>
            <h2 class="fw-bold text-dark mb-1" style="font-size: 1.85rem;">Mi perfil</h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">Consulta y actualiza tu información dentro del sistema.</p>
        </div>
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem; font-weight: 500;">
                <li class="breadcrumb-item">
                    <a href="<?= URLROOT; ?>/index.php?route=dashboard/index" class="text-muted text-decoration-none d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-house" style="font-size: 0.8rem;"></i> Inicio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #00A356;">Mi perfil</li>
            </ol>
        </nav>
    </div>

    <!-- Main Profile Card Wrapper -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 bg-white position-relative" style="border: 1px solid rgba(0,0,0,0.03) !important;">
        <!-- Profile Cover Banner -->
        <div class="profile-cover p-4 d-flex align-items-end position-relative">
            <!-- Geometric Pattern Overlay -->
            <div class="cover-pattern"></div>
            
            <div class="w-100 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 z-1">
                <!-- Avatar & Name Area (inside cover) -->
                <div class="d-flex align-items-center gap-4">
                    <!-- Avatar Container -->
                    <div class="profile-photo-container">
                        <div class="position-relative w-100 h-100">
                            <?php if ($fotoPerfil): ?>
                                <img id="profilePreview" src="<?= htmlspecialchars($fotoPerfil); ?>" alt="Fotografía de perfil">
                            <?php else: ?>
                                <img id="profilePreview" src="https://ui-avatars.com/api/?name=<?= urlencode($usuario->nombre . ' ' . $usuario->apellido); ?>&background=39A900&color=fff&size=256" alt="Fotografía de perfil">
                            <?php endif; ?>
                            <!-- Camera trigger icon -->
                            <button type="button" class="profile-photo-action border-0" onclick="document.getElementById('foto').click()" title="Cambiar fotografía">
                                <i class="fa-solid fa-camera"></i>
                            </button>
                        </div>
                    </div>
                    <div class="profile-title-area">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="fw-bold mb-0 text-white" style="font-size: 1.8rem;"><?= htmlspecialchars($usuario->nombre . ' ' . $usuario->apellido); ?></h3>
                            <span class="badge text-white rounded-pill px-3 py-1 fw-bold text-uppercase d-inline-flex align-items-center gap-1" style="font-size: 0.68rem; letter-spacing: 0.5px; background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25);">
                                <i class="fa-solid fa-crown" style="font-size: 0.65rem;"></i> <?= htmlspecialchars($current_role); ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Institutional Info Overlay (Right Side) -->
                <div class="institutional-info text-md-end text-start d-flex gap-4">
                    <div>
                        <span class="info-label">ROL INSTITUCIONAL</span>
                        <span class="info-value"><?= htmlspecialchars($current_role); ?></span>
                    </div>
                    <div class="border-start border-white-20 ps-4">
                        <span class="info-label">ID USUARIO</span>
                        <span class="info-value">#<?= htmlspecialchars($usuario->id_usuario); ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Under Banner Info Area -->
        <div class="under-banner-body card-body px-4 py-3 bg-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex flex-wrap gap-4 text-muted" style="font-size: 0.88rem; font-weight: 500;">
                    <span class="d-inline-flex align-items-center gap-2">
                        <i class="fa-regular fa-envelope" style="color: #64748b; font-size: 0.95rem;"></i> <?= htmlspecialchars($usuario->correo); ?>
                    </span>
                    <?php if ($usuario->titulacion): ?>
                        <span class="d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-id-card-clip" style="color: #64748b; font-size: 0.95rem;"></i> <?= htmlspecialchars($usuario->titulacion); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div>
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 border shadow-sm fw-semibold d-inline-flex align-items-center gap-2" onclick="document.getElementById('foto').click()" style="background-color: #ffffff; color: #495057; border: 1px solid rgba(0,0,0,0.1) !important; font-size: 0.85rem; height: 38px;">
                        <i class="fa-solid fa-upload"></i> Subir foto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Pills / Tabs Container -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white" style="border: 1px solid rgba(0,0,0,0.03) !important;">
        <div class="card-body p-2">
            <ul class="nav nav-pills custom-profile-tabs gap-2" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="personal-tab" data-bs-toggle="pill" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                        <i class="fa-regular fa-user me-2" style="font-size: 0.95rem;"></i>Información Personal
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">
                        <i class="fa-solid fa-shield-halved me-2" style="font-size: 0.95rem;"></i>Seguridad y Acceso
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Forms Container (Single Form for absolute compatibility) -->
    <form action="<?= URLROOT; ?>/index.php?route=perfil/update" method="POST" enctype="multipart/form-data" id="profileForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
        <!-- Hidden actual file input -->
        <input type="file" class="d-none" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">

        <div class="tab-content" id="profileTabsContent">
            <!-- TAB 1: Información Personal -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white" style="border: 1px solid rgba(0,0,0,0.04) !important;">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="card-header-icon-box">
                            <i class="fa-regular fa-id-card"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-1" style="font-size: 1.15rem; letter-spacing: 0.2px;">Datos identificativos e institucionales</h4>
                            <p class="text-muted mb-0" style="font-size: 0.88rem;">Modifica tu información registrada en la base de datos de gestión académica del centro.</p>
                        </div>
                    </div>

                    <div class="row g-4">
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

                    <div class="d-flex justify-content-end mt-5 mb-4">
                        <button type="submit" id="btnSavePersonal" class="btn btn-save-custom d-inline-flex align-items-center gap-2">
                            <i class="fa-regular fa-floppy-disk" style="font-size: 0.95rem;"></i> Guardar Cambios Académicos
                        </button>
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
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white" style="border: 1px solid rgba(0,0,0,0.04) !important;">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="card-header-icon-box">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-1" style="font-size: 1.15rem; letter-spacing: 0.2px;">Actualizar credencial de acceso</h4>
                            <p class="text-muted mb-0" style="font-size: 0.88rem;">Configura una contraseña segura y robusta para tu cuenta de SIGPA.</p>
                        </div>
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

                    <div class="d-flex justify-content-end mt-5 mb-4">
                        <button type="submit" id="btnSaveSecurity" class="btn btn-save-custom d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-lock" style="font-size: 0.95rem;"></i> Cambiar Contraseña Segura
                        </button>
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
    max-width: 1180px;
    padding-bottom: 2rem;
}

/* 1. Header Banner Styling */
.profile-cover {
    height: 140px;
    background: linear-gradient(135deg, #006B3F 0%, #0E8A45 50%, #39A900 100%);
    position: relative;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.cover-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.06;
    background-image: 
        radial-gradient(circle at 20% 30%, #ffffff 10%, transparent 10.5%),
        radial-gradient(circle at 80% 70%, #ffffff 15%, transparent 15.5%),
        linear-gradient(45deg, transparent 48%, #ffffff 49%, #ffffff 51%, transparent 52%),
        linear-gradient(-45deg, transparent 48%, #ffffff 49%, #ffffff 51%, transparent 52%);
    background-size: 40px 40px, 60px 60px, 80px 80px, 80px 80px;
    pointer-events: none;
}

.z-1 {
    z-index: 1;
}

.border-white-20 {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

.info-label {
    display: block;
    font-size: 0.65rem;
    letter-spacing: 1px;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 700;
}

.info-value {
    font-size: 1.05rem;
    font-weight: 700;
    color: #ffffff;
    margin-top: 1px;
    display: block;
}

/* 2. Avatar Overlap & Styling */
.profile-photo-container {
    width: 130px;
    height: 130px;
    position: absolute;
    bottom: -55px;
    left: 30px;
    z-index: 10;
}

.profile-photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 5px solid #ffffff;
    border-radius: 50%;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.profile-photo-action {
    position: absolute;
    right: 2px;
    bottom: 2px;
    display: grid;
    width: 34px;
    height: 34px;
    place-items: center;
    border-radius: 50%;
    background: #00A356;
    color: #ffffff;
    font-size: 0.9rem;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 163, 86, 0.3);
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.profile-photo-action:hover {
    transform: scale(1.08);
    background-color: #008747;
}

.profile-title-area {
    margin-bottom: 2px;
}

/* 3. Under Banner Info Container */
.under-banner-body {
    padding-top: 1.5rem !important;
}

@media (min-width: 768px) {
    .under-banner-body {
        padding-left: 185px !important;
    }
}

/* 4. Navigation Pills / Tabs */
.custom-profile-tabs {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.custom-profile-tabs .nav-link {
    background: transparent;
    color: #64748b;
    font-size: 0.92rem;
    font-weight: 600;
    padding: 0.75rem 1.25rem;
    border-radius: 8px;
    border: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
}

.custom-profile-tabs .nav-link:hover {
    color: #1e293b;
    background-color: #f8fafc;
}

.custom-profile-tabs .nav-link.active {
    color: #00A356 !important;
    background-color: rgba(0, 163, 86, 0.08) !important;
}

.custom-profile-tabs .nav-link.active::after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 15%;
    right: 15%;
    height: 3px;
    background-color: #00A356;
    border-radius: 3px 3px 0 0;
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
    .profile-cover {
        height: auto;
        padding-bottom: 3.5rem !important;
    }
    
    .profile-photo-container {
        width: 110px;
        height: 110px;
        position: relative;
        bottom: auto;
        left: auto;
        margin: 1rem auto 0;
    }
    
    .under-banner-body {
        padding-top: 1.5rem !important;
        text-align: center;
    }
    
    .under-banner-body .d-flex {
        justify-content: center !important;
    }
    
    .institutional-info {
        justify-content: center;
        width: 100%;
        margin-top: 1.5rem;
    }
    
    .profile-cover .w-100 {
        align-items: center !important;
    }
    
    .profile-title-area {
        text-align: center;
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
