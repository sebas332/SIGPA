<?php if ($current_role === 'Coordinador'): ?>
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <!-- Tarjeta Formulario Programación -->
            <div class="card shadow border-0 rounded-4 bg-white">
                <div class="card-header bg-dark text-white p-4 border-0 rounded-top-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="fw-bold mb-1"><i class="fa-solid fa-calendar-plus me-2 text-success"></i>Programar Nueva Sesión Académica</h4>
                        <p class="text-white-50 small mb-0">Asigna fichas de formación, instructores, ambientes y horarios de clases.</p>
                    </div>
                </div>
                <form action="<?= URLROOT; ?>/index.php?route=programacion/create" method="POST">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="numero_ficha" class="form-label fw-medium text-secondary">Ficha de Formación</label>
                                <select class="form-select form-select-lg" id="numero_ficha" name="numero_ficha" required>
                                    <option value="">Selecciona la ficha...</option>
                                    <?php foreach ($fichas as $f): ?>
                                        <option value="<?= $f->numero_ficha; ?>">Ficha <?= $f->numero_ficha . ' - ' . $f->programa_nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_usuario" class="form-label fw-medium text-secondary">Instructor</label>
                                <select class="form-select form-select-lg" id="id_usuario" name="id_usuario" required>
                                    <option value="">Selecciona al instructor...</option>
                                    <?php foreach ($instructores as $inst): ?>
                                        <option value="<?= $inst->id_usuario; ?>"><?= $inst->nombre . ' ' . $inst->apellido; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_numero_ambiente" class="form-label fw-medium text-secondary">Ambiente de Formación (Disponibles)</label>
                                <select class="form-select form-select-lg" id="id_numero_ambiente" name="id_numero_ambiente" required>
                                    <option value="">Selecciona un ambiente...</option>
                                    <?php foreach ($ambientes as $amb): ?>
                                        <option value="<?= $amb->id_numero_ambiente; ?>"><?= $amb->nombre . ' (Capacidad: ' . $amb->capacidad . ')'; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_dias" class="form-label fw-medium text-secondary">Día de la Semana</label>
                                <select class="form-select form-select-lg" id="id_dias" name="id_dias" required>
                                    <option value="">Selecciona el día...</option>
                                    <?php foreach ($dias as $d): ?>
                                        <option value="<?= $d->id_dias; ?>"><?= $d->nombre_dia; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="hora_inicio" class="form-label fw-medium text-secondary">Hora de Inicio</label>
                                <input type="time" class="form-control form-control-lg" id="hora_inicio" name="hora_inicio" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hora_fin" class="form-label fw-medium text-secondary">Hora de Fin</label>
                                <input type="time" class="form-control form-control-lg" id="hora_fin" name="hora_fin" required>
                            </div>
                            <div class="col-md-12">
                                <label for="id_resultado_aprendizaje" class="form-label fw-medium text-secondary">Resultado de Aprendizaje (RA)</label>
                                <select class="form-select form-select-lg" id="id_resultado_aprendizaje" name="id_resultado_aprendizaje" required>
                                    <option value="">Selecciona el resultado...</option>
                                    <?php foreach ($resultados as $ra): ?>
                                        <option value="<?= $ra->id_resultado_aprendizaje; ?>"><?= $ra->codigo . ' - ' . $ra->descripcion; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label fw-medium text-secondary">Fecha de Inicio Estimada</label>
                                <input type="date" class="form-control form-control-lg" id="fecha_inicio" name="fecha_inicio" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-4 border-0 bg-light rounded-bottom-4 d-flex justify-content-end gap-2">
                        <a href="<?= URLROOT; ?>/index.php?route=dashboard/index#pills-programacion" class="btn btn-outline-secondary px-4 py-2">Cancelar</a>
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2 shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
