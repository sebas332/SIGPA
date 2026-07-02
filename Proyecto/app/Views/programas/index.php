<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Programas de Formación y Competencias</h3>
            <p class="text-muted small mb-0">Administración curricular, resultados de aprendizaje y validación de triggers / SP</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <?php if ($current_role === 'Coordinador'): ?>
                <button type="button" class="btn btn-primary shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearPrograma">
                    <i class="fa-solid fa-plus me-1"></i> Programa
                </button>
                <button type="button" class="btn btn-success shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearCompetencia">
                    <i class="fa-solid fa-book-medical me-1"></i> Competencia
                </button>
                <button type="button" class="btn btn-warning shadow-sm fw-medium text-dark" data-bs-toggle="modal" data-bs-target="#modalCrearResultado">
                    <i class="fa-solid fa-file-pen me-1"></i> Resultado (RA)
                </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pestañas de navegación -->
    <ul class="nav nav-tabs mb-4 border-bottom-0" id="programasTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold px-4" id="programas-tab" data-bs-toggle="tab" data-bs-target="#programas" type="button" role="tab" aria-controls="programas" aria-selected="true">
                <i class="fa-solid fa-graduation-cap me-2 text-primary"></i> Programas de Formación
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4" id="competencias-tab" data-bs-toggle="tab" data-bs-target="#competencias" type="button" role="tab" aria-controls="competencias" aria-selected="false">
                <i class="fa-solid fa-book-bookmark me-2 text-success"></i> Competencias & Validación (SP)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4" id="resultados-tab" data-bs-toggle="tab" data-bs-target="#resultados" type="button" role="tab" aria-controls="resultados" aria-selected="false">
                <i class="fa-solid fa-list-check me-2 text-warning"></i> Resultados de Aprendizaje
            </button>
        </li>
    </ul>

    <!-- Contenido Pestañas -->
    <div class="tab-content" id="programasTabContent">
        <!-- Pestaña Programas -->
        <div class="tab-pane fade show active" id="programas" role="tabpanel" aria-labelledby="programas-tab">
            <div class="card shadow-sm border-0 rounded-4 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase py-3">
                                <tr>
                                    <th class="ps-4">Código</th>
                                    <th>Nombre del Programa</th>
                                    <th>Tipo</th>
                                    <th>Versión</th>
                                    <th>Vigencia</th>
                                    <th class="pe-4">Duración Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($programas as $prog): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-primary"><?= $prog->codigo; ?></td>
                                        <td><div class="fw-bold text-dark"><?= $prog->nombre; ?></div></td>
                                        <td><span class="badge bg-dark"><?= $prog->tipo_nombre; ?></span></td>
                                        <td><span class="badge bg-secondary"><?= $prog->version; ?></span></td>
                                        <td><?= $prog->vigencia; ?></td>
                                        <td class="pe-4 text-muted small">
                                            Lectiva: <?= $prog->duracion_lectiva; ?> hrs <br>
                                            Práctica: <?= $prog->duracion_practica; ?> hrs
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pestaña Competencias -->
        <div class="tab-pane fade" id="competencias" role="tabpanel" aria-labelledby="competencias-tab">
            <div class="card shadow-sm border-0 rounded-4 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase py-3">
                                <tr>
                                    <th class="ps-4">Código</th>
                                    <th>Competencia</th>
                                    <th>Programa</th>
                                    <th>Horas Totales</th>
                                    <th>Sesiones Calculadas (Triggers)</th>
                                    <th class="text-end pe-4">Procedimiento Almacenado (SP)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($competencias as $comp): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-success"><?= $comp->codigo; ?></td>
                                        <td><div class="fw-bold text-dark small"><?= $comp->nombre; ?></div></td>
                                        <td><div class="text-muted small"><?= $comp->programa_nombre; ?></div></td>
                                        <td><span class="badge bg-light text-dark border"><?= $comp->horas_totales; ?> hrs</span></td>
                                        <td>
                                            <span class="badge bg-primary px-3 py-1"><?= $comp->total_sesiones; ?> sesiones</span>
                                            <div class="text-muted small mt-1">Horas a ejecutar: <?= $comp->horas_a_ejecutar; ?> (<?= $comp->porcentaje; ?>%)</div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <?php if ($current_role === 'Coordinador'): ?>
                                                <a href="<?= URLROOT; ?>/index.php?route=programas/validarSesiones&id=<?= $comp->id_competencia; ?>" class="btn btn-outline-info btn-sm shadow-sm fw-medium">
                                                    <i class="fa-solid fa-gears me-1"></i> Validar Sesiones (SP)
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pestaña Resultados -->
        <div class="tab-pane fade" id="resultados" role="tabpanel" aria-labelledby="resultados-tab">
            <div class="card shadow-sm border-0 rounded-4 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase py-3">
                                <tr>
                                    <th class="ps-4">Código RA</th>
                                    <th>Competencia Asociada</th>
                                    <th>Descripción</th>
                                    <th class="pe-4">Sesiones Asignadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultados as $ra): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-warning-emphasis"><?= $ra->codigo; ?></td>
                                        <td><div class="fw-bold text-dark small"><?= $ra->competencia_nombre; ?></div></td>
                                        <td><div class="text-muted small"><?= $ra->descripcion; ?></div></td>
                                        <td class="pe-4"><span class="badge bg-secondary-subtle text-secondary-emphasis px-3 py-1"><?= $ra->sesiones_asignadas; ?> sesiones</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Programa -->
<div class="modal fade" id="modalCrearPrograma" tabindex="-1" aria-labelledby="modalCrearProgramaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearProgramaLabel"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i>Registrar Programa de Formación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/create" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Programa</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Producción Multimedia" required>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo" class="form-label fw-medium text-secondary">Código</label>
                            <input type="text" class="form-control form-control-lg" id="codigo" name="codigo" placeholder="Ej. 228190" required>
                        </div>
                        <div class="col-md-4">
                            <label for="id_tipo_programa" class="form-label fw-medium text-secondary">Tipo de Programa</label>
                            <select class="form-select form-select-lg" id="id_tipo_programa" name="id_tipo_programa" required>
                                <?php foreach ($tipos as $tp): ?>
                                    <option value="<?= $tp->id_tipo_programa; ?>"><?= $tp->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="version" class="form-label fw-medium text-secondary">Versión</label>
                            <input type="text" class="form-control form-control-lg" id="version" name="version" placeholder="Ej. V1" value="V1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="vigencia" class="form-label fw-medium text-secondary">Vigencia</label>
                            <input type="text" class="form-control form-control-lg" id="vigencia" name="vigencia" placeholder="Ej. 2026" value="2026" required>
                        </div>
                        <div class="col-md-6">
                            <label for="duracion_lectiva" class="form-label fw-medium text-secondary">Duración Lectiva (Horas)</label>
                            <input type="number" class="form-control form-control-lg" id="duracion_lectiva" name="duracion_lectiva" placeholder="Ej. 3120" required>
                        </div>
                        <div class="col-md-6">
                            <label for="duracion_practica" class="form-label fw-medium text-secondary">Duración Práctica (Horas)</label>
                            <input type="number" class="form-control form-control-lg" id="duracion_practica" name="duracion_practica" placeholder="Ej. 864" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Programa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Crear Competencia -->
<div class="modal fade" id="modalCrearCompetencia" tabindex="-1" aria-labelledby="modalCrearCompetenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearCompetenciaLabel"><i class="fa-solid fa-book-medical me-2 text-success"></i>Registrar Competencia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/createCompetencia" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="id_programa_comp" class="form-label fw-medium text-secondary">Programa de Formación</label>
                            <select class="form-select form-select-lg" id="id_programa_comp" name="id_programa" required>
                                <option value="">Selecciona un programa...</option>
                                <?php foreach ($programas as $prog): ?>
                                    <option value="<?= $prog->id_programa; ?>"><?= $prog->nombre . ' (' . $prog->codigo . ')'; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="nombre_comp" class="form-label fw-medium text-secondary">Nombre de la Competencia</label>
                            <input type="text" class="form-control form-control-lg" id="nombre_comp" name="nombre" placeholder="Ej. Programar aplicaciones web" required>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo_comp" class="form-label fw-medium text-secondary">Código Competencia</label>
                            <input type="text" class="form-control form-control-lg" id="codigo_comp" name="codigo" placeholder="Ej. 220501099" required>
                        </div>
                        <div class="col-md-4">
                            <label for="horas_totales" class="form-label fw-medium text-secondary">Horas Totales</label>
                            <input type="number" class="form-control form-control-lg" id="horas_totales" name="horas_totales" placeholder="Ej. 180" required>
                        </div>
                        <div class="col-md-4">
                            <label for="resultados_totales" class="form-label fw-medium text-secondary">Resultados Totales (RA)</label>
                            <input type="number" class="form-control form-control-lg" id="resultados_totales" name="resultados_totales" placeholder="Ej. 3" required>
                        </div>
                        <div class="col-md-4">
                            <label for="porcentaje" class="form-label fw-medium text-secondary">Porcentaje (%)</label>
                            <input type="number" class="form-control form-control-lg" id="porcentaje" name="porcentaje" placeholder="Ej. 100" value="100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Competencia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Crear Resultado -->
<div class="modal fade" id="modalCrearResultado" tabindex="-1" aria-labelledby="modalCrearResultadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearResultadoLabel"><i class="fa-solid fa-file-pen me-2 text-warning"></i>Registrar Resultado de Aprendizaje</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/createResultado" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="id_competencia" class="form-label fw-medium text-secondary">Competencia Asociada</label>
                            <select class="form-select form-select-lg" id="id_competencia" name="id_competencia" required>
                                <option value="">Selecciona una competencia...</option>
                                <?php foreach ($competencias as $comp): ?>
                                    <option value="<?= $comp->id_competencia; ?>"><?= $comp->codigo . ' - ' . $comp->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo_ra" class="form-label fw-medium text-secondary">Código RA</label>
                            <input type="text" class="form-control form-control-lg" id="codigo_ra" name="codigo" placeholder="Ej. RA-05" required>
                        </div>
                        <div class="col-md-8">
                            <label for="sesiones_asignadas" class="form-label fw-medium text-secondary">Sesiones Asignadas (Opcional - Calcula Trigger)</label>
                            <input type="number" class="form-control form-control-lg" id="sesiones_asignadas" name="sesiones_asignadas" placeholder="Deja vacío para cálculo automático">
                        </div>
                        <div class="col-md-12">
                            <label for="descripcion_ra" class="form-label fw-medium text-secondary">Descripción del Resultado</label>
                            <textarea class="form-control form-control-lg" id="descripcion_ra" name="descripcion" rows="4" placeholder="Ej. Implementar interfaces seguras y responsivas..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning fw-bold shadow-sm text-dark"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Resultado</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
