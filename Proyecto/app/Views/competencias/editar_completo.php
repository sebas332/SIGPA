<div class="modal fade" id="modalEditarCompetencia" tabindex="-1" aria-labelledby="modalEditarCompetenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg bg-light">
            <div class="modal-header bg-white border-bottom p-4">
                <h5 class="modal-title fw-bold text-dark" id="modalEditarCompetenciaLabel">
                    <i class="fa-solid fa-pen-to-square me-2 text-primary"></i> Editar Competencia y Resultados
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=competencias/updateCompleto" method="POST" id="formEditarCompetenciaCompleta">
                <input type="hidden" name="id_competencia" value="<?= $competencia->id_competencia; ?>">
                <div class="modal-body p-4 custom-scroll" style="max-height: 65vh; overflow-y: auto;">
                    
                    <!-- Card Competencia -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-dark text-white d-flex align-items-center p-3 rounded-top-4">
                            <h6 class="m-0 fw-bold"><i class="fa-solid fa-book me-2 text-primary"></i> Datos de la Competencia</h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold text-secondary small">Nombre de la Competencia</label>
                                    <input type="text" class="form-control" name="competencia[nombre]" value="<?= htmlspecialchars($competencia->nombre); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Código Competencia</label>
                                    <input type="text" class="form-control" name="competencia[codigo]" value="<?= htmlspecialchars($competencia->codigo); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Horas Totales</label>
                                    <input type="number" class="form-control comp-horas-edit" name="competencia[horas_totales]" value="<?= htmlspecialchars($competencia->horas_totales); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Resultados Totales (RA)</label>
                                    <input type="number" class="form-control comp-ra-totales-edit" name="competencia[resultados_totales]" value="<?= htmlspecialchars($competencia->resultados_totales); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-secondary small">Porcentaje (%)</label>
                                    <input type="number" class="form-control comp-porcentaje-edit" name="competencia[porcentaje]" value="<?= htmlspecialchars($competencia->porcentaje); ?>" required>
                                </div>
                            </div>
                            
                            <div class="row g-3 mt-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                        <span class="text-secondary fw-bold small">Total Sesiones (Calculado)</span>
                                        <span class="fs-5 fw-bold text-primary total-sesiones-edit"><?= htmlspecialchars($competencia->total_sesiones); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light d-flex justify-content-between align-items-center">
                                        <span class="text-secondary fw-bold small">Horas a Ejecutar (Calculado)</span>
                                        <span class="fs-5 fw-bold text-info total-horas-ejecutar-edit"><?= htmlspecialchars($competencia->horas_a_ejecutar); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Resultados de Aprendizaje -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3 rounded-top-4">
                            <h6 class="m-0 fw-bold"><i class="fa-solid fa-list-check me-2 text-warning"></i> Resultados de Aprendizaje</h6>
                            <button type="button" class="btn btn-sm btn-success fw-bold px-3 btn-add-rap-edit">
                                <i class="fa-solid fa-plus me-1"></i> Agregar RAP
                            </button>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div id="rapsContainerEdit" class="d-flex flex-column gap-3">
                                <?php if (!empty($resultados)): ?>
                                    <?php foreach($resultados as $index => $ra): ?>
                                    <div class="rap-item-edit p-3 border rounded-3 bg-light position-relative">
                                        <input type="hidden" name="raps[<?= $index; ?>][id_resultado]" value="<?= $ra->id_resultado; ?>">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label fw-bold text-secondary small mb-1">Código RAP</label>
                                                <input type="text" class="form-control form-control-sm" name="raps[<?= $index; ?>][codigo]" value="<?= htmlspecialchars($ra->codigo); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-secondary small mb-1">Descripción</label>
                                                <input type="text" class="form-control form-control-sm" name="raps[<?= $index; ?>][descripcion]" value="<?= htmlspecialchars($ra->descripcion); ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-bold text-secondary small mb-1">Sesiones</label>
                                                <input type="number" class="form-control form-control-sm rap-sesiones-edit" name="raps[<?= $index; ?>][sesiones_asignadas]" value="<?= htmlspecialchars($ra->sesiones_asignadas); ?>">
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-remove-rap-edit" title="Eliminar RAP">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center text-muted small" id="noRapsMessageEdit">
                                        No hay resultados de aprendizaje. Haz clic en "Agregar RAP" para comenzar.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 p-3">
                            <div class="alert alert-info py-2 px-3 m-0 small d-flex align-items-center">
                                <i class="fa-solid fa-circle-info me-2 fs-5"></i>
                                <div>
                                    Sumatoria de Sesiones Asignadas a los RAP: 
                                    <strong class="total-rap-sesiones-edit ms-1 fs-6">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-white border-top p-4 d-flex justify-content-end gap-2 rounded-bottom-4">
                    <button type="button" class="btn btn-light fw-medium shadow-sm px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-medium shadow-sm px-4">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function() {
    const container = document.getElementById('rapsContainerEdit');
    const btnAdd = document.querySelector('.btn-add-rap-edit');
    const compHorasInput = document.querySelector('.comp-horas-edit');
    const compPorcentajeInput = document.querySelector('.comp-porcentaje-edit');
    const totalSesionesDisplay = document.querySelector('.total-sesiones-edit');
    const totalHorasEjecutarDisplay = document.querySelector('.total-horas-ejecutar-edit');
    const totalRapSesionesDisplay = document.querySelector('.total-rap-sesiones-edit');
    let rapIndexEdit = <?= isset($resultados) ? count($resultados) : 0; ?>;

    function calcularValoresCompetencia() {
        const horas = parseFloat(compHorasInput.value) || 0;
        const porcentaje = parseFloat(compPorcentajeInput.value) || 100;
        
        const horasAEjecutar = (horas * porcentaje) / 100;
        const totalSesiones = Math.round(horasAEjecutar / 6); // 6 horas por sesión según triggers

        totalHorasEjecutarDisplay.textContent = horasAEjecutar.toFixed(2);
        totalSesionesDisplay.textContent = totalSesiones;
        
        calcularSumatoriaRaps();
    }

    function calcularSumatoriaRaps() {
        let total = 0;
        document.querySelectorAll('.rap-sesiones-edit').forEach(input => {
            total += parseInt(input.value) || 0;
        });
        totalRapSesionesDisplay.textContent = total;
        
        const maxSesiones = parseInt(totalSesionesDisplay.textContent) || 0;
        if(total > maxSesiones) {
            totalRapSesionesDisplay.classList.remove('text-success');
            totalRapSesionesDisplay.classList.add('text-danger');
        } else if (total === maxSesiones && maxSesiones > 0) {
            totalRapSesionesDisplay.classList.remove('text-danger', 'text-dark');
            totalRapSesionesDisplay.classList.add('text-success');
        } else {
            totalRapSesionesDisplay.classList.remove('text-danger', 'text-success');
            totalRapSesionesDisplay.classList.add('text-dark');
        }
    }

    if (compHorasInput) compHorasInput.addEventListener('input', calcularValoresCompetencia);
    if (compPorcentajeInput) compPorcentajeInput.addEventListener('input', calcularValoresCompetencia);

    if(btnAdd && container) {
        btnAdd.addEventListener('click', function() {
            const noMessage = document.getElementById('noRapsMessageEdit');
            if(noMessage) noMessage.remove();

            const html = `
            <div class="rap-item-edit p-3 border rounded-3 bg-light position-relative">
                <input type="hidden" name="raps[${rapIndexEdit}][id_resultado]" value="">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-secondary small mb-1">Código RAP</label>
                        <input type="text" class="form-control form-control-sm" name="raps[${rapIndexEdit}][codigo]" placeholder="Ej. RAP1" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary small mb-1">Descripción</label>
                        <input type="text" class="form-control form-control-sm" name="raps[${rapIndexEdit}][descripcion]" placeholder="Descripción del RAP">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold text-secondary small mb-1">Sesiones</label>
                        <input type="number" class="form-control form-control-sm rap-sesiones-edit" name="raps[${rapIndexEdit}][sesiones_asignadas]" placeholder="0">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm btn-remove-rap-edit" title="Eliminar RAP">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            rapIndexEdit++;
            calcularSumatoriaRaps();
        });

        container.addEventListener('click', function(e) {
            if(e.target.closest('.btn-remove-rap-edit')) {
                e.target.closest('.rap-item-edit').remove();
                calcularSumatoriaRaps();
            }
        });

        container.addEventListener('input', function(e) {
            if(e.target.classList.contains('rap-sesiones-edit')) {
                calcularSumatoriaRaps();
            }
        });
    }

    // Inicializar cálculos
    calcularValoresCompetencia();
})();
</script>
