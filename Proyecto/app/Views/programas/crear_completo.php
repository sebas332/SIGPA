<div class="container-fluid px-0">
    <!-- Encabezado de la página -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Registrar Programa de Formación</h3>
            <p class="text-muted small mb-0">Ingresa los datos para registrar un nuevo programa en el catálogo.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-outline-secondary rounded-pill px-4 fw-medium shadow-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver al Catálogo
            </a>
        </div>
    </div>

    <!-- Formulario Principal -->
    <form action="<?= URLROOT; ?>/index.php?route=programas/crearCompleto" method="POST" id="formCrearPrograma">
        <div class="row justify-content-center">
            <!-- Bloque del Programa de Formación -->
            <div class="col-lg-8 col-xl-6 mb-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                        <i class="fa-solid fa-graduation-cap text-primary me-2"></i> Datos del Programa
                    </h5>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Programa</label>
                        <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Análisis y Desarrollo de Software" value="<?= htmlspecialchars($oldData['nombre'] ?? ''); ?>" required oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); if(this.value.length > 35) this.value = this.value.slice(0, 35);">
                    </div>

                    <div class="mb-3">
                        <label for="codigo" class="form-label fw-medium text-secondary">Código del Programa</label>
                        <input type="text" class="form-control form-control-lg" id="codigo" name="codigo" placeholder="Ej. 228118" value="<?= htmlspecialchars($oldData['codigo'] ?? ''); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 8) this.value = this.value.slice(0, 8);">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="version" class="form-label fw-medium text-secondary">Versión</label>
                            <input type="text" class="form-control form-control-lg" id="version" name="version" placeholder="Ej. V1" value="<?= htmlspecialchars($oldData['version'] ?? 'V1'); ?>" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); if(this.value.length > 2) this.value = this.value.slice(0, 2);">
                        </div>
                        <div class="col-6">
                            <label for="vigencia" class="form-label fw-medium text-secondary">Vigencia</label>
                            <input type="text" class="form-control form-control-lg" id="vigencia" name="vigencia" placeholder="Ej. 2026" value="<?= htmlspecialchars($oldData['vigencia'] ?? '2026'); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="id_tipo_programa" class="form-label fw-medium text-secondary">Tipo de Programa</label>
                        <select class="form-select form-select-lg" id="id_tipo_programa" name="id_tipo_programa" required>
                            <?php foreach ($tipos as $tp): ?>
                                <option value="<?= $tp->id_tipo_programa; ?>" <?= (isset($oldData['id_tipo_programa']) && $oldData['id_tipo_programa'] == $tp->id_tipo_programa) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($tp->nombre); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label for="duracion_lectiva" class="form-label fw-medium text-secondary">Duración Lectiva (hrs)</label>
                            <input type="number" class="form-control form-control-lg" id="duracion_lectiva" name="duracion_lectiva" placeholder="Ej. 3120" value="<?= htmlspecialchars($oldData['duracion_lectiva'] ?? ''); ?>" required oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4);" min="0">
                        </div>
                        <div class="col-6">
                            <label for="duracion_practica" class="form-label fw-medium text-secondary">Duración Práctica (hrs)</label>
                            <input type="number" class="form-control form-control-lg" id="duracion_practica" name="duracion_practica" placeholder="Ej. 864" value="<?= htmlspecialchars($oldData['duracion_practica'] ?? ''); ?>" required oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4);" min="0">
                        </div>
                    </div>

                    <!-- Botones de Acción final -->
                    <div class="d-flex justify-content-end gap-2 border-top pt-4 mt-2">
                        <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programas" class="btn btn-light border fw-bold text-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Registrar Programa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


