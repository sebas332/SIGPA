<?php
/**
 * Vista show.php (Detalle de Programa de Formación)
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_role = $current_role ?? $_SESSION['current_role'] ?? 'Aprendiz';

// Obtener nombre del tipo de programa (ya viene cargado en $tipos)
$tipo_nombre = '';
foreach ($tipos as $t) {
    if ($t->id_tipo_programa == $programa->id_tipo_programa) {
        $tipo_nombre = $t->nombre;
        break;
    }
}
?>

<style>
    :root {
        --sena-primary: #39A900;
        --sena-primary-hover: #2e8800;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        --card-shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.08);
        --border-radius-lg: 16px;
        --border-radius-md: 12px;
    }

    .detail-container {
        font-family: 'Inter', sans-serif;
        background-color: #fafbfc;
        padding-bottom: 4rem;
    }

    /* Tarjeta de Encabezado Principal */
    .detail-header-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        padding: 1.8rem 2.5rem;
        border: 1px solid rgba(0, 0, 0, 0.04);
        margin-bottom: 2rem;
    }
    .btn-back-sena {
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 0.35rem 1rem;
        font-size: 0.82rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }
    .btn-back-sena:hover {
        background-color: #e5e7eb;
        color: #1f2937;
    }
    .detail-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.25rem;
    }
    .detail-subtitle {
        font-size: 0.95rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn-edit-programa {
        background-color: #ea580c;
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 20px;
        padding: 0.5rem 1.25rem;
        font-size: 0.88rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 88, 12, 0.15);
    }
    .btn-edit-programa:hover {
        background-color: #d97706;
        color: #ffffff;
    }
    .btn-delete-programa-text {
        background-color: #fef2f2;
        color: #dc2626;
        font-weight: 600;
        border: 1px solid #fecaca;
        border-radius: 20px;
        padding: 0.5rem 1.25rem;
        font-size: 0.88rem;
        transition: all 0.2s ease;
    }
    .btn-delete-programa-text:hover {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    /* Tarjetas de Información General y Aprendices */
    .content-panel-card {
        background-color: #ffffff;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(0, 0, 0, 0.04);
        padding: 1.8rem;
        height: 100%;
    }
    .panel-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .panel-title i {
        color: var(--sena-primary);
    }
    
    /* Filas de Información General */
    .info-row {
        background-color: #f9fafb;
        border-radius: var(--border-radius-md);
        padding: 1rem 1.25rem;
        margin-bottom: 0.8rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f3f4f6;
    }
    .info-row-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-row-val {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Lista de Competencias */
    .btn-matricular-small {
        background-color: #e6f6df;
        color: var(--sena-primary);
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid var(--sena-light-green);
        border-radius: 20px;
        padding: 0.35rem 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-matricular-small:hover {
        background-color: var(--sena-primary);
        color: #ffffff;
    }
    .competencia-list-wrapper {
        max-height: 480px;
        overflow-y: auto;
        padding-right: 0.25rem;
    }
    .competencia-row {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        padding: 0.85rem 1.1rem;
        margin-bottom: 0.75rem;
        transition: border 0.15s ease;
    }
    .competencia-row:hover {
        border-color: var(--sena-primary);
    }
    .competencia-name {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.1rem;
    }
    .competencia-meta {
        font-size: 0.75rem;
        color: #6b7280;
    }
</style>

<div class="detail-container container-fluid px-0">

    <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn-back-sena">
        <i class="fa-solid fa-arrow-left"></i> Volver a Programas
    </a>

    <!-- Encabezado Principal -->
    <div class="detail-header-card d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <div class="detail-title">Detalle de Programa: <?= htmlspecialchars($programa->codigo); ?></div>
            <div class="detail-subtitle">
                <span><?= htmlspecialchars($programa->nombre); ?></span>
                <span>•</span>
                <span>Versión: <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill" style="font-size: 0.72rem;"><?= htmlspecialchars($programa->version); ?></span></span>
                <span>•</span>
                <span>Vigencia: <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill" style="font-size: 0.72rem;"><?= htmlspecialchars($programa->vigencia); ?></span></span>
            </div>
        </div>
        
        <?php if ($current_role === 'Coordinador'): ?>
            <div class="d-flex gap-2">
                <button type="button" class="btn-edit-programa" data-bs-toggle="modal" data-bs-target="#modalEditarProgramaLocal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg> Editar Programa
                </button>
                <button type="button" class="btn-delete-programa-text btn-delete-programa-action" 
                        data-programa="<?= $programa->codigo; ?>" 
                        data-url="<?= URLROOT; ?>/index.php?route=programas/delete&id=<?= $programa->id_programa; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill me-1" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                    </svg> Eliminar Programa
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Primera Fila: Información General y Competencias -->
    <div class="row g-4 mb-4">
        <!-- Información General -->
        <div class="col-12 col-lg-5">
            <div class="content-panel-card">
                <div class="panel-title"><i class="fa-solid fa-circle-info"></i> Información General</div>
                
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-hashtag"></i> Código del Programa</span>
                    <span class="info-row-val"><?= htmlspecialchars($programa->codigo); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-tags"></i> Tipo de Programa</span>
                    <span class="info-row-val"><?= htmlspecialchars($tipo_nombre); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-code-branch"></i> Versión</span>
                    <span class="info-row-val"><?= htmlspecialchars($programa->version); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-row-label"><i class="fa-solid fa-calendar-check"></i> Vigencia</span>
                    <span class="info-row-val"><?= htmlspecialchars($programa->vigencia); ?></span>
                </div>
                <div class="info-row" style="background-color: #fffbeb; border-color: #fef3c7;">
                    <span class="info-row-label text-warning" style="color: #b45309;"><i class="fa-solid fa-clock"></i> Duración Lectiva</span>
                    <span class="info-row-val" style="color: #b45309;"><?= $programa->duracion_lectiva; ?> hrs</span>
                </div>
                <div class="info-row" style="background-color: #fef2f2; border-color: #fee2e2;">
                    <span class="info-row-label text-danger" style="color: #b91c1c;"><i class="fa-solid fa-briefcase"></i> Duración Práctica</span>
                    <span class="info-row-val" style="color: #b91c1c;"><?= $programa->duracion_practica; ?> hrs</span>
                </div>
                <div class="info-row" style="background-color: #e2f6e9; border-color: #c3e6cb;">
                    <span class="info-row-label text-success" style="color: #157347;"><i class="fa-solid fa-layer-group"></i> Duración Total</span>
                    <span class="info-row-val" style="color: #157347;"><?= ($programa->duracion_lectiva + $programa->duracion_practica); ?> hrs</span>
                </div>
            </div>
        </div>

        <!-- Competencias Asociadas -->
        <div class="col-12 col-lg-7">
            <div class="content-panel-card">
                <div class="panel-header d-flex justify-content-between align-items-center mb-4">
                    <div class="panel-title mb-0"><i class="fa-solid fa-book-bookmark"></i> Competencias y Resultados (<?= count($competencias); ?>)</div>
                    <?php if ($current_role === 'Coordinador'): ?>
                        <button type="button" class="btn-matricular-small" data-bs-toggle="modal" data-bs-target="#modalAsociarCompetencias">
                            <i class="fa-solid fa-plus me-1"></i> Asociar Competencias
                        </button>
                    <?php endif; ?>
                </div>

                <div class="competencia-list-wrapper">
                    <?php if (empty($competencias)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary"></i>
                            <h6 class="fw-bold">No hay competencias asociadas a este programa</h6>
                            <p class="small mb-0">Utiliza la opción de asociar competencias para agregar contenido curricular.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($competencias as $comp): ?>
                            <div class="competencia-row">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="competencia-name text-success"><i class="fa-solid fa-bookmark me-1"></i> <?= htmlspecialchars($comp->codigo); ?> - <?= htmlspecialchars($comp->nombre); ?></div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-dark border"><?= $comp->horas_totales; ?> hrs</span>
                                        <?php if ($current_role === 'Coordinador'): ?>
                                            <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 btn-desvincular-comp shadow-sm border-0" data-id="<?= $comp->id_competencia; ?>" data-codigo="<?= htmlspecialchars($comp->codigo); ?>" title="Desvincular Competencia">
                                                <i class="fa-solid fa-link-slash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="competencia-meta">
                                    <?php 
                                    $ra_list = $resultados[$comp->id_competencia] ?? [];
                                    if (empty($ra_list)): ?>
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Sin resultados de aprendizaje</span>
                                    <?php else: ?>
                                        <div class="mt-2 p-2 bg-light rounded">
                                            <strong>Resultados de Aprendizaje:</strong>
                                            <ul class="mb-0 mt-1 ps-3">
                                                <?php foreach ($ra_list as $ra): ?>
                                                    <li><?= htmlspecialchars($ra->codigo); ?>: <?= htmlspecialchars($ra->descripcion); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Asociar Competencias -->
<div class="modal fade" id="modalAsociarCompetencias" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <div class="modal-header bg-white border-bottom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success-subtle rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-link text-success fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0">Asociar Competencias</h5>
                        <p class="mb-0 small text-secondary">Selecciona las competencias a vincular con este programa.</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="mb-3">
                    <div class="input-group input-group-lg shadow-sm rounded-3">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-search"></i></span>
                        <input type="text" id="buscarCompetenciaInput" class="form-control border-start-0" placeholder="Buscar por nombre o código...">
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-4" id="listaCompetenciasAsociar" style="max-height: 40vh; overflow-y: auto;">
                            <?php if (empty($competenciasDisponibles)): ?>
                                <li class="list-group-item p-4 text-center text-muted">
                                    <i class="fa-solid fa-check-circle fs-3 mb-2 text-success"></i><br>
                                    Todas las competencias ya están asociadas.
                                </li>
                            <?php else: ?>
                                <?php foreach($competenciasDisponibles as $cd): ?>
                                    <li class="list-group-item d-flex align-items-center p-3 comp-item-asociar">
                                        <input class="form-check-input me-3 fs-5 checkbox-comp-asociar" type="checkbox" value="<?= $cd->id_competencia; ?>" id="comp_<?= $cd->id_competencia; ?>">
                                        <label class="form-check-label w-100 cursor-pointer d-flex justify-content-between align-items-center" for="comp_<?= $cd->id_competencia; ?>">
                                            <div>
                                                <span class="fw-bold d-block text-dark comp-nombre-asociar"><?= htmlspecialchars($cd->nombre); ?></span>
                                                <small class="text-secondary comp-codigo-asociar">Código: <?= htmlspecialchars($cd->codigo); ?></small>
                                            </div>
                                            <span class="badge bg-light text-dark border"><?= $cd->horas_totales; ?> hrs</span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-top p-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-light fw-medium shadow-sm px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success fw-medium shadow-sm px-4" id="btnGuardarAsociacion">
                    <i class="fa-solid fa-save me-1"></i> Asociar Seleccionadas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Programa (Local) -->
<div class="modal fade" id="modalEditarProgramaLocal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <div class="modal-header bg-success text-white p-4 border-0 position-relative">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-pen-to-square text-success fs-4"></i>
                    </div>
                    <div>
                        <h4 class="modal-title fw-bold mb-1">Editar Programa Formativo</h4>
                        <p class="mb-0 small text-white-50">Actualiza los datos del programa seleccionado.</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-4 me-4" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0 position-relative" style="background: #ffffff;">
                <form action="<?= URLROOT; ?>/index.php?route=programas/updateCompleto" method="POST" id="formEditarProgramaLocal">
                    <input type="hidden" name="id_programa" value="<?= $programa->id_programa; ?>">
                    <input type="hidden" name="is_modal" value="0">
                    <input type="hidden" name="from_show" value="1">
                    
                    <div class="p-4 p-md-5">
                        <div class="row g-4">
                            <!-- Nombre del Programa -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-book text-success me-2"></i> Nombre del Programa</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="nombre" placeholder="Ej. Producción Multimedia" value="<?= htmlspecialchars($programa->nombre); ?>" required>
                            </div>
                            
                            <!-- Código y Tipo -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-hashtag text-success me-2"></i> Código</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="codigo" placeholder="Ej. 228190" value="<?= htmlspecialchars($programa->codigo); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-tags text-success me-2"></i> Tipo de Programa</label>
                                <select class="form-select form-select-lg rounded-3" name="id_tipo_programa" required>
                                    <option value="" disabled>Selecciona un tipo...</option>
                                    <?php if(isset($tipos)): foreach($tipos as $t): ?>
                                        <option value="<?= $t->id_tipo_programa; ?>" <?= ($programa->id_tipo_programa == $t->id_tipo_programa) ? 'selected' : ''; ?>><?= htmlspecialchars($t->nombre); ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            
                            <!-- Versión y Vigencia -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-code-branch text-success me-2"></i> Versión</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="version" placeholder="Ej. V1" value="<?= htmlspecialchars($programa->version); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-calendar-check text-success me-2"></i> Vigencia</label>
                                <input type="text" class="form-control form-control-lg rounded-3" name="vigencia" placeholder="Ej. 2026" value="<?= htmlspecialchars($programa->vigencia); ?>" required>
                            </div>
                            
                            <!-- Duraciones -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-clock text-success me-2"></i> Duración Lectiva (hrs)</label>
                                <input type="number" class="form-control form-control-lg rounded-3" name="duracion_lectiva" placeholder="Ej. 3120" value="<?= htmlspecialchars($programa->duracion_lectiva); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-briefcase text-success me-2"></i> Duración Práctica (hrs)</label>
                                <input type="number" class="form-control form-control-lg rounded-3" name="duracion_practica" placeholder="Ej. 864" value="<?= htmlspecialchars($programa->duracion_practica); ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer p-4 border-top-0 d-flex justify-content-end gap-2 bg-light">
                        <button type="button" class="btn btn-light border rounded-pill px-4 fw-bold text-secondary" data-bs-dismiss="modal">
                            <i class="fa-regular fa-circle-xmark me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ==============================================
     SCRIPTS DE CONFIRMACIÓN (DETAIL)
     ============================================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Alerta de Eliminación de Programa Completo
    const btnDelete = document.querySelector('.btn-delete-programa-action');
    if (btnDelete) {
        btnDelete.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const numProg = this.getAttribute('data-programa');

            Swal.fire({
                title: `¿Eliminar Programa #${numProg}?`,
                text: "Se eliminará de forma permanente. Esto no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Sí, eliminar programa',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    }

    // Buscador de competencias en modal
    const searchInput = document.getElementById('buscarCompetenciaInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const items = document.querySelectorAll('.comp-item-asociar');
            items.forEach(item => {
                const nombre = item.querySelector('.comp-nombre-asociar').textContent.toLowerCase();
                const codigo = item.querySelector('.comp-codigo-asociar').textContent.toLowerCase();
                if (nombre.includes(filter) || codigo.includes(filter)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // Guardar Asociación Vía AJAX
    const btnGuardarAsociacion = document.getElementById('btnGuardarAsociacion');
    if (btnGuardarAsociacion) {
        btnGuardarAsociacion.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.checkbox-comp-asociar:checked');
            if (checkboxes.length === 0) {
                Swal.fire('Atención', 'Selecciona al menos una competencia para asociar.', 'warning');
                return;
            }

            const competenciasIds = Array.from(checkboxes).map(cb => cb.value);
            const idPrograma = <?= $programa->id_programa; ?>;

            const formData = new FormData();
            formData.append('id_programa', idPrograma);
            competenciasIds.forEach(id => formData.append('competencias[]', id));

            fetch('<?= URLROOT; ?>/index.php?route=programas/asociarCompetencias', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('¡Éxito!', data.message, 'success').then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Ocurrió un error en la solicitud AJAX.', 'error');
            });
        });
    }

    // Desvincular Competencia
    const btnDesvincular = document.querySelectorAll('.btn-desvincular-comp');
    btnDesvincular.forEach(btn => {
        btn.addEventListener('click', function() {
            const idComp = this.getAttribute('data-id');
            const codigoComp = this.getAttribute('data-codigo');
            const idPrograma = <?= $programa->id_programa; ?>;

            Swal.fire({
                title: `¿Desvincular competencia ${codigoComp}?`,
                text: "La competencia no será eliminada del sistema, solo se desvinculará de este programa.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-link-slash me-1"></i> Sí, desvincular',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('id_programa', idPrograma);
                    formData.append('id_competencia', idComp);

                    fetch('<?= URLROOT; ?>/index.php?route=programas/desvincularCompetencia', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', data.message, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Error', 'Ocurrió un error en la solicitud AJAX.', 'error');
                    });
                }
            });
        });
    });
});
</script>
