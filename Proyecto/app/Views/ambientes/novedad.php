<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="<?= URLROOT; ?>/index.php?route=ambientes/index" class="btn btn-outline-secondary btn-sm mb-3 shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Volver a Ambientes
        </a>
        <h2 class="fw-bold text-dark mb-1">Historial de Novedades: <span class="text-primary"><?= $ambiente->nombre; ?></span></h2>
        <p class="text-muted small mb-0">Especialidad: <?= $ambiente->especialidad_ambiente; ?> | Estado Actual: 
            <?php if ($ambiente->disponibilidad == 1): ?>
                <span class="badge bg-success ms-1">Disponible</span>
            <?php else: ?>
                <span class="badge bg-danger ms-1">Ocupado / Con Averías</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="row g-4">
        <!-- Formulario Reportar Novedad -->
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 bg-white h-100">
                <div class="card-header bg-white p-4 border-0">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>Reportar Nueva Novedad</h5>
                </div>
                <div class="card-body px-4 pt-0">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm small py-2 mb-3"><?= $error; ?></div>
                    <?php endif; ?>

                    <form action="<?= URLROOT; ?>/index.php?route=ambientes/novedad&id=<?= $ambiente->id_numero_ambiente; ?>" method="POST">
                        <div class="mb-4">
                            <label for="descripcion" class="form-label fw-medium text-secondary">Descripción de la avería o suceso</label>
                            <textarea class="form-control form-control-lg shadow-sm" id="descripcion" name="descripcion" rows="5" placeholder="Explica con detalle el problema encontrado (ej. Fallo en el proyector, equipo 12 sin conexión, etc.)" required autofocus></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold shadow-sm text-dark">
                                <i class="fa-solid fa-bullhorn me-2"></i> Enviar Reporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Historial de Reportes -->
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 rounded-4 bg-white h-100">
                <div class="card-header bg-white p-4 border-0">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-timeline text-primary me-2"></i>Historial de Registros</h5>
                </div>
                <div class="card-body px-4 pt-0">
                    <?php if (empty($novedades)): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="fa-solid fa-file-shield fa-3x mb-3 text-success"></i>
                            <h6 class="fw-bold">No se han registrado novedades para este ambiente</h6>
                            <p class="small mb-0">El equipamiento del aula opera sin fallos reportados.</p>
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($novedades as $nov): ?>
                                <div class="list-group-item px-0 py-4 d-flex flex-column flex-md-row justify-content-between align-items-start">
                                    <div class="me-auto mb-2 mb-md-0">
                                        <p class="text-dark fw-medium mb-2 fs-6"><?= $nov->descripcion; ?></p>
                                        <span class="badge bg-light text-dark border me-2">
                                            <i class="fa-solid fa-user-tie text-primary me-1"></i> Reportado por: <?= $nov->usuario_nombre . ' ' . $nov->usuario_apellido; ?>
                                        </span>
                                    </div>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill px-3 py-2 small shadow-sm">
                                        <i class="fa-solid fa-calendar-day me-1"></i> <?= $nov->fecha_reporte; ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
