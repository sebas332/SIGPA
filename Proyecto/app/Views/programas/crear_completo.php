<div class="container-fluid px-0">
    <!-- Encabezado de la página -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Constructor Curricular Integrado</h3>
            <p class="text-muted small mb-0">Registra un programa de formación, múltiples competencias y sus resultados en una sola transacción.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-outline-secondary rounded-pill px-4 fw-medium shadow-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
            </a>
        </div>
    </div>

    <!-- Formulario Principal -->
    <form action="<?= URLROOT; ?>/index.php?route=programas/crearCompleto" method="POST" id="formCrearCompleto">
        <div class="row">
            <!-- Bloque del Programa de Formación (Izquierda) -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                        <i class="fa-solid fa-graduation-cap text-primary me-2"></i> Datos del Programa
                    </h5>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Programa</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Análisis y Desarrollo de Software" value="<?= htmlspecialchars($oldData['nombre'] ?? ''); ?>" required oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); if(this.value.length > 35) this.value = this.value.slice(0, 35);">
                    </div>

                    <div class="mb-3">
                        <label for="codigo" class="form-label fw-medium text-secondary">Código del Programa</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ej. 228118" value="<?= htmlspecialchars($oldData['codigo'] ?? ''); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 8) this.value = this.value.slice(0, 8);">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="version" class="form-label fw-medium text-secondary">Versión</label>
                            <input type="text" class="form-control" id="version" name="version" placeholder="Ej. V1" value="<?= htmlspecialchars($oldData['version'] ?? 'V1'); ?>" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2);">
                        </div>
                        <div class="col-6">
                            <label for="vigencia" class="form-label fw-medium text-secondary">Vigencia</label>
                            <input type="text" class="form-control" id="vigencia" name="vigencia" placeholder="Ej. 2026" value="<?= htmlspecialchars($oldData['vigencia'] ?? '2026'); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="id_tipo_programa" class="form-label fw-medium text-secondary">Tipo de Programa</label>
                        <select class="form-select" id="id_tipo_programa" name="id_tipo_programa" required>
                            <?php foreach ($tipos as $tp): ?>
                                <option value="<?= $tp->id_tipo_programa; ?>" <?= (isset($oldData['id_tipo_programa']) && $oldData['id_tipo_programa'] == $tp->id_tipo_programa) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($tp->nombre); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label for="duracion_lectiva" class="form-label fw-medium text-secondary">Duración Lectiva (hrs)</label>
                            <input type="number" class="form-control" id="duracion_lectiva" name="duracion_lectiva" placeholder="Ej. 3120" value="<?= htmlspecialchars($oldData['duracion_lectiva'] ?? ''); ?>" required oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4);" min="0">
                        </div>
                        <div class="col-6">
                            <label for="duracion_practica" class="form-label fw-medium text-secondary">Duración Práctica (hrs)</label>
                            <input type="number" class="form-control" id="duracion_practica" name="duracion_practica" placeholder="Ej. 864" value="<?= htmlspecialchars($oldData['duracion_practica'] ?? ''); ?>" required oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4);" min="0">
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

                    <div class="alert alert-warning py-2 px-3 small border-0 shadow-sm mb-3">
                        <i class="fa-solid fa-circle-info me-1"></i> <strong>Nota:</strong> Todos los datos de competencias y resultados de aprendizaje se validarán con los triggers de la base de datos al enviar el formulario.
                    </div>

                    <!-- Botones de Acción final -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">Cancelar</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Registrar Programa Completo
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
                    <input type="text" name="competencias[{comp-idx}][nombre]" class="form-control comp-nombre" placeholder="Ej. Estructurar el modelo de base de datos" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Código Competencia</label>
                    <input type="text" name="competencias[{comp-idx}][codigo]" class="form-control comp-codigo" placeholder="Ej. 220501095" required>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Horas Totales</label>
                    <input type="number" name="competencias[{comp-idx}][horas_totales]" class="form-control comp-horas-totales" placeholder="Ej. 180" oninput="calcularCompetenciaFila({comp-idx})" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Resultados Totales (RA)</label>
                    <input type="number" name="competencias[{comp-idx}][resultados_totales]" class="form-control comp-resultados-totales" placeholder="Ej. 3" oninput="calcularCompetenciaFila({comp-idx})" required>
                </div>
                <div class="col-md-4">
                    <label class="text-secondary small fw-bold mb-1">Porcentaje (%)</label>
                    <input type="number" name="competencias[{comp-idx}][porcentaje]" class="form-control comp-porcentaje" placeholder="Ej. 100" value="100" oninput="calcularCompetenciaFila({comp-idx})" required>
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

                <!-- Barra de Progreso de Sesiones Asignadas -->
                <div class="p-3 bg-light rounded-3 border mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-secondary small fw-bold">Distribución de Sesiones Asignadas</span>
                        <span class="small fw-bold text-dark label-sesiones-acumuladas">0 / 0 sesiones</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 5px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success progress-sesiones" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="small mt-2 text-danger alert-exceso-sesiones" style="display:none;">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> ¡Advertencia! Las sesiones asignadas superan las sesiones totales de la competencia.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Plantilla Oculta de Resultado (HTML) -->
<template id="res-template">
    <div class="list-group-item bg-light-subtle rounded-3 p-3 border mb-2 res-block d-flex flex-column gap-2" data-res-idx="{res-idx}">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <label class="text-muted small fw-bold mb-1">Código RAP</label>
                <input type="text" name="competencias[{comp-idx}][resultados][{res-idx}][codigo]" class="form-control form-control-sm res-codigo" placeholder="Ej. RA-01" required>
            </div>
            <div class="col-md-7">
                <label class="text-muted small fw-bold mb-1">Sesiones Asignadas (Vacío para automático)</label>
                <input type="number" name="competencias[{comp-idx}][resultados][{res-idx}][sesiones_asignadas]" class="form-control form-control-sm res-sesiones" placeholder="Sugerido: {sugerido}" oninput="calcularCompetenciaFila({comp-idx})">
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
                <textarea name="competencias[{comp-idx}][resultados][{res-idx}][descripcion]" class="form-control form-control-sm res-descripcion" rows="2" placeholder="Ej. Construir las tablas con llaves foráneas..." required></textarea>
            </div>
        </div>
    </div>
</template>

<script>
let compCounter = 0;

// Agregar una competencia al formulario
function agregarCompetencia() {
    const container = document.getElementById('competencias-container');
    const template = document.getElementById('comp-template').innerHTML;

    // Incrementar e indexar
    const compIdx = compCounter++;
    const compNum = container.children.length + 1;

    let html = template
        .replace(/\{comp-idx\}/g, compIdx)
        .replace(/\{comp-number\}/g, compNum);

    // Inyectar en el contenedor
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    const element = tempDiv.firstElementChild;
    container.appendChild(element);

    // Agregar un resultado de aprendizaje por defecto
    agregarResultado(compIdx);

    // Ejecutar cálculo inicial
    calcularCompetenciaFila(compIdx);
}

// Eliminar una competencia del formulario
function eliminarCompetencia(btn) {
    const block = btn.closest('.comp-block');
    if (confirm('¿Estás seguro de que deseas eliminar esta competencia y todos sus resultados asociados?')) {
        block.remove();
        reindexarCompetencias();
    }
}

// Reindexar números visuales de competencia después de eliminar
function reindexarCompetencias() {
    const blocks = document.querySelectorAll('#competencias-container .comp-block');
    blocks.forEach((block, idx) => {
        block.querySelector('.comp-number').innerText = idx + 1;
    });
}

// Agregar un resultado a una competencia específica
function agregarResultado(compIdx) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    if (!compBlock) return;

    const resContainer = compBlock.querySelector('.resultados-container');
    const template = document.getElementById('res-template').innerHTML;

    // Calcular índice del resultado
    const resIdx = resContainer.children.length;

    // Obtener valores sugeridos basados en total_sesiones y resultados_totales de la competencia
    const totalSes = parseInt(compBlock.querySelector('.comp-horas-totales').value) || 0; // provisional o real
    const calcTotalSesiones = Math.ceil( ( (parseFloat(compBlock.querySelector('.comp-horas-totales').value) || 0) * (parseFloat(compBlock.querySelector('.comp-porcentaje').value) || 100) / 100 ) / 6 );
    const resTotalesVal = parseInt(compBlock.querySelector('.comp-resultados-totales').value) || 1;
    const sugerido = resTotalesVal > 0 ? Math.floor(calcTotalSesiones / resTotalesVal) : 0;

    let html = template
        .replace(/\{comp-idx\}/g, compIdx)
        .replace(/\{res-idx\}/g, resIdx)
        .replace(/\{sugerido\}/g, sugerido);

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    resContainer.appendChild(tempDiv.firstElementChild);

    calcularCompetenciaFila(compIdx);
}

// Eliminar un resultado de una competencia específica
function eliminarResultado(btn, compIdx) {
    const block = btn.closest('.res-block');
    block.remove();
    reindexarResultados(compIdx);
    calcularCompetenciaFila(compIdx);
}

// Reindexar los inputs de resultados de aprendizaje después de eliminar
function reindexarResultados(compIdx) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    if (!compBlock) return;

    const resContainer = compBlock.querySelector('.resultados-container');
    const resBlocks = resContainer.querySelectorAll('.res-block');

    resBlocks.forEach((block, idx) => {
        block.setAttribute('data-res-idx', idx);
        
        // Reindexar inputs
        const codigoInput = block.querySelector('.res-codigo');
        const sesionesInput = block.querySelector('.res-sesiones');
        const descInput = block.querySelector('.res-descripcion');
        
        if (codigoInput) codigoInput.name = `competencias[${compIdx}][resultados][${idx}][codigo]`;
        if (sesionesInput) sesionesInput.name = `competencias[${compIdx}][resultados][${idx}][sesiones_asignadas]`;
        if (descInput) descInput.name = `competencias[${compIdx}][resultados][${idx}][descripcion]`;
    });
}

// Calcular las horas a ejecutar, sesiones totales y balance de sesiones de resultados de una competencia
function calcularCompetenciaFila(compIdx) {
    const compBlock = document.querySelector(`.comp-block[data-comp-idx="${compIdx}"]`);
    if (!compBlock) return;

    const horasTotalesInput = compBlock.querySelector('.comp-horas-totales');
    const porcentajeInput = compBlock.querySelector('.comp-porcentaje');
    const resultadosTotalesInput = compBlock.querySelector('.comp-resultados-totales');

    const labelHorasEjecutar = compBlock.querySelector('.comp-val-horas-ejecutar');
    const labelTotalSesiones = compBlock.querySelector('.comp-val-total-sesiones');

    const horasTotales = parseFloat(horasTotalesInput.value) || 0;
    const porcentaje = parseFloat(porcentajeInput.value) || 0;
    const resultadosTotales = parseInt(resultadosTotalesInput.value) || 1;

    // 1. Cálculos de Competencia
    const horasAEjecutar = Math.ceil((horasTotales * porcentaje) / 100);
    const totalSesiones = Math.ceil(horasAEjecutar / 6);

    labelHorasEjecutar.innerText = horasAEjecutar + ' hrs';
    labelTotalSesiones.innerText = totalSesiones + ' sesiones';

    // Actualizar placeholders sugeridos de los resultados de aprendizaje
    const sugerido = resultadosTotales > 0 ? Math.floor(totalSesiones / resultadosTotales) : 0;
    const resBlocks = compBlock.querySelectorAll('.res-block');
    resBlocks.forEach(res => {
        const inputSesion = res.querySelector('.res-sesiones');
        if (inputSesion) {
            inputSesion.placeholder = `Sugerido: ${sugerido}`;
        }
    });

    // 2. Cálculos y Progreso de Sesiones de los Resultados
    let sesionesAcumuladas = 0;
    resBlocks.forEach(res => {
        const inputSesion = res.querySelector('.res-sesiones');
        const val = parseInt(inputSesion.value);
        if (!isNaN(val)) {
            sesionesAcumuladas += val;
        } else {
            // Si está vacío, la base de datos aplicará el cálculo automático (sugerido)
            sesionesAcumuladas += sugerido;
        }
    });

    // Actualizar barra de progreso y labels
    const labelSesiones = compBlock.querySelector('.label-sesiones-acumuladas');
    const progressBar = compBlock.querySelector('.progress-sesiones');
    const alertExceso = compBlock.querySelector('.alert-exceso-sesiones');

    if (labelSesiones) {
        labelSesiones.innerText = `${sesionesAcumuladas} / ${totalSesiones} sesiones`;
    }

    if (progressBar) {
        let pct = totalSesiones > 0 ? (sesionesAcumuladas / totalSesiones) * 100 : 0;
        pct = Math.min(100, Math.max(0, pct)); // Acotar entre 0 y 100
        progressBar.style.width = pct + '%';
        progressBar.setAttribute('aria-valuenow', pct);
        
        // Colores de la barra según carga
        if (sesionesAcumuladas > totalSesiones) {
            progressBar.classList.remove('bg-success', 'bg-warning');
            progressBar.classList.add('bg-danger');
            if (alertExceso) alertExceso.style.display = 'block';
        } else if (sesionesAcumuladas === totalSesiones) {
            progressBar.classList.remove('bg-danger', 'bg-warning');
            progressBar.classList.add('bg-success');
            if (alertExceso) alertExceso.style.display = 'none';
        } else {
            progressBar.classList.remove('bg-danger', 'bg-success');
            progressBar.classList.add('bg-warning');
            if (alertExceso) alertExceso.style.display = 'none';
        }
    }
}

// Agregar la primera competencia al iniciar la página si no hay datos previos
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('competencias-container');
    if (container.children.length === 0) {
        agregarCompetencia();
    }

    // Validación al enviar el formulario
    const form = document.getElementById('formCrearCompleto');
    if (form) {
        form.addEventListener('submit', function(e) {
            const compBlocks = document.querySelectorAll('.comp-block');
            for (let i = 0; i < compBlocks.length; i++) {
                const block = compBlocks[i];
                const compName = block.querySelector('.comp-nombre').value || 'Sin nombre';
                const compNum = block.querySelector('.comp-number').innerText;
                const resultadosTotales = parseInt(block.querySelector('.comp-resultados-totales').value) || 0;
                const resBlocks = block.querySelectorAll('.res-block');
                
                if (resBlocks.length !== resultadosTotales) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Resultados Incompletos',
                        html: `<b>Competencia #${compNum} (${compName})</b><br><br>Has indicado que tiene <b>${resultadosTotales}</b> resultados totales (RA), pero has agregado <b>${resBlocks.length}</b> al formulario.<br><br>Por favor, asegúrate de crear exactamente <b>${resultadosTotales}</b> resultado(s) de aprendizaje antes de guardar.`,
                        confirmButtonColor: '#00A356',
                        confirmButtonText: 'Entendido'
                    }).then(() => {
                        block.scrollIntoView({behavior: "smooth", block: "center"});
                    });
                    return false;
                }
            }
        });
    }
});
</script>
