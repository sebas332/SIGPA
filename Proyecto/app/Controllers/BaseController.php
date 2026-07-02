<?php
/**
 * Controlador Base
 * Carga los modelos y vistas. Todos los demás controladores heredan de esta clase.
 */
class BaseController {
    /**
     * Instanciar un modelo
     * @param string $model
     * @return object
     */
    protected function model($model) {
        require_once APPROOT . '/Models/' . $model . '.php';
        return new $model();
    }

    /**
     * Cargar una vista dentro del layout maestro
     * @param string $view Ruta relativa de la vista (ej. 'dashboard/index')
     * @param array $data Datos pasados a la vista
     */
    protected function render($view, $data = []) {
        // Desempaquetar el array en variables individuales para usar en las vistas
        extract($data);
        
        $contentView = APPROOT . '/Views/' . $view . '.php';
        if (file_exists($contentView)) {
            require_once APPROOT . '/Views/layout.php';
        } else {
            die('La vista ' . $view . ' no existe.');
        }
    }

    /**
     * Redirigir a otra ruta dentro del sistema
     * @param string $url Ruta o parámetro route (ej. 'dashboard/index')
     */
    protected function redirect($url) {
        header('Location: ' . URLROOT . '/index.php?route=' . $url);
        exit;
    }

    /**
     * Verificar si el usuario ha iniciado sesión
     */
    protected function requireLogin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }

    /**
     * Verificar si el usuario tiene un rol específico
     * @param string $rol Nombre del rol requerido (ej. 'Coordinador', 'Instructor', 'Aprendiz')
     */
    protected function requireRol($rol) {
        $this->requireLogin();
        if (!isset($_SESSION['user_roles']) || !in_array($rol, $_SESSION['user_roles'])) {
            $_SESSION['flash_error'] = 'No tienes permisos para acceder a esta sección.';
            $this->redirect('dashboard/index');
        }
    }
}
