<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Catálogo e Infraestructura de Ambientes</h3>
            <p class="text-muted small mb-0">Gestión de aulas, dotación técnica y disponibilidad en tiempo real</p>
        </div>
        <?php if ($current_role === 'Coordinador'): ?>
            <button type="button" class="btn btn-primary shadow-sm fw-medium" data-bs-toggle="modal" data-bs-target="#modalCrearAmbiente">
                <i class="fa-solid fa-plus me-2"></i> Registrar Ambiente
            </button>
        <?php endif; ?>
    </div>

    <!-- Catálogo en Tarjetas (Premium UI) -->
    <div class="row g-4">
        <?php if (empty($ambientes)): ?>
            <div class="col-12">
                <div class="p-5 bg-white shadow-sm rounded-4 text-center text-muted">
                    <i class="fa-solid fa-building-circle-xmark fa-3x mb-3 text-secondary"></i>
                    <h5 class="fw-bold">No hay ambientes registrados en el sistema</h5>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($ambientes as $a): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100 bg-white overflow-hidden d-flex flex-column">
                        <!-- Portada / Representación de la Foto -->
                        <div class="bg-dark position-relative" style="height: 180px; overflow: hidden;">
                            <?php 
                            $ambienteFotos = $fotos[$a->id_numero_ambiente] ?? []; 
                            if (!empty($ambienteFotos)): 
                                $foto = $ambienteFotos[0];
                            ?>
                                <img src="<?= $foto->url; ?>" class="w-100 h-100 object-fit-cover opacity-50" alt="<?= $a->nombre; ?>" onerror="this.src='https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop';">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop" class="w-100 h-100 object-fit-cover opacity-50" alt="Aula General">
                            <?php endif; ?>

                            <!-- Badge Disponibilidad -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <?php if ($a->disponibilidad == 1): ?>
                                    <span class="badge bg-success shadow-sm px-3 py-2 fs-6"><i class="fa-solid fa-circle-check me-1"></i> Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-danger shadow-sm px-3 py-2 fs-6"><i class="fa-solid fa-circle-xmark me-1"></i> Ocupado / Inactivo</span>
                                <?php endif; ?>
                            </div>

                            <div class="position-absolute bottom-0 start-0 m-3 text-white">
                                <span class="badge bg-primary mb-1"><?= $a->tipo; ?></span>
                                <h5 class="fw-bold mb-0 text-white shadow-sm"><?= $a->nombre; ?></h5>
                            </div>
                        </div>

                        <!-- Dotación y Especificaciones -->
                        <div class="card-body p-4 flex-grow-1">
                            <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Especificaciones del Ambiente</h6>
                            <div class="row g-2 mb-3 text-muted small">
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-users me-2 text-success"></i> Capacidad: <strong class="text-dark ms-1"><?= $a->capacidad; ?></strong>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-desktop me-2 text-info"></i> Equipos: <strong class="text-dark ms-1"><?= $a->computadores; ?></strong>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-fan me-2 text-primary"></i> Aire Acond: 
                                    <strong class="text-dark ms-1"><?= $a->aire ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>'; ?></strong>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-tv me-2 text-warning"></i> Televisor: 
                                    <strong class="text-dark ms-1"><?= $a->tv ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>'; ?></strong>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-wind me-2 text-secondary"></i> Ventilador: 
                                    <strong class="text-dark ms-1"><?= $a->ventilador ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>'; ?></strong>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <i class="fa-solid fa-chalkboard me-2 text-dark"></i> Tablero: 
                                    <strong class="text-dark ms-1"><?= $a->tablero ? '<i class="fa-solid fa-check text-success"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>'; ?></strong>
                                </div>
                            </div>
                            <div class="p-2 bg-light rounded-3 border small">
                                <strong>Especialidad:</strong> <?= $a->especialidad_ambiente; ?>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="card-footer bg-white p-4 border-top border-light-subtle d-flex flex-wrap gap-2 justify-content-between align-items-center">
                            <a href="<?= URLROOT; ?>/index.php?route=ambientes/novedad&id=<?= $a->id_numero_ambiente; ?>" class="btn btn-outline-warning btn-sm fw-medium shadow-sm text-dark border-warning-subtle">
                                <i class="fa-solid fa-triangle-exclamation me-1 text-warning"></i> Novedades
                            </a>

                            <?php if ($current_role === 'Coordinador'): ?>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm shadow-sm" onclick="editarAmbiente(<?= $a->id_numero_ambiente; ?>, '<?= addslashes($a->nombre); ?>', '<?= addslashes($a->tipo); ?>', <?= $a->capacidad; ?>, <?= $a->computadores; ?>, '<?= addslashes($a->especialidad_ambiente); ?>', <?= $a->aire; ?>, <?= $a->ventilador; ?>, <?= $a->tablero; ?>, <?= $a->tv; ?>, <?= $a->disponibilidad; ?>)" data-bs-toggle="tooltip" title="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <a href="<?= URLROOT; ?>/index.php?route=ambientes/toggleDisponibilidad&id=<?= $a->id_numero_ambiente; ?>" class="btn btn-outline-secondary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Cambiar Disponibilidad">
                                        <i class="fa-solid fa-power-off"></i>
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm shadow-sm" onclick="eliminarAmbiente(<?= $a->id_numero_ambiente; ?>)" data-bs-toggle="tooltip" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if ($current_role === 'Coordinador'): ?>
<!-- Modal Crear Ambiente -->
<div class="modal fade" id="modalCrearAmbiente" tabindex="-1" aria-labelledby="modalCrearAmbienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-dark text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalCrearAmbienteLabel"><i class="fa-solid fa-building me-2 text-success"></i>Registrar Nuevo Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/create" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-medium text-secondary">Nombre del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Ej. Laboratorio de Software 2" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipo" class="form-label fw-medium text-secondary">Tipo (Ej. Laboratorio)</label>
                            <select class="form-select form-select-lg" id="tipo" name="tipo" onchange="toggleEspecialidad(this, 'especialidad_ambiente')" required>
                                <option value="" disabled selected>Seleccione un tipo</option>
                                <option value="Convencional">Convencional</option>
                                <option value="Especializado">Especializado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="capacidad" class="form-label fw-medium text-secondary">Capacidad (Max 2 dígitos)</label>
                            <input type="text" class="form-control form-control-lg" id="capacidad" name="capacidad" placeholder="Ej. 35" oninput="validarNumeros(this, 2)" required>
                        </div>
                        <div class="col-md-4">
                            <label for="computadores" class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="computadores" name="computadores" placeholder="Ej. 35" oninput="validarNumeros(this, 3)" required>
                        </div>
                        <div class="col-md-4" id="div_especialidad_ambiente" style="display:none;">
                            <label for="especialidad_ambiente" class="form-label fw-medium text-secondary">Especialidad del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="especialidad_ambiente" name="especialidad_ambiente" placeholder="Ej. Desarrollo de Software, Redes, SST">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mt-2 mb-2">Fotos del Ambiente (Opcional)</label>
                            <input type="file" class="form-control form-control-lg" name="fotos[]" multiple accept="image/*">
                            <small class="text-muted">Puedes seleccionar varias imágenes a la vez.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mb-3">Dotación e Instalaciones</label>
                            <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded-3 border border-secondary-subtle">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="aire" name="aire" value="1" checked>
                                    <label class="form-check-label fw-medium" for="aire">Aire Acondicionado</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="ventilador" name="ventilador" value="1">
                                    <label class="form-check-label fw-medium" for="ventilador">Ventilador</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="tablero" name="tablero" value="1" checked>
                                    <label class="form-check-label fw-medium" for="tablero">Tablero / Pizarra</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="tv" name="tv" value="1" checked>
                                    <label class="form-check-label fw-medium" for="tv">Televisor</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="disponibilidad" name="disponibilidad" value="1" checked>
                                    <label class="form-check-label fw-medium text-success" for="disponibilidad">Disponible de Inmediato</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Ambiente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Ambiente -->
<div class="modal fade" id="modalEditarAmbiente" tabindex="-1" aria-labelledby="modalEditarAmbienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-primary text-white p-4 border-0">
                <h5 class="modal-title fw-bold" id="modalEditarAmbienteLabel"><i class="fa-solid fa-pen me-2"></i>Editar Ambiente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_numero_ambiente" id="edit_amb_id">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Nombre del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_nombre" name="nombre" maxlength="15" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-secondary">Tipo</label>
                            <select class="form-select form-select-lg" id="edit_amb_tipo" name="tipo" onchange="toggleEspecialidad(this, 'edit_amb_especialidad')" required>
                                <option value="Convencional">Convencional</option>
                                <option value="Especializado">Especializado</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary">Capacidad (Max 2 dígitos)</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_capacidad" name="capacidad" oninput="validarNumeros(this, 2)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-secondary">Cantidad de Computadores</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_computadores" name="computadores" oninput="validarNumeros(this, 3)" required>
                        </div>
                        <div class="col-md-4" id="div_edit_amb_especialidad" style="display:none;">
                            <label class="form-label fw-medium text-secondary">Especialidad del Ambiente</label>
                            <input type="text" class="form-control form-control-lg" id="edit_amb_especialidad" name="especialidad_ambiente">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mt-2 mb-2">Agregar Nuevas Fotos (Opcional)</label>
                            <input type="file" class="form-control form-control-lg" name="fotos[]" multiple accept="image/*">
                            <small class="text-muted">Puedes seleccionar varias imágenes. Las existentes se mantendrán.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium text-secondary d-block mb-3">Dotación e Instalaciones</label>
                            <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded-3 border border-secondary-subtle">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_aire" name="aire" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_aire">Aire Acondicionado</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_vent" name="ventilador" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_vent">Ventilador</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tablero" name="tablero" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_tablero">Tablero / Pizarra</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_tv" name="tv" value="1">
                                    <label class="form-check-label fw-medium" for="edit_amb_tv">Televisor</label>
                                </div>
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input" type="checkbox" id="edit_amb_disp" name="disponibilidad" value="1">
                                    <label class="form-check-label fw-medium text-success" for="edit_amb_disp">Disponible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-4 border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary fw-bold shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleEspecialidad(selectElement, targetId) {
    var target = document.getElementById(targetId);
    var divTarget = document.getElementById('div_' + targetId);
    if (selectElement.value === 'Especializado') {
        divTarget.style.display = 'block';
        target.setAttribute('required', 'required');
    } else {
        divTarget.style.display = 'none';
        target.removeAttribute('required');
        target.value = '';
    }
}

function validarLetras(input) {
    input.value = input.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
}

function validarNumeros(input, maxLen) {
    input.value = input.value.replace(/[^0-9]/g, '');
    if (input.value.length > maxLen) {
        input.value = input.value.slice(0, maxLen);
    }
}

function editarAmbiente(id, nombre, tipo, cap, comp, esp, aire, vent, tab, tv, disp) {
    document.getElementById('edit_amb_id').value = id;
    document.getElementById('edit_amb_nombre').value = nombre;
    document.getElementById('edit_amb_tipo').value = tipo;
    
    // Disparar toggle de especialidad
    toggleEspecialidad(document.getElementById('edit_amb_tipo'), 'edit_amb_especialidad');
    
    document.getElementById('edit_amb_capacidad').value = cap;
    document.getElementById('edit_amb_computadores').value = comp;
    document.getElementById('edit_amb_especialidad').value = esp;
    document.getElementById('edit_amb_aire').checked = (aire == 1);
    document.getElementById('edit_amb_vent').checked = (vent == 1);
    document.getElementById('edit_amb_tablero').checked = (tab == 1);
    document.getElementById('edit_amb_tv').checked = (tv == 1);
    document.getElementById('edit_amb_disp').checked = (disp == 1);
    
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAmbiente'));
    modal.show();
}

function eliminarAmbiente(id) {
    if(confirm('¿Está seguro de eliminar este ambiente? Esta acción no se puede deshacer.')) {
        window.location.href = '<?= URLROOT; ?>/index.php?route=ambientes/delete&id=' + id;
    }
}
</script>
<?php endif; ?>
