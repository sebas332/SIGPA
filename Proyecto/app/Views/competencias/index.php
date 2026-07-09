<style>
    /* Efectos de interactividad para botones */
    .btn {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12) !important;
    }
    .btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }

    /* Scroll personalizado para contenedor interno de RAPs */
    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #adb5bd;
    }
</style>

<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Competencias y Resultados de Aprendizaje</h3>
            <p class="text-muted small mb-0">Gestión de competencias, RAPs y validaciones de cálculo</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <?php if ($current_role === 'Coordinador'): ?>
                <button type="button" class="btn btn-success shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCompetenciaCompleta">
                    <i class="fa-solid fa-book-medical me-1"></i> Agregar Competencia
                </button>

            <?php endif; ?>
        </div>
    </div>

    <!-- Pestañas de navegación -->
    <ul class="nav nav-tabs mb-4 border-bottom-0" id="competenciasTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold px-4" id="competencias-tab" data-bs-toggle="tab" data-bs-target="#competencias" type="button" role="tab" aria-controls="competencias" aria-selected="true">
                <i class="fa-solid fa-book-bookmark me-2 text-success"></i> Competencias
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold px-4" id="resultados-tab" data-bs-toggle="tab" data-bs-target="#resultados" type="button" role="tab" aria-controls="resultados" aria-selected="false">
                <i class="fa-solid fa-list-check me-2 text-warning"></i> Resultados de Aprendizaje
            </button>
        </li>
    </ul>

    <!-- Contenido Pestañas -->
    <div class="tab-content" id="competenciasTabContent">
        <!-- Pestaña Competencias -->
        <div class="tab-pane fade show active" id="competencias" role="tabpanel" aria-labelledby="competencias-tab">
            <div class="card shadow-sm border-0 rounded-4 bg-white">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase py-3">
                                <tr>
                                    <th class="ps-4">Código</th>
                                    <th>Competencia</th>
                                    <th>Horas Totales</th>
                                    <th>Sesiones Calculadas (Triggers)</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($competencias as $comp): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-success"><?= $comp->codigo; ?></td>
                                        <td><div class="fw-bold text-dark small"><?= $comp->nombre; ?></div></td>
                                        <td><span class="badge bg-light text-dark border"><?= $comp->horas_totales; ?> hrs</span></td>
                                        <td>
                                            <span class="badge bg-primary px-3 py-1"><?= $comp->total_sesiones; ?> sesiones</span>
                                            <div class="text-muted small mt-1">Horas a ejecutar: <?= $comp->horas_a_ejecutar; ?> (<?= $comp->porcentaje; ?>%)</div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <?php if ($current_role === 'Coordinador'): ?>
                                                <div class="d-flex justify-content-end gap-1">
                                                    <a href="<?= URLROOT; ?>/index.php?route=competencias/validarSesiones&id=<?= $comp->id_competencia; ?>" class="btn btn-outline-info btn-sm shadow-sm" title="Validar Sesiones (SP)">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-primary btn-sm shadow-sm" title="Editar Competencia" onclick="abrirModalEditarCompetencia(<?= $comp->id_competencia; ?>)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm shadow-sm btn-delete-competencia" data-id="<?= $comp->id_competencia; ?>" data-codigo="<?= htmlspecialchars($comp->codigo); ?>" title="Eliminar Competencia">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
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
<!-- Modal Crear Competencia Completa (Competencia + RAP) -->
<div class="modal fade" id="modalCompetenciaCompleta" tabindex="-1" aria-labelledby="modalCompetenciaCompletaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg bg-light">
            <div class="modal-header bg-white border-bottom p-4">
                <h5 class="modal-title fw-bold text-dark" id="modalCompetenciaCompletaLabel">
                    <i class="fa-solid fa-book-bookmark me-2 text-success"></i> Competencias y Resultados
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=competencias/createCompetenciaCompleta" method="POST" id="formCompetenciaCompleta">
                <div class="modal-body p-4 custom-scroll" style="max-height: 65vh; overflow-y: auto;">

                    <!-- Card Competencia -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-dark text-white d-flex align-items-center p-3 rounded-top-4">
                            <h6 class="m-0 fw-bold"><i class="fa-solid fa-book me-2 text-success"></i> Datos de la Competencia</h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold text-secondary small">Nombre de la Competencia</label>
                                    <input type="text" class="form-control" name="competencia[nombre]" placeholder="Ej. Estructurar el modelo de base de datos" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Código Competencia</label>
                                    <input type="text" class="form-control" name="competencia[codigo]" placeholder="Ej. 220501095" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Horas Totales</label>
                                    <input type="number" class="form-control comp-horas" name="competencia[horas_totales]" placeholder="Ej. 180" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Resultados Totales (RA)</label>
                                    <input type="number" class="form-control comp-ra-totales" name="competencia[resultados_totales]" placeholder="Ej. 3" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Porcentaje (%)</label>
                                    <input type="number" class="form-control comp-porcentaje" name="competencia[porcentaje]" placeholder="100" value="100" required>
                                </div>
                            </div>
                            <!-- Boxes -->
                            <div class="row g-3 mt-4">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border">
                                        <div>
                                            <span class="d-block text-muted small fw-bold mb-1">Horas a Ejecutar</span>
                                            <h4 class="m-0 fw-bold text-success comp-horas-calc">0 hrs</h4>
                                        </div>
                                        <i class="fa-solid fa-clock text-success opacity-50 fs-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 border">
                                        <div>
                                            <span class="d-block text-muted small fw-bold mb-1">Total Sesiones (de 6 horas)</span>
                                            <h4 class="m-0 fw-bold text-primary comp-sesiones-calc">0 sesiones</h4>
                                        </div>
                                        <i class="fa-solid fa-calendar-days text-primary opacity-50 fs-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Header Resultados -->
                    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                        <h6 class="fw-bold text-dark m-0"><i class="fa-solid fa-list-check me-2 text-warning"></i> Resultados de Aprendizaje (RAP)</h6>
                        <button type="button" class="btn btn-outline-warning text-dark fw-bold rounded-pill btn-add-rap bg-white">
                            <i class="fa-solid fa-plus me-1"></i> Agregar RAP
                        </button>
                    </div>

                    <!-- Container RAP -->
                    <div id="rapsContainer" class="d-flex flex-column gap-3 pe-2">
                        <!-- Card RAP Template will be appended here -->
                    </div>

                    <!-- Footer Distribución -->
                    <div class="mt-4 p-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary">Distribución de Sesiones Asignadas</span>
                        <span class="fw-bold text-dark distribucion-texto">0 / 0 sesiones</span>
                    </div>

                </div>
                <div class="modal-footer bg-white border-top p-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light border fw-bold text-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success fw-bold px-4"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar competencia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endif; ?>

<!-- Contenedor Dinámico para el Modal de Edición -->
<div id="modalEditarCompetenciaContainer"></div>

<script>
function initModalCompetenciaCompleta() {
    const container = document.getElementById('rapsContainer');
    const btnAdd = document.querySelector('.btn-add-rap');
    const form = document.getElementById('formCompetenciaCompleta');
    if(!container || !btnAdd) return;

    let rapCount = 0;

    function calculateOverall() {
        const horasInput = form.querySelector('.comp-horas');
        const porcentajeInput = form.querySelector('.comp-porcentaje');
        
        const horas = parseFloat(horasInput.value) || 0;
        const porcentaje = parseFloat(porcentajeInput.value) || 0;

        const horasEjecutar = Math.ceil((horas * porcentaje) / 100);
        const totalSesiones = Math.ceil(horasEjecutar / 6);

        form.querySelector('.comp-horas-calc').innerText = horasEjecutar + ' hrs';
        form.querySelector('.comp-sesiones-calc').innerText = totalSesiones + ' sesiones';

        // Distribution logic
        let sesionesAsignadasSum = 0;
        const rapInputs = container.querySelectorAll('.rap-sesiones');
        let unassignedCount = 0;
        
        rapInputs.forEach(input => {
            const val = parseInt(input.value);
            if (!isNaN(val)) {
                sesionesAsignadasSum += val;
            } else {
                unassignedCount++;
            }
        });

        const sesionesRestantes = totalSesiones - sesionesAsignadasSum;
        const sugerido = unassignedCount > 0 ? Math.floor(sesionesRestantes / unassignedCount) : 0;

        rapInputs.forEach(input => {
            if (input.value === '') {
                input.placeholder = "Sugerido: " + Math.max(0, sugerido);
            }
        });

        const distribucionTexto = form.querySelector('.distribucion-texto');
        const warningClass = sesionesAsignadasSum > totalSesiones ? 'text-danger' : 'text-dark';
        distribucionTexto.className = `fw-bold distribucion-texto ${warningClass}`;
        distribucionTexto.innerText = sesionesAsignadasSum + ' / ' + totalSesiones + ' sesiones';
    }

    function addRapCard() {
        rapCount++;
        const index = Date.now() + rapCount;
        const html = `
            <div class="card border border-light-subtle shadow-sm rounded-4 rap-card mb-3">
                <div class="card-body p-3 bg-white position-relative">
                    <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 mt-2 me-2 btn-remove-rap" title="Eliminar RAP">
                        <i class="fa-solid fa-trash pointer-events-none"></i>
                    </button>
                    <div class="row g-2 align-items-center pe-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-secondary small mb-1">Código RAP</label>
                            <input type="text" class="form-control form-control-sm" name="raps[${index}][codigo]" placeholder="Ej. RA-01" required>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-secondary small mb-1">Sesiones Asignadas (Vacío para automático)</label>
                            <input type="number" class="form-control form-control-sm rap-sesiones" name="raps[${index}][sesiones_asignadas]" placeholder="Sugerido: 0" min="0">
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label fw-bold text-secondary small mb-1">Descripción del Resultado</label>
                            <textarea class="form-control form-control-sm" name="raps[${index}][descripcion]" rows="2" placeholder="Ej. Construir las tablas con llaves foráneas..." required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        calculateOverall();
    }

    btnAdd.addEventListener('click', function() {
        // Increment input when manually added
        const total = parseInt(raTotalesInput.value) || 0;
        raTotalesInput.value = total + 1;
        addRapCard();
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove-rap')) {
            e.target.closest('.rap-card').remove();
            // Decrement input when manually removed
            const total = parseInt(raTotalesInput.value) || 0;
            if (total > 0) {
                raTotalesInput.value = total - 1;
            }
            calculateOverall();
        }
    });

    container.addEventListener('input', function(e) {
        if(e.target.classList.contains('rap-sesiones')) {
            calculateOverall();
        }
    });

    form.querySelector('.comp-horas').addEventListener('input', calculateOverall);
    form.querySelector('.comp-porcentaje').addEventListener('input', calculateOverall);

    const raTotalesInput = form.querySelector('.comp-ra-totales');
    
    function syncRapCards() {
        const total = parseInt(raTotalesInput.value) || 0;
        const currentCards = container.querySelectorAll('.rap-card').length;
        
        if (total > currentCards) {
            const diff = total - currentCards;
            for(let i=0; i<diff; i++) {
                addRapCard();
            }
        } else if (total > 0 && total < currentCards) {
            // Remove from bottom
            const diff = currentCards - total;
            const cards = container.querySelectorAll('.rap-card');
            for(let i=0; i<diff; i++) {
                cards[cards.length - 1 - i].remove();
            }
            calculateOverall();
        } else if (total === 0 && currentCards === 0) {
            addRapCard(); // Always keep at least 1 for default
        }
    }

    raTotalesInput.addEventListener('input', syncRapCards);

    // Initial RAP card
    if(container.children.length === 0) {
        addRapCard();
    }

    // Al abrir el modal asegurar de renderizar
    const modalCompetenciaCompleta = document.getElementById('modalCompetenciaCompleta');
    if(modalCompetenciaCompleta) {
        modalCompetenciaCompleta.addEventListener('shown.bs.modal', function () {
            if(container.children.length === 0) addRapCard();
            calculateOverall();
        });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    initModalCompetenciaCompleta();

    // Confirmación para Eliminar Competencia
    const deleteBtns = document.querySelectorAll('.btn-delete-competencia');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const codigo = this.getAttribute('data-codigo');

            Swal.fire({
                title: `¿Eliminar competencia ${codigo}?`,
                text: "Se eliminará la competencia y podría afectar los programas y RAPs asociados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= URLROOT; ?>/index.php?route=competencias/delete&id=${id}`;
                }
            });
        });
    });
});

function abrirModalEditarCompetencia(idCompetencia) {
    fetch(`<?= URLROOT; ?>/index.php?route=competencias/editarCompleto&id=${idCompetencia}&ajax=1`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('modalEditarCompetenciaContainer').innerHTML = html;
            const modal = new bootstrap.Modal(document.getElementById('modalEditarCompetencia'));
            modal.show();
        })
        .catch(error => {
            console.error('Error al cargar modal de edición:', error);
            Swal.fire('Error', 'No se pudo cargar el formulario de edición.', 'error');
        });
}
</script>
