<form action="<?= URLROOT; ?>/index.php?route=programas/updateCompleto" method="POST" id="formEditarPrograma">
    <input type="hidden" name="id_programa" value="<?= $programa->id_programa; ?>">
    <input type="hidden" name="is_modal" value="<?= $isModal ? 1 : 0; ?>">
    
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
