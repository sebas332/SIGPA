<div class="container-fluid px-0">
    <!-- Encabezado Estilizado -->
    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid rgba(0,0,0,0.06);">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Historial de Auditoría del Sistema</h5>
                <p class="text-muted small mb-0">Monitoreo en tiempo real de operaciones, inicios de sesión y modificaciones del sistema.</p>
            </div>
            <div>
                <button type="button" onclick="window.print()" class="btn btn-dark btn-sm shadow-sm fw-bold d-flex align-items-center rounded-pill px-4 py-2" style="font-size: 0.85rem;">
                    <i class="fa-solid fa-print me-2"></i> Imprimir Historial
                </button>
            </div>
        </div>
    </div>

    <!-- Buscador Superior Unificado -->
    <div class="card shadow-sm border-0 rounded-4 bg-white mb-4">
        <div class="card-body p-4">
            <form id="form-auditoria" onsubmit="event.preventDefault();">
                <div class="row">
                    <div class="col-12">
                        <label class="text-muted small fw-bold mb-2">Buscador de Auditoría</label>
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden" style="border-color: #dee2e6 !important;">
                            <span class="input-group-text bg-white border-0 text-muted ps-3"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" id="audit-search-input" class="form-control border-0 bg-white shadow-none py-2" placeholder="Escriba cualquier término (usuario, acción, tabla, IP, detalles) para filtrar el historial de inmediato...">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                    <span class="text-secondary small fw-medium" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-circle-info text-success me-1"></i> Búsqueda interactiva en tiempo real sobre los eventos auditados.
                    </span>
                    <button type="button" id="btn-limpiar-audit" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold shadow-sm border-0 bg-light-subtle" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-rotate-left me-1"></i> Limpiar Filtro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Logs de Auditoría -->
    <div class="card shadow-sm border-0 rounded-4 bg-white">
        <!-- Header de Impresión -->
        <div class="print-header d-none w-100 p-4 border-bottom mb-4">
            <table class="w-100 align-middle">
                <tr>
                    <td style="width: 80px; text-align: left;">
                        <div style="width: 60px; height: 60px; background-color: #39A900; color: #FFFFFF; font-family: Arial, sans-serif; font-weight: bold; font-size: 16pt; display: flex; align-items: center; justify-content: center; border-radius: 6px;">SENA</div>
                    </td>
                    <td>
                        <h4 class="fw-bold text-dark m-0" style="font-size: 1.25rem;">SISTEMA DE GESTIÓN ACADÉMICA (SIGPA)</h4>
                        <h5 class="fw-semibold text-success m-0" style="font-size: 1rem; color: #39A900 !important;">Registro de Auditoría General</h5>
                        <p class="text-muted small m-0">Generado el: <?= date('d/m/Y h:i A'); ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark m-0 d-flex align-items-center" style="font-size: 1.05rem;">
                <i class="fa-solid fa-clock-rotate-left text-success me-2 fs-5"></i>
                Eventos Auditados
            </h5>
            <span id="badge-total-audit" class="badge bg-light text-secondary border px-3 py-2 fw-bold" style="font-size: 0.8rem;">
                Mostrando: 0 de 0
            </span>
        </div>

        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabla-auditoria">
                    <thead class="table-light text-secondary small text-uppercase py-3">
                        <tr>
                            <th class="ps-4 text-center" style="width: 150px;">Fecha / Hora</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Acción</th>
                            <th>Tabla Afectada</th>
                            <th class="text-center">ID Registro</th>
                            <th>Dirección IP</th>
                            <th class="pe-4">Detalles de la Operación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila de Estado Vacío -->
                        <tr id="audit-empty-row" style="display: none;">
                            <td colspan="8" class="text-center p-5 text-muted">
                                <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary"></i>
                                <h6 class="fw-bold">No se encontraron eventos</h6>
                                <p class="small mb-0">No se registran acciones del sistema que coincidan con la búsqueda.</p>
                            </td>
                        </tr>

                        <?php if (empty($logs)): ?>
                            <tr>
                                <td colspan="8" class="text-center p-5 text-muted">
                                    <i class="fa-solid fa-circle-info fa-2x mb-2 text-black-50"></i>
                                    <h6 class="fw-bold">Historial Vacío</h6>
                                    <p class="small mb-0">Aún no se han registrado eventos de auditoría en el sistema.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($logs as $log): ?>
                                <?php 
                                // Definir colores de badges según acción
                                $accion = strtoupper($log['accion'] ?? '');
                                $badgeBg = 'bg-secondary';
                                if (strpos($accion, 'LOGIN') !== false || strpos($accion, 'SESION') !== false || strpos($accion, 'REGISTRO') !== false || strpos($accion, 'CREAR') !== false || strpos($accion, 'CREACION') !== false || strpos($accion, 'ASIGNAR') !== false || strpos($accion, 'ASIGNACION') !== false) {
                                    $badgeBg = 'bg-success';
                                } elseif (strpos($accion, 'ACTUALIZAR') !== false || strpos($accion, 'ACTUALIZACION') !== false || strpos($accion, 'EDITAR') !== false || strpos($accion, 'CAMBIO') !== false) {
                                    $badgeBg = 'bg-primary';
                                } elseif (strpos($accion, 'ELIMINAR') !== false || strpos($accion, 'ELIMINACION') !== false || strpos($accion, 'BORRAR') !== false || strpos($accion, 'LOGOUT') !== false || strpos($accion, 'CIERRE') !== false) {
                                    $badgeBg = 'bg-danger';
                                }
                                ?>
                                <tr class="audit-row">
                                    <td class="ps-4 text-center font-monospace text-secondary small">
                                        <?= htmlspecialchars($log['timestamp'] ?? ''); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary-subtle text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; border-radius: 50%; font-size: 11px;">
                                                <?= substr($log['usuario_nombre'] ?? 'S', 0, 1); ?>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block" style="font-size: 0.85rem;"><?= htmlspecialchars($log['usuario_nombre'] ?? ''); ?></span>
                                                <span class="text-muted font-monospace small" style="font-size: 0.75rem;">@<?= htmlspecialchars($log['usuario_login'] ?? ''); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.76rem;"><?= htmlspecialchars($log['rol'] ?? ''); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $badgeBg; ?> px-2.5 py-1 shadow-sm" style="font-size: 0.76rem;"><?= htmlspecialchars($log['accion'] ?? ''); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary border font-monospace" style="font-size: 0.74rem;"><?= htmlspecialchars($log['tabla'] ?? ''); ?></span>
                                    </td>
                                    <td class="text-center font-monospace small fw-semibold text-secondary">
                                        #<?= htmlspecialchars($log['registro_id'] ?? ''); ?>
                                    </td>
                                    <td class="font-monospace small text-muted">
                                        <?= htmlspecialchars($log['ip'] ?? '127.0.0.1'); ?>
                                    </td>
                                    <td class="pe-4 text-secondary small text-wrap" style="max-width: 320px;">
                                        <?= htmlspecialchars($log['detalles'] ?? ''); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Estilos CSS -->
<style>
.form-control {
    border-color: #dee2e6 !important;
    transition: all 0.2s ease-in-out;
}
.form-control:focus {
    border-color: #39A900 !important;
    box-shadow: 0 0 0 0.2rem rgba(57, 169, 0, 0.15) !important;
}

@media print {
    .sga-sidebar, 
    .sga-sidebar-user,
    .sga-menu-link,
    .logout,
    .footer-bottom,
    header,
    .sga-workspace-header,
    .no-print,
    .btn,
    .card-header,
    form,
    #sidebarBackdrop,
    .sga-sidebar-backdrop {
        display: none !important;
    }

    body, html {
        background-color: #ffffff !important;
        color: #000000 !important;
        margin: 0 !important;
        padding: 0 !important;
        font-family: Arial, sans-serif !important;
        font-size: 8.5pt !important;
    }
    
    .sga-app,
    .sga-workspace,
    .sga-content,
    .container-fluid,
    .card,
    .card-body {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        width: 100% !important;
    }

    .print-header {
        display: block !important;
        border-bottom: 2px solid #39A900 !important;
        margin-bottom: 20px !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 10px !important;
        font-size: 8pt !important;
    }
    
    th, td {
        border: 1px solid #dddddd !important;
        padding: 5px 3px !important;
        text-align: left;
        vertical-align: middle !important;
    }
    
    th {
        background-color: #f2f2f2 !important;
        color: #000000 !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        font-size: 7.5pt !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    tr {
        page-break-inside: avoid !important;
    }

    .badge {
        border: 1px solid #ccc !important;
        background: transparent !important;
        color: #000 !important;
        padding: 1px 3px !important;
        font-size: 7pt !important;
    }

    tbody tr[style*="display: none"] {
        display: none !important;
    }
}
</style>

<!-- Script JS para Filtrado Instantáneo -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("audit-search-input");
    const btnLimpiar = document.getElementById("btn-limpiar-audit");

    function filtrarTabla() {
        if (!searchInput) return;

        const query = searchInput.value.toLowerCase().trim();
        const rows = document.querySelectorAll("#tabla-auditoria tbody tr.audit-row");
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchesSearch = text.includes(query);

            if (matchesSearch) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Actualizar contador
        const totalBadge = document.getElementById("badge-total-audit");
        if (totalBadge) {
            totalBadge.textContent = `Mostrando: ${visibleCount} de ${rows.length}`;
        }

        // Mostrar u ocultar la fila de estado vacío
        const emptyRow = document.getElementById("audit-empty-row");
        if (emptyRow) {
            emptyRow.style.display = (visibleCount === 0 && rows.length > 0) ? "" : "none";
        }
    }

    if (btnLimpiar) {
        btnLimpiar.addEventListener("click", function() {
            searchInput.value = "";
            filtrarTabla();
        });
    }

    if (searchInput) {
        searchInput.addEventListener("input", filtrarTabla);
    }

    // Filtrar inicialmente al cargar la página
    filtrarTabla();
});
</script>
