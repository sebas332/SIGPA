<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Programación Académica y Horarios</h3>
            <p class="text-muted small mb-0">Cronograma general de sesiones, asignación de instructores y aulas</p>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn btn-primary shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearProgramacion">
                <i class="fa-solid fa-plus me-2"></i> Programar Sesión
            </button>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <div class="card-body p-0">
            <?php if (empty($programacion)): ?>
                <div class="p-5 text-center text-muted">
                    <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-secondary"></i>
                    <h5 class="fw-bold">No hay programación académica registrada</h5>
                    <p class="small mb-0">El Coordinador puede asignar clases utilizando la opción de programar sesión.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase py-3">
                            <tr>
                                <th class="ps-4">Ficha</th>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Ambiente</th>
                                <th>Instructor</th>
                                <th>Competencia / RA</th>
                                <th>Progreso</th>
                                <?php if ($current_role === 'Coordinador'): ?>
                                    <th class="text-end pe-4">Acción</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programacion as $prog): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary fs-6">Ficha <?= $prog->numero_ficha; ?></td>
                                    <td><span class="badge bg-dark"><?= $prog->nombre_dia; ?></span></td>
                                    <td class="text-muted small fw-medium"><?= substr($prog->hora_inicio, 0, 5) . ' - ' . substr($prog->hora_fin, 0, 5); ?></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary-emphasis"><?= $prog->ambiente_nombre; ?></span></td>
                                    <td class="text-muted small"><i class="fa-solid fa-user-tie text-primary me-1"></i> <?= $prog->instructor_nombre . ' ' . $prog->instructor_apellido; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark small"><?= $prog->competencia_nombre; ?></div>
                                        <div class="text-muted small" style="max-width: 260px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" title="<?= $prog->ra_descripcion; ?>"><?= $prog->ra_codigo . ' - ' . $prog->ra_descripcion; ?></div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between small text-muted mb-1">
                                            <span><?= $prog->sesiones_realizadas; ?> / <?= $prog->total_sesiones; ?></span>
                                            <span><?= round(($prog->sesiones_realizadas / $prog->total_sesiones) * 100); ?>%</span>
                                        </div>
                                        <div class="progress" style="height: 6px; width: 100px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($prog->sesiones_realizadas / $prog->total_sesiones) * 100; ?>%;"></div>
                                        </div>
                                    </td>
                                    <?php if ($current_role === 'Coordinador'): ?>
                                        <td class="text-end pe-4">
                                            <a href="<?= URLROOT; ?>/index.php?route=programacion/delete&id=<?= $prog->id_programacion; ?>" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('¿Seguro que deseas eliminar esta programación?');" data-bs-toggle="tooltip" title="Eliminar Programación">
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

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Programacion -->
<div class="modal fade" id="modalCrearProgramacion" tabindex="-1" aria-labelledby="modalCrearProgramacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearProgramacionLabel"><i class="fa-solid fa-calendar-days me-2 text-primary"></i>Programar Nueva Sesión Académica</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programacion/create" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="numero_ficha" class="form-label fw-medium text-secondary">Ficha de Formación</label>
                            <select class="form-select form-select-lg" id="numero_ficha" name="numero_ficha" required>
                                <option value="">Selecciona la ficha...</option>
                                <?php foreach ($fichas as $f): ?>
                                    <option value="<?= $f->numero_ficha; ?>">Ficha <?= $f->numero_ficha . ' - ' . $f->programa_nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_usuario" class="form-label fw-medium text-secondary">Instructor</label>
                            <select class="form-select form-select-lg" id="id_usuario" name="id_usuario" required>
                                <option value="">Selecciona al instructor...</option>
                                <?php foreach ($instructores as $inst): ?>
                                    <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_numero_ambiente" class="form-label fw-medium text-secondary">Ambiente de Formación (Disponibles)</label>
                            <select class="form-select form-select-lg" id="id_numero_ambiente" name="id_numero_ambiente" required>
                                <option value="">Selecciona un ambiente...</option>
                                <?php foreach ($ambientes as $amb): ?>
                                    <option value="<?= $amb->id_numero_ambiente; ?>"><?= $amb->nombre . ' (Capacidad: ' . $amb->capacidad . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_dias" class="form-label fw-medium text-secondary">Día de la Semana</label>
                            <select class="form-select form-select-lg" id="id_dias" name="id_dias" required>
                                <option value="">Selecciona el día...</option>
                                <?php foreach ($dias as $d): ?>
                                    <option value="<?= $d->id_dias; ?>"><?= $d->nombre_dia; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="hora_inicio" class="form-label fw-medium text-secondary">Hora de Inicio</label>
                            <input type="time" class="form-control form-control-lg" id="hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hora_fin" class="form-label fw-medium text-secondary">Hora de Fin</label>
                            <input type="time" class="form-control form-control-lg" id="hora_fin" name="hora_fin" required>
                        </div>
                        <div class="col-md-12">
                            <label for="id_resultado_aprendizaje" class="form-label fw-medium text-secondary">Resultado de Aprendizaje (RA)</label>
                            <select class="form-select form-select-lg" id="id_resultado_aprendizaje" name="id_resultado_aprendizaje" required>
                                <option value="">Selecciona el resultado...</option>
                                <?php foreach ($resultados as $ra): ?>
                                    <option value="<?= $ra->id_resultado_aprendizaje; ?>"><?= $ra->codigo . ' - ' . $ra->descripcion; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label fw-medium text-secondary">Fecha de Inicio Estimada</label>
                            <input type="date" class="form-control form-control-lg" id="fecha_inicio" name="fecha_inicio" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Horario</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
