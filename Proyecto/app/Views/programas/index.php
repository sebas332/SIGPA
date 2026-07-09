<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Programas de Formación</h3>
            <p class="text-muted small mb-0">Administración curricular de programas formativos</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <?php if ($current_role === 'Coordinador'): ?>
                <button type="button" class="btn btn-success shadow-sm fw-medium d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCrearPrograma">
                    <i class="fa-solid fa-plus me-1"></i> Crear Programa
                </button>
            <?php endif; ?>
        </div>
    </div>

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
                                    <th>Duración Total</th>
                                    <th class="pe-4 text-end">Acciones</th>
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
                                        <td class="text-muted small">
                                            Lectiva: <?= $prog->duracion_lectiva; ?> hrs <br>
                                            Práctica: <?= $prog->duracion_practica; ?> hrs
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="<?= URLROOT; ?>/index.php?route=programas/show&id=<?= $prog->id_programa; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold shadow-sm">
                                                <i class="fa-solid fa-eye me-1"></i> Ver Programa
                                            </a>
                                        </td>
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
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <!-- Header Verde Institucional SENA -->
            <div class="modal-header bg-success text-white p-4 border-0 position-relative">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-graduation-cap text-success fs-4"></i>
                    </div>
                    <div>
                        <h4 class="modal-title fw-bold mb-1" id="modalCrearProgramaLabel">Registrar Nuevo Programa</h4>
                        <p class="mb-0 small text-white-50">Crea un nuevo programa de formación en el catálogo.</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-4 me-4" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <form action="<?= URLROOT; ?>/index.php?route=programas/create" method="POST" id="formCrearPrograma">
                <div class="modal-body p-4 p-md-5">
                    <div class="row g-4">
                        <!-- Nombre del Programa -->
                        <div class="col-md-12">
                            <label for="nombre" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-book text-success me-2"></i> Nombre del Programa</label>
                            <input type="text" class="form-control form-control-lg rounded-3" id="nombre" name="nombre" placeholder="Ej. Producción Multimedia" required>
                        </div>
                        
                        <!-- Código y Tipo -->
                        <div class="col-md-6">
                            <label for="codigo" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-hashtag text-success me-2"></i> Código</label>
                            <input type="text" class="form-control form-control-lg rounded-3" id="codigo" name="codigo" placeholder="Ej. 228190" required>
                        </div>
                        <div class="col-md-6">
                            <label for="id_tipo_programa" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-tags text-success me-2"></i> Tipo de Programa</label>
                            <select class="form-select form-select-lg rounded-3" id="id_tipo_programa" name="id_tipo_programa" required>
                                <option value="" disabled selected>Selecciona un tipo...</option>
                                <?php foreach ($tipos as $tp): ?>
                                    <option value="<?= $tp->id_tipo_programa; ?>"><?= htmlspecialchars($tp->nombre); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Versión y Vigencia -->
                        <div class="col-md-6">
                            <label for="version" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-code-branch text-success me-2"></i> Versión</label>
                            <input type="text" class="form-control form-control-lg rounded-3" id="version" name="version" placeholder="Ej. V1" value="V1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="vigencia" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-calendar-check text-success me-2"></i> Vigencia</label>
                            <input type="text" class="form-control form-control-lg rounded-3" id="vigencia" name="vigencia" placeholder="Ej. 2026" value="2026" required>
                        </div>
                        
                        <!-- Duraciones -->
                        <div class="col-md-6">
                            <label for="duracion_lectiva" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-clock text-success me-2"></i> Duración Lectiva (hrs)</label>
                            <input type="number" class="form-control form-control-lg rounded-3" id="duracion_lectiva" name="duracion_lectiva" placeholder="Ej. 3120" required>
                        </div>
                        <div class="col-md-6">
                            <label for="duracion_practica" class="form-label fw-bold text-dark small mb-2"><i class="fa-solid fa-briefcase text-success me-2"></i> Duración Práctica (hrs)</label>
                            <input type="number" class="form-control form-control-lg rounded-3" id="duracion_practica" name="duracion_practica" placeholder="Ej. 864" required>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer p-4 border-top-0 d-flex justify-content-end gap-2 bg-white">
                    <button type="button" class="btn btn-light border rounded-pill px-4 fw-bold text-secondary" data-bs-dismiss="modal">
                        <i class="fa-regular fa-circle-xmark me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

