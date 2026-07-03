<div class="container-fluid px-0">
    <!-- Encabezado de la página -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Editor Curricular Integrado</h3>
            <p class="text-muted small mb-0">Edita el programa de formación, competencias y resultados de aprendizaje.</p>
        </div>
        <?php if (!$isModal): ?>
        <div class="mt-3 mt-md-0">
            <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-outline-secondary rounded-pill px-4 fw-medium shadow-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Formulario Principal -->
    <form action="<?= URLROOT; ?>/index.php?route=programas/updateCompleto" method="POST" id="formEditarCompleto">
        <input type="hidden" name="id_programa" value="<?= $programa->id_programa; ?>">
        <input type="hidden" name="is_modal" value="<?= $isModal ? 1 : 0; ?>">
        
        <div class="row">
            <!-- Bloque del Programa de Formación (Izquierda) -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                        <i class="fa-solid fa-graduation-cap text-primary me-2"></i> Datos del Programa
                    </h5>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Programa</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Análisis y Desarrollo de Software" value="<?= htmlspecialchars($programa->nombre); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="codigo" class="form-label fw-medium text-secondary">Código del Programa</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ej. 228118" value="<?= htmlspecialchars($programa->codigo); ?>" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="version" class="form-label fw-medium text-secondary">Versión</label>
                            <input type="text" class="form-control" id="version" name="version" placeholder="Ej. V1" value="<?= htmlspecialchars($programa->version); ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="vigencia" class="form-label fw-medium text-secondary">Vigencia</label>
                            <input type="text" class="form-control" id="vigencia" name="vigencia" placeholder="Ej. 2026" value="<?= htmlspecialchars($programa->vigencia); ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_tipo_programa" class="form-label fw-medium text-secondary">Tipo de Programa</label>
                        <select class="form-select" id="id_tipo_programa" name="id_tipo_programa" required>
                            <?php foreach ($tipos as $tp): ?>
                                <option value="<?= $tp->id_tipo_programa; ?>" <?= ($programa->id_tipo_programa == $tp->id_tipo_programa) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($tp->nombre); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="duracion_lectiva" class="form-label fw-medium text-secondary">Duración Lectiva (hrs)</label>
                            <input type="number" class="form-control" id="duracion_lectiva" name="duracion_lectiva" placeholder="Ej. 3120" value="<?= $programa->duracion_lectiva; ?>" required>
                        </div>
                        <div class="col-6">
                            <label for="duracion_practica" class="form-label fw-medium text-secondary">Duración Práctica (hrs)</label>
                            <input type="number" class="form-control" id="duracion_practica" name="duracion_practica" placeholder="Ej. 864" value="<?= $programa->duracion_practica; ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloque de Competencias y Resultados (Derecha Dinámica) -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h5 class="fw-bold text-dark m-0">
                            <i class="fa-solid fa-book-bookmark text-success me-2"></i> Competencias y Resultados
                        </h5>
                        <button type="button" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" onclick="agregarCompetencia()">
                            <i class="fa-solid fa-plus me-1"></i> Agregar Competencia
                        </button>
                    </div>

                    <!-- Contenedor de Competencias Dinámicas -->
                    <div id="competencias-container" class="flex-grow-1 mb-4">
                        <!-- Las competencias se inyectarán aquí mediante JS -->
                    </div>

                    <!-- Botones de Acción final -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <?php if ($isModal): ?>
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancelar</button>
                        <?php else: ?>
                            <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">Cancelar</a>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Plantilla Oculta de Competencia (HTML) -->
<template id="comp-template">
    <div class="card border rounded-4 bg-light-subtle mb-4 comp-block shadow-sm" data-comp-idx="{comp-idx}">
        <input type="hidden" name="competencias[{comp-idx}][id_competencia]" class="comp-id" value="{comp-id}">
        <div class="card-header bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center py-3 px-4 border-0">
            <h6 class="m-0 fw-bold"><i class="fa-solid fa-book-bookmark text-success me-2"></i> Competencia #<span class="comp-number">{comp-number}</span></h6>
            <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle text-white" onclick="eliminarCompetencia(this)" title="Eliminar Competencia">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
        <div class="card-body p-4 bg-white rounded-bottom-4">
            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="text-secondary small fw-bold mb-1">Nombre de la Competencia</label>
                    <input type="text" name="competencias[{comp-idx}][nombre]" class="form-control comp-nombre" placeholder="Ej. Estructurar el modelo de base de datos" value="{comp-nombre-val}" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Código Competencia</label>
                    <input type="text" name="competencias[{comp-idx}][codigo]" class="form-control comp-codigo" placeholder="Ej. 220501095" value="{comp-codigo-val}" required>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Horas Totales</label>
                    <input type="number" name="competencias[{comp-idx}][horas_totales]" class="form-control comp-horas-totales" placeholder="Ej. 180" value="{comp-horas-val}" oninput="calcularCompetenciaFila({comp-idx})" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Resultados Totales (RA)</label>
                    <input type="number" name="competencias[{comp-idx}][resultados_totales]" class="form-control comp-resultados-totales" placeholder="Ej. 3" value="{comp-resultados-val}" oninput="calcularCompetenciaFila({comp-idx})" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Porcentaje (%)</label>
                    <input type="number" name="competencias[{comp-idx}][porcentaje]" class="form-control comp-porcentaje" placeholder="Ej. 100" value="{comp-porcentaje-val}" oninput="calcularCompetenciaFila({comp-idx})" required>
                </div>
            </div>

            <!-- Resumen Informativo de Cálculos -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-muted small fw-bold">Horas a Ejecutar</span>
                            <h5 class="m-0 fw-bold text-success comp-val-horas-ejecutar">0 hrs</h5>
                        </div>
                        <i class="fa-solid fa-clock text-success fs-3 opacity-25"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-muted small fw-bold">Total Sesiones (de 6 horas)</span>
                            <h5 class="m-0 fw-bold text-primary comp-val-total-sesiones">0 sesiones</h5>
                        </div>
                        <i class="fa-solid fa-calendar-days text-primary fs-3 opacity-25"></i>
                    </div>
                </div>
            </div>

            <!-- Subsección Resultados de Aprendizaje -->
            <div class="border-top pt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark m-0"><i class="fa-solid fa-list-check text-warning-emphasis me-2"></i> Resultados de Aprendizaje (RAP)</h6>
                    <button type="button" class="btn btn-outline-warning text-dark fw-bold btn-sm rounded-pill px-3" onclick="agregarResultado({comp-idx})">
                        <i class="fa-solid fa-plus me-1"></i> Agregar RAP
                    </button>
                </div>

                <!-- Contenedor Dinámico de RAs de esta Competencia -->
                <div class="resultados-container list-group list-group-flush mb-3">
                    <!-- Los resultados se inyectarán aquí mediante JS -->
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Plantilla Oculta de Resultado (HTML) -->
<template id="res-template">
    <div class="list-group-item bg-light-subtle rounded-3 p-3 border mb-2 res-block d-flex flex-column gap-2" data-res-idx="{res-idx}">
        <input type="hidden" name="competencias[{comp-idx}][resultados][{res-idx}][id_resultado]" class="res-id" value="{res-id}">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <label class="text-muted small fw-bold mb-1">Código RAP</label>
                <input type="text" name="competencias[{comp-idx}][resultados][{res-idx}][codigo]" class="form-control form-control-sm res-codigo" placeholder="Ej. RA-01" value="{res-codigo-val}" required>
            </div>
            <div class="col-md-7">
                <label class="text-muted small fw-bold mb-1">Sesiones Asignadas (Vacío para automático)</label>
                <input type="number" name="competencias[{comp-idx}][resultados][{res-idx}][sesiones_asignadas]" class="form-control form-control-sm res-sesiones" placeholder="Sugerido: {sugerido}" value="{res-sesiones-val}" oninput="calcularCompetenciaFila({comp-idx})">
            </div>
            <div class="col-md-2 text-end mt-3">
                <button type="button" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="eliminarResultado(this, {comp-idx})" title="Eliminar RAP">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="row g-2">
            <div class="col-12">
                <label class="text-muted small fw-bold mb-1">Descripción del Resultado de Aprendizaje</label>
                <textarea name="competencias[{comp-idx}][resultados][{res-idx}][descripcion]" class="form-control form-control-sm res-descripcion" rows="2" placeholder="Ej. Construir las tablas con llaves foráneas..." required>{res-desc-val}</textarea>
            </div>
        </div>
    </div>
</template>

<script>
var compCounter = 0;

function agregarCompetencia(data = null) {
    const container = document.getElementById('competencias-container');
    const template = document.getElementById('comp-template').innerHTML;
    const compIdx = compCounter++;
    const compNum = container.children.length + 1;

    let html = template
        .replace(/\{comp-idx\}/g, compIdx)
        .replace(/\{comp-number\}/g, compNum)
        .replace(/\{comp-id\}/g, data ? data.id_competencia : '')
        .replace(/\{comp-nombre-val\}/g, data ? data.nombre : '')
        .replace(/\{comp-codigo-val\}/g, data ? data.codigo : '')
        .replace(/\{comp-horas-val\}/g, data ? data.horas_totales : '')
        .replace(/\{comp-resultados-val\}/g, data ? data.resultados_totales : '')
        .replace(/\{comp-porcentaje-val\}/g, data ? data.porcentaje : '100');

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    container.appendChild(tempDiv.firstElementChild);

    if (data && data.resultados && data.resultados.length > 0) {
        data.resultados.forEach(res => agregarResultado(compIdx, res));
    } else if (!data) {
        agregarResultado(compIdx);
    }
    calcularCompetenciaFila(compIdx);
}

function eliminarCompetencia(btn) {
    if (confirm('¿Eliminar esta competencia y sus resultados?')) {
        btn.closest('.comp-block').remove();
        reindexarCompetencias();
    }
}

function reindexarCompetencias() {
    document.querySelectorAll('#competencias-container .comp-block').forEach((block, idx) => {
        block.querySelector('.comp-number').innerText = idx + 1;
    });
}

function agregarResultado(compIdx, data = null) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    if (!compBlock) return;

    const resContainer = compBlock.querySelector('.resultados-container');
    const template = document.getElementById('res-template').innerHTML;
    const resIdx = resContainer.children.length;

    let html = template
        .replace(/\{comp-idx\}/g, compIdx)
        .replace(/\{res-idx\}/g, resIdx)
        .replace(/\{sugerido\}/g, 'Automático')
        .replace(/\{res-id\}/g, data ? data.id_resultado : '')
        .replace(/\{res-codigo-val\}/g, data ? data.codigo : '')
        .replace(/\{res-sesiones-val\}/g, (data && data.sesiones_asignadas !== null) ? data.sesiones_asignadas : '')
        .replace(/\{res-desc-val\}/g, data ? data.descripcion : '');

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    resContainer.appendChild(tempDiv.firstElementChild);
    calcularCompetenciaFila(compIdx);
}

function eliminarResultado(btn, compIdx) {
    btn.closest('.res-block').remove();
    reindexarResultados(compIdx);
    calcularCompetenciaFila(compIdx);
}

function reindexarResultados(compIdx) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    const resBlocks = compBlock.querySelectorAll('.res-block');
    resBlocks.forEach((block, idx) => {
        block.setAttribute('data-res-idx', idx);
        const idInput = block.querySelector('.res-id');
        const codigoInput = block.querySelector('.res-codigo');
        const sesionesInput = block.querySelector('.res-sesiones');
        const descInput = block.querySelector('.res-descripcion');
        
        if (idInput) idInput.name = `competencias[${compIdx}][resultados][${idx}][id_resultado]`;
        if (codigoInput) codigoInput.name = `competencias[${compIdx}][resultados][${idx}][codigo]`;
        if (sesionesInput) sesionesInput.name = `competencias[${compIdx}][resultados][${idx}][sesiones_asignadas]`;
        if (descInput) descInput.name = `competencias[${compIdx}][resultados][${idx}][descripcion]`;
    });
}

function calcularCompetenciaFila(compIdx) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    if (!compBlock) return;

    const horasTotales = parseFloat(compBlock.querySelector('.comp-horas-totales').value) || 0;
    const porcentaje = parseFloat(compBlock.querySelector('.comp-porcentaje').value) || 0;
    const horasAEjecutar = Math.ceil((horasTotales * porcentaje) / 100);
    const totalSesiones = Math.ceil(horasAEjecutar / 6);

    compBlock.querySelector('.comp-val-horas-ejecutar').innerText = horasAEjecutar + ' hrs';
    compBlock.querySelector('.comp-val-total-sesiones').innerText = totalSesiones + ' sesiones';
}

function inicializarEditarCompleto() {
    // Inicializar con datos existentes
    const competenciasExistentes = <?= json_encode($competencias) ?>;
    const resultadosExistentes = <?= json_encode($resultados) ?>;

    if (competenciasExistentes.length > 0) {
        competenciasExistentes.forEach(comp => {
            let compData = { ...comp };
            compData.resultados = resultadosExistentes[comp.id_competencia] || [];
            agregarCompetencia(compData);
        });
    } else {
        agregarCompetencia();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', inicializarEditarCompleto);
} else {
    inicializarEditarCompleto();
}
</script>
