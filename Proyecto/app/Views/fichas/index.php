<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Fichas de Formación Académica</h3>
            <p class="text-muted small mb-0">Listado general de grupos de estudio y programas asociados</p>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn btn-primary shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearFicha">
                <i class="fa-solid fa-plus me-2"></i> Crear Ficha
            </button>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <?php if (empty($fichas)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="fa-solid fa-users-slash fa-3x mb-3 text-secondary"></i>
                    <h5 class="fw-bold">No hay fichas asignadas o registradas</h5>
                    <p class="small mb-0">Actualmente no estás vinculado a ninguna ficha en el sistema.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase py-3">
                            <tr>
                                <th class="ps-4">No. Ficha</th>
                                <th>Programa de Formación</th>
                                <th>Jornada</th>
                                <th>Líder (Instructor)</th>
                                <th>Alumnos (Aprox)</th>
                                <th>Duración</th>
                                <th class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fichas as $ficha): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary fs-6">
                                        <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $ficha->numero_ficha; ?>" class="text-decoration-none">
                                            <?= $ficha->numero_ficha; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= $ficha->programa_nombre; ?></div>
                                    </td>
                                    <td><span class="badge bg-dark"><?= $ficha->jornada_nombre; ?></span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; border-radius: 50%; font-size: 12px;">
                                                <?= substr($ficha->instructor_nombre, 0, 1); ?>
                                            </div>
                                            <span class="text-secondary fw-medium"><?= $ficha->instructor_nombre . ' ' . $ficha->instructor_apellido; ?></span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-1"><?= $ficha->cantidad_estudiantes; ?> aprendices</span></td>
                                    <td class="text-muted small">
                                        <i class="fa-solid fa-calendar-day me-1"></i> <?= $ficha->fecha_inicio; ?> <br>
                                        <i class="fa-solid fa-flag-checkered me-1"></i> <?= $ficha->fecha_fin; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $ficha->numero_ficha; ?>" class="btn btn-outline-primary btn-sm rounded-3 shadow-sm">
                                            <i class="fa-solid fa-eye me-1"></i> Ver Detalle
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Ficha -->
<div class="modal fade" id="modalCrearFicha" tabindex="-1" aria-labelledby="modalCrearFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearFichaLabel"><i class="fa-solid fa-users me-2 text-primary"></i>Registrar Nueva Ficha</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/create" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="numero_ficha" class="form-label fw-medium text-secondary">Número de Ficha</label>
                            <input type="number" class="form-control form-control-lg" id="numero_ficha" name="numero_ficha" placeholder="Ej. 2670003" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cantidad_estudiantes" class="form-label fw-medium text-secondary">Cantidad Estudiantes</label>
                            <input type="number" class="form-control form-control-lg" id="cantidad_estudiantes" name="cantidad_estudiantes" placeholder="Ej. 30" required>
                        </div>
                        <div class="col-md-12">
                            <label for="id_programa" class="form-label fw-medium text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg" id="id_programa" name="id_programa" required>
                                <option value="">Selecciona un programa...</option>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>"><?= $prog->nombre . ' (' . $prog->codigo . ') - ' . $prog->tipo_nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario_instructor_lider" class="form-label fw-medium text-secondary">Instructor Líder</label>
                            <select class="form-select form-select-lg" id="id_usuario_instructor_lider" name="id_usuario_instructor_lider" required>
                                <option value="">Selecciona un instructor...</option>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_jornada" class="form-label fw-medium text-secondary">Jornada</label>
                            <select class="form-select form-select-lg" id="id_jornada" name="id_jornada" required>
                                <option value="">Selecciona la jornada...</option>
                                <?php foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>"><?= $jor->nombre . ' (' . substr($jor->hora_inicio, 0, 5) . ' - ' . substr($jor->hora_fin, 0, 5) . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_inicio" class="form-label fw-medium text-secondary">Fecha Inicio</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_practicas" class="form-label fw-medium text-secondary">Fecha Prácticas</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_practicas" name="fecha_practicas" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_fin" class="form-label fw-medium text-secondary">Fecha Fin</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Ficha</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
