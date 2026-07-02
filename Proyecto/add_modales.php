<?php
$file = 'app/Views/dashboard/index.php';
$content = file_get_contents($file);

$modales = <<<HTML

<!-- MODAL EDITAR FICHA -->
<div class="modal fade" id="modalEditarFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Ficha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=fichas/update" method="POST">
                <div class="modal-body px-4 py-4 px-md-5">
                    <input type="hidden" name="numero_ficha_original" id="edit_numero_ficha_original">
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Número de Ficha</label>
                            <input type="number" name="numero_ficha" id="edit_numero_ficha" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="text-muted small fw-bold mb-2">Programa de Formación</label>
                            <select name="id_programa" id="edit_id_programa" class="form-select shadow-sm" required>
                                <?php if(isset(\$programas)): foreach (\$programas as \$prog): ?>
                                    <option value="<?= \$prog->id_programa; ?>"><?= \$prog->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Instructor Líder</label>
                            <select name="id_usuario_instructor_lider" id="edit_instructor_lider" class="form-select shadow-sm" required>
                                <?php if(isset(\$instructores)): foreach (\$instructores as \$inst): ?>
                                    <option value="<?= \$inst->id_usuario; ?>"><?= \$inst->nombre . ' ' . \$inst->apellido; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Jornada</label>
                            <select name="id_jornada" id="edit_jornada" class="form-select shadow-sm" required>
                                <?php if(isset(\$jornadas)): foreach (\$jornadas as \$jor): ?>
                                    <option value="<?= \$jor->id_jornada; ?>"><?= \$jor->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Cant. Estudiantes</label>
                            <input type="number" name="cantidad_estudiantes" id="edit_cantidad_estudiantes" class="form-control shadow-sm" required>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="edit_fecha_inicio" class="form-control shadow-sm" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Prácticas</label>
                            <input type="date" name="fecha_practicas" id="edit_fecha_practicas" class="form-control shadow-sm">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="text-muted small fw-bold mb-2">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="edit_fecha_fin" class="form-control shadow-sm" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL CREAR AMBIENTE -->
<div class="modal fade" id="modalCrearAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Crear Nuevo Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/create" method="POST">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Nombre Ambiente</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Tipo (Ej. Laboratorio)</label>
                            <input type="text" name="tipo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Capacidad</label>
                            <input type="number" name="capacidad" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Computadores</label>
                            <input type="number" name="computadores" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Especialidad</label>
                            <input type="text" name="especialidad_ambiente" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small fw-bold mb-2">Equipamiento</label>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="aire" value="1" id="chk_aire">
                                    <label class="form-check-label" for="chk_aire">Aire</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ventilador" value="1" id="chk_vent">
                                    <label class="form-check-label" for="chk_vent">Ventilador</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tablero" value="1" id="chk_tablero">
                                    <label class="form-check-label" for="chk_tablero">Tablero</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tv" value="1" id="chk_tv">
                                    <label class="form-check-label" for="chk_tv">TV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponibilidad" value="1" id="chk_disp" checked>
                                    <label class="form-check-label" for="chk_disp">Disponible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR AMBIENTE -->
<div class="modal fade" id="modalEditarAmbiente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=ambientes/update" method="POST">
                <input type="hidden" name="id_numero_ambiente" id="edit_amb_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Nombre Ambiente</label>
                            <input type="text" name="nombre" id="edit_amb_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Tipo</label>
                            <input type="text" name="tipo" id="edit_amb_tipo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Capacidad</label>
                            <input type="number" name="capacidad" id="edit_amb_capacidad" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Computadores</label>
                            <input type="number" name="computadores" id="edit_amb_computadores" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Especialidad</label>
                            <input type="text" name="especialidad_ambiente" id="edit_amb_especialidad" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small fw-bold mb-2">Equipamiento</label>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="aire" value="1" id="edit_amb_aire">
                                    <label class="form-check-label">Aire</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ventilador" value="1" id="edit_amb_vent">
                                    <label class="form-check-label">Ventilador</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tablero" value="1" id="edit_amb_tablero">
                                    <label class="form-check-label">Tablero</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tv" value="1" id="edit_amb_tv">
                                    <label class="form-check-label">TV</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponibilidad" value="1" id="edit_amb_disp">
                                    <label class="form-check-label">Disponible</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL CREAR PROGRAMA -->
<div class="modal fade" id="modalCrearPrograma" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Crear Programa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/create" method="POST">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="text-muted small fw-bold mb-1">Nombre Programa</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Código</label>
                            <input type="text" name="codigo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Versión</label>
                            <input type="text" name="version" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Vigencia</label>
                            <input type="text" name="vigencia" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Tipo Programa</label>
                            <select name="id_tipo_programa" class="form-select" required>
                                <?php if(isset(\$tipos)): foreach(\$tipos as \$t): ?>
                                    <option value="<?= \$t->id_tipo_programa; ?>"><?= \$t->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Lectiva (hrs)</label>
                            <input type="number" name="duracion_lectiva" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Práctica (hrs)</label>
                            <input type="number" name="duracion_practica" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PROGRAMA -->
<div class="modal fade" id="modalEditarPrograma" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Programa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=programas/update" method="POST">
                <input type="hidden" name="id_programa" id="edit_prog_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="text-muted small fw-bold mb-1">Nombre Programa</label>
                            <input type="text" name="nombre" id="edit_prog_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Código</label>
                            <input type="text" name="codigo" id="edit_prog_codigo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Versión</label>
                            <input type="text" name="version" id="edit_prog_version" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Vigencia</label>
                            <input type="text" name="vigencia" id="edit_prog_vigencia" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small fw-bold mb-1">Tipo Programa</label>
                            <select name="id_tipo_programa" id="edit_prog_tipo" class="form-select" required>
                                <?php if(isset(\$tipos)): foreach(\$tipos as \$t): ?>
                                    <option value="<?= \$t->id_tipo_programa; ?>"><?= \$t->nombre; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Lectiva (hrs)</label>
                            <input type="number" name="duracion_lectiva" id="edit_prog_lectiva" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Duración Práctica (hrs)</label>
                            <input type="number" name="duracion_practica" id="edit_prog_practica" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR USUARIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light px-4 py-4">
                <h5 class="modal-title fw-bold text-dark">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URLROOT; ?>/index.php?route=usuarios/update" method="POST">
                <input type="hidden" name="id_usuario" id="edit_usr_id">
                <div class="modal-body px-4 py-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Nombres</label>
                            <input type="text" name="nombre" id="edit_usr_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Apellidos</label>
                            <input type="text" name="apellido" id="edit_usr_apellido" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Documento</label>
                            <input type="number" name="documento" id="edit_usr_documento" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Contraseña (Opcional)</label>
                            <input type="text" name="contrasena" placeholder="Dejar en blanco para no cambiar" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Teléfono</label>
                            <input type="text" name="telefono" id="edit_usr_telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-bold mb-1">Correo</label>
                            <input type="email" name="correo" id="edit_usr_correo" class="form-control" required>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="text-muted small fw-bold mb-1">Titulación</label>
                            <input type="text" name="titulacion" id="edit_usr_titulacion" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

HTML;

$js = <<<JS
function editarFicha(ficha, cant, inicio, practicas, fin, id_lider, id_prog, id_jor) {
    document.getElementById('edit_numero_ficha_original').value = ficha;
    document.getElementById('edit_numero_ficha').value = ficha;
    document.getElementById('edit_id_programa').value = id_prog;
    document.getElementById('edit_instructor_lider').value = id_lider;
    document.getElementById('edit_jornada').value = id_jor;
    document.getElementById('edit_cantidad_estudiantes').value = cant;
    document.getElementById('edit_fecha_inicio').value = inicio;
    document.getElementById('edit_fecha_practicas').value = practicas;
    document.getElementById('edit_fecha_fin').value = fin;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarFicha'));
    modal.show();
}

function editarAmbiente(id, nombre, tipo, cap, comp, esp, aire, vent, tab, tv, disp) {
    document.getElementById('edit_amb_id').value = id;
    document.getElementById('edit_amb_nombre').value = nombre;
    document.getElementById('edit_amb_tipo').value = tipo;
    document.getElementById('edit_amb_capacidad').value = cap;
    document.getElementById('edit_amb_computadores').value = comp;
    document.getElementById('edit_amb_especialidad').value = esp;
    document.getElementById('edit_amb_aire').checked = aire == 1;
    document.getElementById('edit_amb_vent').checked = vent == 1;
    document.getElementById('edit_amb_tablero').checked = tab == 1;
    document.getElementById('edit_amb_tv').checked = tv == 1;
    document.getElementById('edit_amb_disp').checked = disp == 1;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAmbiente'));
    modal.show();
}

function editarPrograma(id, nombre, codigo, ver, vig, lec, prac, tipo) {
    document.getElementById('edit_prog_id').value = id;
    document.getElementById('edit_prog_nombre').value = nombre;
    document.getElementById('edit_prog_codigo').value = codigo;
    document.getElementById('edit_prog_version').value = ver;
    document.getElementById('edit_prog_vigencia').value = vig;
    document.getElementById('edit_prog_lectiva').value = lec;
    document.getElementById('edit_prog_practica').value = prac;
    document.getElementById('edit_prog_tipo').value = tipo;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarPrograma'));
    modal.show();
}

function editarUsuario(id, nom, ape, doc, tel, cor, tit) {
    document.getElementById('edit_usr_id').value = id;
    document.getElementById('edit_usr_nombre').value = nom;
    document.getElementById('edit_usr_apellido').value = ape;
    document.getElementById('edit_usr_documento').value = doc;
    document.getElementById('edit_usr_telefono').value = tel;
    document.getElementById('edit_usr_correo').value = cor;
    document.getElementById('edit_usr_titulacion').value = tit;
    var modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
    modal.show();
}
JS;

$content = str_replace("<?php endif; ?>\n\n<!-- Script de Automatización:", $modales . "\n<?php endif; ?>\n\n<!-- Script de Automatización:", $content);
$content = str_replace('</script>', $js . "\n</script>", $content);
file_put_contents($file, $content);
?>
