<div class="profile-page mx-auto">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div>
            <span class="text-success fw-bold small text-uppercase">Cuenta personal</span>
            <h2 class="fw-bold text-dark mb-1">Mi perfil</h2>
            <p class="text-muted mb-0">Consulta y actualiza tu información dentro del sistema.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <?php foreach ($roles as $rol): ?>
                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2"><?= htmlspecialchars($rol->nombre_rol); ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <form action="<?= URLROOT; ?>/index.php?route=perfil/update" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
        <div class="profile-cover"></div>
        <div class="card-body p-4 p-lg-5">
            <div class="row g-5">
                <div class="col-12 col-lg-4">
                    <div class="profile-photo-panel text-center">
                        <div class="profile-photo-wrap mx-auto">
                            <?php if ($fotoPerfil): ?>
                                <img id="profilePreview" src="<?= htmlspecialchars($fotoPerfil); ?>" alt="Fotografía de perfil">
                            <?php else: ?>
                                <img id="profilePreview" src="https://ui-avatars.com/api/?name=<?= urlencode($usuario->nombre . ' ' . $usuario->apellido); ?>&background=39A900&color=fff&size=256" alt="Fotografía de perfil">
                            <?php endif; ?>
                            <label for="foto" class="profile-photo-action" title="Cambiar fotografía"><i class="fa-solid fa-camera"></i></label>
                        </div>
                        <h4 class="fw-bold mt-3 mb-1"><?= htmlspecialchars($usuario->nombre . ' ' . $usuario->apellido); ?></h4>
                        <p class="text-muted small mb-3"><?= htmlspecialchars($usuario->correo); ?></p>
                        <input type="file" class="d-none" id="foto" name="foto" accept="image/jpeg,image/png,image/webp">
                        <label for="foto" class="btn btn-outline-success rounded-pill px-4"><i class="fa-regular fa-image me-2"></i>Cambiar foto</label>
                        <p class="text-muted mt-3 mb-0" style="font-size:.75rem;">JPG, PNG o WEBP · Máximo 3 MB</p>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <h5 class="fw-bold mb-4">Información personal</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombres</label>
                            <input type="text" name="nombre" class="form-control form-control-lg" value="<?= htmlspecialchars($usuario->nombre); ?>" required maxlength="100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Apellidos</label>
                            <input type="text" name="apellido" class="form-control form-control-lg" value="<?= htmlspecialchars($usuario->apellido); ?>" required maxlength="100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Correo electrónico</label>
                            <input type="email" name="correo" class="form-control form-control-lg" value="<?= htmlspecialchars($usuario->correo); ?>" required maxlength="150">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" name="telefono" class="form-control form-control-lg" value="<?= htmlspecialchars($usuario->telefono); ?>" maxlength="20">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Titulación o profesión</label>
                            <input type="text" name="titulacion" class="form-control form-control-lg" value="<?= htmlspecialchars($usuario->titulacion); ?>" maxlength="100">
                        </div>
                        <div class="col-12"><hr class="my-1"></div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nueva contraseña <span class="text-muted fw-normal">(opcional)</span></label>
                            <input type="password" name="contrasena" class="form-control form-control-lg" minlength="8" autocomplete="new-password" placeholder="Déjala vacía para conservar la actual">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill px-5"><i class="fa-solid fa-floppy-disk me-2"></i>Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.profile-page{max-width:1180px}.profile-cover{height:120px;background:linear-gradient(120deg,#007832,#39A900)}
.profile-photo-panel{margin-top:-92px}.profile-photo-wrap{position:relative;width:170px;height:170px}
.profile-photo-wrap img{width:100%;height:100%;object-fit:cover;border:6px solid #fff;border-radius:50%;box-shadow:0 8px 24px rgba(0,0,0,.16)}
.profile-photo-action{position:absolute;right:5px;bottom:12px;display:grid;width:42px;height:42px;place-items:center;border:3px solid #fff;border-radius:50%;background:#39A900;color:#fff;cursor:pointer}
.profile-page .form-control{border-color:#dee5df;border-radius:12px}.profile-page .form-control:focus{border-color:#39A900;box-shadow:0 0 0 .22rem rgba(57,169,0,.14)}
@media(max-width:991px){.profile-photo-panel{margin-top:-105px;margin-bottom:1rem}.profile-cover{height:145px}}
</style>

<script>
document.getElementById('foto').addEventListener('change', function () {
    const file = this.files && this.files[0];
    if (!file) return;
    if (file.size > 3 * 1024 * 1024) {
        alert('La fotografía no puede superar los 3 MB.');
        this.value = '';
        return;
    }
    document.getElementById('profilePreview').src = URL.createObjectURL(file);
});
</script>
