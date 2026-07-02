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
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Carlos Arturo" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label fw-medium text-secondary">Apellidos</label>
                            <input type="text" class="form-control form-control-lg" id="apellido" name="apellido" placeholder="Ej. Gómez" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label fw-medium text-secondary">Teléfono de Contacto</label>
                            <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" placeholder="Ej. 3019876543" required>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label fw-medium text-secondary">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg" id="correo" name="correo" placeholder="Ej. correo@soy.sena.edu.co" required>
                        </div>
                        <div class="col-md-12">
                            <label for="titulacion" class="form-label fw-medium text-secondary">Titulación o Nivel Académico</label>
                            <input type="text" class="form-control form-control-lg" id="titulacion" name="titulacion" placeholder="Ej. Ingeniero de Sistemas / Bachiller" required>
                        </div>
                        <div class="col-md-4">
                            <label for="usuario" class="form-label fw-medium text-secondary">Nombre de Usuario (Login)</label>
                            <input type="text" class="form-control form-control-lg" id="usuario" name="usuario" placeholder="Ej. cgomez" required>
                        </div>
                        <div class="col-md-4">
                            <label for="contrasena" class="form-label fw-medium text-secondary">Contraseña de Acceso</label>
                            <input type="text" class="form-control form-control-lg" id="contrasena" name="contrasena" placeholder="Ej. hashed_pass_999" required>
                        </div>
                        <div class="col-md-4">
                            <label for="id_rol" class="form-label fw-medium text-secondary">Rol Principal</label>
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
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
