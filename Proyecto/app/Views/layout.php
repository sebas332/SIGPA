<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_role = $_SESSION['current_role'] ?? 'Aprendiz';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? $titulo . ' - ' . SITENAME : SITENAME; ?></title>
    <!-- Favicon Oficial del SENA -->
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/8/83/Sena_Colombia_logo.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/8/83/Sena_Colombia_logo.svg" type="image/svg+xml">
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= ASSETROOT; ?>/css/styles.css?v=<?= filemtime(dirname(__DIR__, 2) . '/public/css/styles.css'); ?>">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafbfc;
            color: #212529;
        }
        .header-top {
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            padding: 0.8rem 2.5rem;
        }
        .logo-box-sena {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }
        .logo-box-sena:hover {
            transform: scale(1.05);
        }
        .sga-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.1;
        }
        .sga-title span {
            color: #39A900;
        }
        .sga-subtitle {
            font-size: 0.7rem;
            letter-spacing: 1px;
            color: #6c757d;
            font-weight: 600;
        }
        .btn-schema {
            background-color: #f1f3f5;
            color: #495057;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1.1rem;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }
        .btn-schema:hover {
            background-color: #e9ecef;
            color: #212529;
        }
        .role-badge-coord {
            background-color: #ede7f6;
            color: #6200ea;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .role-badge-inst {
            background-color: #fff8e1;
            color: #f57c00;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .role-badge-apr {
            background-color: #e0f2f1;
            color: #00796b;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .profile-avatar-link { display: inline-flex; border-radius: 50%; }
        .profile-avatar-link:hover .user-avatar { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(57,169,0,0.22); }
        .logout-link {
            color: #adb5bd;
            font-size: 1.2rem;
            transition: color 0.2s ease;
        }
        .logout-link:hover {
            color: #dc3545;
        }
        .footer-bottom {
            background-color: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            padding: 1.5rem 2.5rem;
            font-size: 0.82rem;
            color: #868e96;
        }
        .footer-bottom a {
            color: #868e96;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-bottom a:hover {
            color: #212529;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['user_id'])):
    $currentRoute = $_GET['route'] ?? 'dashboard/index';
    $avatarUrl = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=120&auto=format&fit=crop';
    if ($current_role === 'Instructor') $avatarUrl = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=120&auto=format&fit=crop';
    if ($current_role === 'Aprendiz') $avatarUrl = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop';
    $profileDirectory = dirname(__DIR__, 2) . '/public/uploads/profiles';
    $profilePhotos = glob($profileDirectory . '/user_' . (int) $_SESSION['user_id'] . '.*') ?: [];
    if (!empty($profilePhotos)) $avatarUrl = ASSETROOT . '/uploads/profiles/' . rawurlencode(basename($profilePhotos[0])) . '?v=' . filemtime($profilePhotos[0]);
    
    $menus = [
        'Coordinador' => [
            'MENÚ PRINCIPAL' => [
                ['dashboard/index#pills-vision', 'fa-house', 'Visión General'],
                ['dashboard/index#pills-fichas', 'fa-users', 'Fichas Académicas'],
                ['dashboard/index#pills-programas', 'fa-graduation-cap', 'Programas Formativos'],
                ['dashboard/index#pills-programacion', 'fa-clock', 'Horarios de Ficha'],
                ['dashboard/index#pills-ambientes', 'fa-building', 'Ambientes Físicos'],
                ['dashboard/index#pills-novedades', 'fa-triangle-exclamation', 'Novedades de Sede']
            ],
            'REPORTES Y CONTROL' => [
                ['#', 'fa-chart-pie', 'Reportes'],
                ['#', 'fa-shield-halved', 'Auditoría']
            ],
            'CONFIGURACIÓN' => [
                ['dashboard/index#pills-usuarios', 'fa-users-gear', 'Usuarios'],
                ['#', 'fa-user-lock', 'Roles y Permisos'],
                ['#', 'fa-sliders', 'Configuración']
            ]
        ],
        'Instructor' => [
            'MENÚ PRINCIPAL' => [
                ['dashboard/index', 'fa-house', 'Visión General'],
                ['dashboard/index#pills-inst-horario', 'fa-calendar-days', 'Mis clases'],
                ['dashboard/index#pills-inst-asistencia', 'fa-clipboard-check', 'Registrar asistencia'],
                ['dashboard/index#pills-inst-novedad', 'fa-triangle-exclamation', 'Reportar novedad']
            ],
            'CUENTA Y CONTROL' => [
                ['perfil/index', 'fa-user-gear', 'Mi información']
            ]
        ],
        'Aprendiz' => [
            'MENÚ PRINCIPAL' => [
                ['dashboard/index', 'fa-house', 'Visión General'],
                ['dashboard/index#pills-apr-ficha', 'fa-id-card', 'Mi ficha académica'],
                ['dashboard/index#pills-apr-horario', 'fa-calendar-days', 'Horario de clases'],
                ['dashboard/index#pills-apr-asist', 'fa-chart-line', 'Mi asistencia']
            ],
            'CUENTA Y CONTROL' => [
                ['perfil/index', 'fa-user-gear', 'Mi información']
            ]
        ]
    ];
    $roleMenu = $menus[$current_role] ?? $menus['Aprendiz'];
?>
<div class="sga-app">
    <aside class="sga-sidebar" id="sgaSidebar">
        <a class="sga-brand" href="<?= URLROOT; ?>/index.php?route=dashboard/index">
            <span class="sga-brand-icon"><i class="fa-solid fa-box-open"></i></span>
            <span><strong>InsideBox SGA</strong><small>Gestión Educativa Integral</small></span>
        </a>
        <label class="sga-menu-search"><i class="fa-solid fa-magnifying-glass"></i><input id="menuSearch" type="search" placeholder="Buscar en el sistema..."></label>
        <nav class="sga-menu" aria-label="Menú principal">
            <?php foreach ($roleMenu as $sectionName => $items): ?>
                <span class="sga-menu-title"><?= htmlspecialchars($sectionName); ?></span>
                <?php foreach ($items as $item): 
                    $badgeHtml = "";
                    if ($item[2] === 'Fichas Académicas') {
                        $badgeHtml = '<span class="badge bg-warning text-white ms-auto" style="border-radius: 50%; font-size: 0.65rem; width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center; padding: 0;">4</span>';
                    }
                    // Activar el link si coincide con el hash o ruta
                    $isActive = false;
                    $itemHash = strpos($item[0], '#') !== false ? substr($item[0], strpos($item[0], '#')) : '';
                    if ($itemHash) {
                        $isActive = false; // Se manejará vía JS para hashes
                    } else {
                        $isActive = ($currentRoute === $item[0]);
                    }
                ?>
                    <a class="sga-menu-link <?= $isActive ? 'active' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=<?= $item[0]; ?>" data-hash="<?= htmlspecialchars($itemHash); ?>">
                        <i class="fa-solid <?= $item[1]; ?>"></i>
                        <span><?= htmlspecialchars($item[2]); ?></span>
                        <?= $badgeHtml; ?>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <a class="sga-menu-link logout mt-auto" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar sesión</span></a>
        </nav>
        <a class="sga-sidebar-user" href="<?= URLROOT; ?>/index.php?route=perfil/index">
            <img src="<?= htmlspecialchars($avatarUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil">
            <span><strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong><small><?= htmlspecialchars($current_role); ?></small></span>
        </a>
    </aside>
    <button id="sidebarBackdrop" class="sga-sidebar-backdrop" type="button" aria-label="Cerrar menú"></button>
    <section class="sga-workspace">
        <header class="sga-topbar">
            <button id="menuToggle" class="sga-topbar-button menu-button" type="button" aria-label="Abrir menú"><i class="fa-solid fa-bars"></i></button>
            <label class="sga-global-search mx-auto"><i class="fa-solid fa-magnifying-glass"></i><input type="search" placeholder="Buscar..."></label>
            <div class="sga-topbar-actions">
                <?php if (isset($_SESSION['user_roles']) && count($_SESSION['user_roles']) > 1): ?>
                <div class="dropdown"><button class="sga-topbar-button" data-bs-toggle="dropdown" title="Cambiar rol"><i class="fa-solid fa-user-tag"></i></button><ul class="dropdown-menu dropdown-menu-end border-0 shadow"><?php foreach ($_SESSION['user_roles'] as $rol): ?><li><a class="dropdown-item <?= $rol === $current_role ? 'active bg-success' : ''; ?>" href="<?= URLROOT; ?>/index.php?route=auth/switchRole&role=<?= urlencode($rol); ?>"><?= htmlspecialchars($rol); ?></a></li><?php endforeach; ?></ul></div>
                <?php endif; ?>
                <button class="sga-topbar-button" type="button" title="Notificaciones">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge-notify"></span>
                </button>
                <button class="sga-topbar-button" type="button" title="Ayuda">
                    <i class="fa-regular fa-circle-question"></i>
                </button>
                <a class="sga-topbar-user" href="<?= URLROOT; ?>/index.php?route=perfil/index"><img src="<?= htmlspecialchars($avatarUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="Perfil"><span><strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong><small><?= htmlspecialchars($current_role); ?></small></span></a>
            </div>
        </header>
        <main class="sga-content">
<?php else: ?>
<main class="container-fluid py-4 px-4 px-md-5">
<?php endif; ?>
    <?php 
    $currentRoute = $_GET['route'] ?? (isset($_SESSION['user_id']) ? 'dashboard/index' : 'auth/login');
    if ($currentRoute !== 'dashboard/index' && $currentRoute !== 'auth/login' && $currentRoute !== 'auth/index'): 
    ?>
        <div class="mb-4">
            <a href="javascript:history.back()" class="btn btn-sm shadow-sm" style="background-color: #ffffff; color: #495057; border: 1px solid rgba(0,0,0,0.1); border-radius: 20px; font-weight: 600; padding: 0.4rem 1rem; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';" onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#495057';">
                <i class="fa-solid fa-arrow-left me-2"></i> Volver Atrás
            </a>
        </div>
    <?php endif; ?>

    <!-- Alertas Flash -->
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center rounded-4 mb-4" role="alert">
            <i class="fa-solid fa-circle-check fs-4 me-3"></i>
            <div><?= $_SESSION['flash_success']; ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center rounded-4 mb-4" role="alert">
            <i class="fa-solid fa-triangle-exclamation fs-4 me-3"></i>
            <div><?= $_SESSION['flash_error']; ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <!-- Renderizado del Contenido (Subvista) -->
    <?php require_once $contentView; ?>
</main>

<!-- Pie de Página Institucional -->
<footer class="footer-bottom">
    <div class="container-fluid px-0 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="mb-2 mb-md-0">
            SGA SENA © <?= date('Y'); ?> • Sistema de Gestión Académica Integral
        </div>
        <div class="d-flex gap-4">
            <a href="#">Políticas de Privacidad</a>
            <span>•</span>
            <a href="#">Soporte Tecnológico SIGA</a>
        </div>
    </div>
</footer>
<?php if (isset($_SESSION['user_id'])): ?>
    </section>
</div>
<?php endif; ?>

<!-- Modal Confirmación de Cierre de Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg text-center p-4">
            <div class="modal-body">
                <div class="mb-4 text-danger">
                    <div style="width: 80px; height: 80px; background-color: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-2">¿Estás seguro de salir?</h4>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">Se cerrará tu sesión actual en el Sistema de Gestión Académica y regresarás a la pantalla de inicio.</p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-light border px-4 py-2 fw-medium shadow-sm text-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="<?= URLROOT; ?>/index.php?route=auth/logout" class="btn btn-danger px-4 py-2 fw-bold shadow-sm" style="background-color: #dc2626; border-color: #dc2626;">Salir del Sistema</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        var toggle = document.getElementById('menuToggle');
        var backdrop = document.getElementById('sidebarBackdrop');
        function closeMenu() { document.body.classList.remove('sga-menu-open'); }
        if (toggle) toggle.addEventListener('click', function () { document.body.classList.toggle('sga-menu-open'); });
        if (backdrop) backdrop.addEventListener('click', closeMenu);
        document.querySelectorAll('.sga-menu-link').forEach(function (link) { link.addEventListener('click', closeMenu); });

        var menuSearch = document.getElementById('menuSearch');
        if (menuSearch) menuSearch.addEventListener('input', function () {
            var query = this.value.toLowerCase().trim();
            document.querySelectorAll('.sga-menu-link').forEach(function (link) {
                // No buscar sobre la etiqueta de sección
                var text = link.textContent.toLowerCase();
                link.style.display = text.includes(query) ? 'flex' : 'none';
            });
        });

        // Activar la pestaña correcta según el hash de la URL
        function activateTabFromHash() {
            var hash = window.location.hash || '#pills-vision';
            var trigger = document.querySelector('[data-bs-target="' + hash + '"]');
            if (trigger) {
                bootstrap.Tab.getOrCreateInstance(trigger).show();
                
                // Desactivar todos los links laterales
                document.querySelectorAll('.sga-menu-link').forEach(function (link) {
                    link.classList.remove('active');
                });
                
                // Buscar el link que corresponde a este hash
                var activeLink = document.querySelector('.sga-menu-link[data-hash="' + hash + '"]');
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        }

        window.addEventListener('hashchange', activateTabFromHash);
        activateTabFromHash();

        // Al hacer clic en un enlace de menú con hash
        document.querySelectorAll('.sga-menu-link[data-hash]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var hash = this.getAttribute('data-hash');
                if (hash && hash !== '#') {
                    // Si ya estamos en dashboard/index, evitamos recargar la página completa
                    if (window.location.search.includes('route=dashboard/index') || window.location.search === '') {
                        window.location.hash = hash;
                        e.preventDefault();
                    }
                }
            });
        });

        // Cerrar automáticamente las alertas flash después de 5 segundos
        var alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                if (bsAlert) {
                    bsAlert.close();
                }
            }, 5000);
        });
    });
</script>
</body>
</html>
