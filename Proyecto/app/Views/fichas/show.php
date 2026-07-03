<div class="container-fluid px-0">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold text-dark mb-1">Detalle de Ficha: <span class="text-primary"><?= $ficha->numero_ficha; ?></span></h2>
            <p class="text-muted small mb-0"><?= $ficha->programa_nombre; ?> | Jornada <span class="badge bg-dark ms-1"><?= $ficha->jornada_nombre; ?></span></p>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-warning shadow-sm fw-medium text-dark" data-bs-toggle="modal" data-bs-target="#modalEditarFicha">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Editar Ficha
                </button>
                <button type="button" class="btn btn-danger shadow-sm fw-medium btn-delete-ficha" data-url="<?= URLROOT; ?>/index.php?route=fichas/delete&id=<?= $ficha->numero_ficha; ?>">
                    <i class="fa-solid fa-trash me-2"></i> Eliminar Ficha
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Panel Resumen de la Ficha -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 bg-white">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-address-card text-primary me-2"></i>Información General</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium"><i class="fa-solid fa-user-tie me-2 text-primary"></i> Instructor Líder:</span>
                            <span class="fw-bold text-dark"><?= $ficha->instructor_nombre . ' ' . $ficha->instructor_apellido; ?></span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium"><i class="fa-solid fa-users me-2 text-success"></i> Estudiantes Máximos:</span>
                            <span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-2 fs-6"><?= $ficha->cantidad_estudiantes; ?></span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium"><i class="fa-solid fa-calendar-check me-2 text-info"></i> Fecha Inicio:</span>
                            <span class="text-muted fw-medium"><?= $ficha->fecha_inicio; ?></span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium"><i class="fa-solid fa-briefcase me-2 text-warning"></i> Fecha Prácticas:</span>
                            <span class="text-muted fw-medium"><?= $ficha->fecha_practicas; ?></span>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary fw-medium"><i class="fa-solid fa-flag-checkered me-2 text-danger"></i> Fecha Fin:</span>
                            <span class="text-muted fw-medium"><?= $ficha->fecha_fin; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabla de Aprendices Matriculados -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 h-100 bg-white">
                <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-user-graduate text-success me-2"></i>Aprendices Inscritos (<?= count($aprendices); ?>)</h5>
                </div>
                <div class="card-body px-4 pt-0">
                    <?php if (empty($aprendices)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="fa-solid fa-users-slash fa-3x mb-3 text-secondary"></i>
                            <h6 class="fw-bold">No hay aprendices matriculados en esta ficha</h6>
                            <p class="small mb-0">Utiliza la opción de matricular para añadir estudiantes.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary small text-uppercase">
                                    <tr>
                                        <th>Aprendiz</th>
                                        <th>Correo Electrónico</th>
                                        <th>Teléfono</th>
                                        <?php if ($current_role === 'Coordinador'): ?>
                                            <th class="text-end">Acción</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($aprendices as $ap): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-success-subtle text-success fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%;">
                                                        <?= substr($ap->nombre, 0, 1); ?>
                                                    </div>
                                                    <span class="fw-bold text-dark"><?= $ap->nombre . ' ' . $ap->apellido; ?></span>
                                                </div>
                                            </td>
                                            <td class="text-muted small"><i class="fa-solid fa-envelope me-1 text-secondary"></i> <?= $ap->correo; ?></td>
                                            <td class="text-muted small"><i class="fa-solid fa-phone me-1 text-secondary"></i> <?= $ap->telefono; ?></td>
                                            <?php if ($current_role === 'Coordinador'): ?>
                                                <td class="text-end">
                                                    <a href="<?= URLROOT; ?>/index.php?route=fichas/removerAprendiz&id=<?= $ap->id_ficha_aprendiz; ?>&ficha=<?= $ficha->numero_ficha; ?>" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('¿Seguro que deseas remover a este aprendiz de la ficha?');">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Programación Académica de la Ficha -->
    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-header bg-white p-4 border-0">
            <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-calendar-days text-primary me-2"></i>Cronograma y Clases Asociadas</h5>
        </div>
        <div class="card-body px-4 pt-0">
            <?php if (empty($programacion)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                    <h6 class="fw-bold">No hay clases programadas para esta ficha</h6>
                    <p class="small mb-0">El Coordinador puede asignar horarios desde la sección de Programación.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase">
                            <tr>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Ambiente</th>
                                <th>Instructor</th>
                                <th>Competencia / Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programacion as $prog): ?>
                                <tr>
                                    <td><span class="badge bg-dark"><?= $prog->nombre_dia; ?></span></td>
                                    <td class="text-muted small fw-medium"><?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary-emphasis"><?= $prog->ambiente_nombre; ?></span></td>
                                    <td class="text-muted small"><i class="fa-solid fa-user-tie me-1 text-primary"></i> <?= $prog->instructor_nombre . ' ' . $prog->instructor_apellido; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark small"><?= $prog->competencia_nombre; ?></div>
                                        <div class="text-muted small"><?= $prog->ra_codigo . ' - ' . $prog->ra_descripcion; ?></div>
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
<!-- Modal Inscribir Aprendiz -->
<div class="modal fade" id="modalInscribirAprendiz" tabindex="-1" aria-labelledby="modalInscribirAprendizLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalInscribirAprendizLabel"><i class="fa-solid fa-user-plus me-2 text-success"></i>Matricular Aprendiz en Ficha</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/inscribirAprendiz" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="numero_ficha" value="<?= $ficha->numero_ficha; ?>">
                    <div class="mb-3">
                        <label for="id_usuario_aprendiz" class="form-label fw-medium text-secondary">Seleccionar Aprendiz</label>
                        <select class="form-select form-select-lg" id="id_usuario_aprendiz" name="id_usuario_aprendiz" required>
                            <option value="">Selecciona un aprendiz...</option>
                            <?php foreach ($candidatos as $cand): ?>
                                <option value="<?= $cand->id_usuario; ?>"><?= $cand->nombre . ' ' . $cand->apellido . ' (' . $cand->correo . ')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-check me-2"></i> Inscribir Aprendiz</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Ficha -->
<div class="modal fade" id="modalEditarFicha" tabindex="-1" aria-labelledby="modalEditarFichaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-warning text-dark p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalEditarFichaLabel"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Ficha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/update" method="POST">
                <input type="hidden" name="from_show" value="1">
                <input type="hidden" name="numero_ficha_original" value="<?= $ficha->numero_ficha; ?>">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="numero_ficha" class="form-label fw-medium text-secondary">Número de Ficha</label>
                            <input type="number" class="form-control form-control-lg" id="numero_ficha" name="numero_ficha" value="<?= $ficha->numero_ficha; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cantidad_estudiantes" class="form-label fw-medium text-secondary">Cantidad Estudiantes</label>
                            <input type="number" class="form-control form-control-lg" id="cantidad_estudiantes" name="cantidad_estudiantes" value="<?= $ficha->cantidad_estudiantes; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="id_programa" class="form-label fw-medium text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg" id="id_programa" name="id_programa" required>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>" <?= ($prog->id_programa == $ficha->id_programa) ? 'selected' : ''; ?>>
                                        <?= $prog->nombre . ' (' . $prog->codigo . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario_instructor_lider" class="form-label fw-medium text-secondary">Instructor Líder</label>
                            <select class="form-select form-select-lg" id="id_usuario_instructor_lider" name="id_usuario_instructor_lider" required>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>" <?= ($inst->id_usuario == $ficha->id_usuario_instructor_lider) ? 'selected' : ''; ?>>
                                        <?= $inst->nombre . ' ' . $inst->apellido; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_jornada" class="form-label fw-medium text-secondary">Jornada</label>
                            <select class="form-select form-select-lg" id="id_jornada" name="id_jornada" required>
                                <?php foreach ($jornadas as $jor): ?>
                                    <option value="<?= $jor->id_jornada; ?>" <?= ($jor->id_jornada == $ficha->id_jornada) ? 'selected' : ''; ?>>
                                        <?= $jor->nombre; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_inicio" class="form-label fw-medium text-secondary">Fecha Inicio</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_inicio" name="fecha_inicio" value="<?= $ficha->fecha_inicio; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_practicas" class="form-label fw-medium text-secondary">Fecha Prácticas</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_practicas" name="fecha_practicas" value="<?= $ficha->fecha_practicas; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_fin" class="form-label fw-medium text-secondary">Fecha Fin</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_fin" name="fecha_fin" value="<?= $ficha->fecha_fin; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold shadow-sm text-dark"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const URL_ROOT = '<?= URLROOT; ?>';
    const deleteBtn = document.querySelector('.btn-delete-ficha');
    
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            const deleteUrl = this.getAttribute('data-url');
            
            Swal.fire({
                title: '¿Eliminar Ficha?',
                text: "Esta acción no se puede deshacer y puede afectar la información asociada.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-trash"></i> Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    }

    // Interceptar el formulario de Editar para manejar la respuesta JSON
    const formEditarFicha = document.querySelector('#modalEditarFicha form');
    if (formEditarFicha) {
        formEditarFicha.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('is_ajax', '1');
            
            const btnSubmit = this.querySelector('button[type="submit"]');
            const btnHtml = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Guardando...';
            btnSubmit.disabled = true;

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                
                const result = await response.json();
                
                if (result.status === 'success') {
                    // Cerrar el modal
                    const modalInst = bootstrap.Modal.getInstance(document.getElementById('modalEditarFicha'));
                    if (modalInst) modalInst.hide();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Ficha Actualizada',
                        text: 'Recargando información...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = `${URL_ROOT}/index.php?route=fichas/show&id=${result.data.numero_ficha}`;
                    });
                } else {
                    Swal.fire('Error', result.message || 'Error al actualizar', 'error');
                }
            } catch (error) {
                console.error("Fetch Error:", error);
                Swal.fire('Error de Conexión', 'El servidor no respondió a tiempo.', 'error');
            } finally {
                btnSubmit.innerHTML = btnHtml;
                btnSubmit.disabled = false;
            }
        });
    }
});
</script>
<?php endif; ?>
