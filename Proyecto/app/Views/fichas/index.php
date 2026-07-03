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
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="<?= URLROOT; ?>/index.php?route=fichas/show&id=<?= $ficha->numero_ficha; ?>" class="btn btn-outline-primary btn-sm rounded-3 shadow-sm">
                                                <i class="fa-solid fa-eye me-1"></i> Ver Detalle
                                            </a>
                                            <?php if ($current_role === 'Coordinador'): ?>
                                                <button type="button" class="btn btn-success btn-sm rounded-3 shadow-sm btn-gestionar-aprendices" data-ficha="<?= $ficha->numero_ficha; ?>" data-bs-toggle="modal" data-bs-target="#modalGestionarAprendices">
                                                    <i class="fa-solid fa-user-plus me-1"></i> Gestionar Aprendices
                                                </button>
                                            <?php endif; ?>
                                        </div>
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

<!-- Modal Gestionar Aprendices -->
<div class="modal fade" id="modalGestionarAprendices" tabindex="-1" aria-labelledby="modalGestionarAprendicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-success text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalGestionarAprendicesLabel"><i class="fa-solid fa-user-graduate me-2"></i>Gestionar Aprendices</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-fill bg-light border-bottom-0" id="gestionarTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-medium py-3" id="individual-tab" data-bs-toggle="tab" data-bs-target="#individual" type="button" role="tab" aria-controls="individual" aria-selected="true"><i class="fa-solid fa-user-plus me-2"></i>Carga Individual</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-medium py-3" id="masiva-tab" data-bs-toggle="tab" data-bs-target="#masiva" type="button" role="tab" aria-controls="masiva" aria-selected="false"><i class="fa-solid fa-file-csv me-2"></i>Carga Masiva CSV</button>
                    </li>
                </ul>
                <div class="tab-content p-4" id="gestionarTabsContent">
                    <!-- Tab Individual -->
                    <div class="tab-pane fade show active" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirAprendizIndex" method="POST">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="mb-3">
                                <label for="id_usuario_aprendiz" class="form-label fw-medium text-secondary">Seleccionar Aprendiz</label>
                                <select class="form-select form-select-lg" id="id_usuario_aprendiz" name="id_usuario_aprendiz" required>
                                    <option value="">Buscar o seleccionar aprendiz...</option>
                                    <?php if(isset($candidatos)): ?>
                                        <?php foreach ($candidatos as $cand): ?>
                                            <option value="<?= $cand->id_usuario; ?>"><?= $cand->documento . ' - ' . $cand->nombre . ' ' . $cand->apellido; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success fw-bold shadow-sm py-2">Matricular Aprendiz</button>
                            </div>
                        </form>
                    </div>
                    <!-- Tab Masiva -->
                    <div class="tab-pane fade" id="masiva" role="tabpanel" aria-labelledby="masiva-tab">
                        <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirMasivoCSV" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="numero_ficha" class="input-ficha-id">
                            <div class="alert alert-info small rounded-3">
                                <i class="fa-solid fa-circle-info me-2"></i> El archivo CSV debe contener una columna (idealmente sin encabezados) donde cada fila sea el <strong>Documento</strong> del aprendiz.
                            </div>
                            <div class="mb-3">
                                <label for="archivo_csv" class="form-label fw-medium text-secondary">Archivo CSV</label>
                                <input class="form-control form-control-lg" type="file" id="archivo_csv" name="archivo_csv" accept=".csv" required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-dark fw-bold shadow-sm py-2"><i class="fa-solid fa-upload me-2"></i>Procesar Archivo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Pasar el ID de la ficha al modal cuando se hace clic en "Gestionar Aprendices"
    var modalGestionar = document.getElementById('modalGestionarAprendices');
    if (modalGestionar) {
        modalGestionar.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var fichaId = button.getAttribute('data-ficha');
            
            // Actualizar todos los inputs hidden con la clase 'input-ficha-id'
            var inputs = modalGestionar.querySelectorAll('.input-ficha-id');
            inputs.forEach(function(input) {
                input.value = fichaId;
            });
        });
    }
});
</script>
<?php endif; ?>
