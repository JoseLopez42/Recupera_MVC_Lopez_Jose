<?php

class VueloController
{
    private Vuelo $model;

    public function __construct(Vuelo $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $vuelos = $this->model->listar();
        require __DIR__ . '/../Views/vuelo/index.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $numero_vuelo = trim($_POST['numero_vuelo'] ?? '');
            $aerolinea = trim($_POST['aerolinea'] ?? '');
            $origen = trim($_POST['origen'] ?? '');
            $destino = trim($_POST['destino'] ?? '');
            $fecha_salida = trim($_POST['fecha_salida'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $capacidad_maxima = trim($_POST['capacidad_maxima'] ?? '');

            if ($numero_vuelo === '' || $aerolinea === '' || $origen === '' || $destino === ''
                || $fecha_salida === '' || $precio === '' || $capacidad_maxima === '') {
                $error = 'Todos los campos del vuelo son obligatorios.';
                require __DIR__ . '/../Views/vuelo/crear.php';
                return;
            }

            if ($this->model->existeNumeroVuelo($numero_vuelo)) {
                $error = 'Ya existe un vuelo registrado con ese número de vuelo.';
                require __DIR__ . '/../Views/vuelo/crear.php';
                return;
            }

            try {
                $this->model->numero_vuelo = $numero_vuelo;
                $this->model->aerolinea = $aerolinea;
                $this->model->origen = $origen;
                $this->model->destino = $destino;
                $this->model->fecha_salida = $fecha_salida;
                $this->model->precio = (float) $precio;
                $this->model->capacidad_maxima = (int) $capacidad_maxima;

                if ($this->model->guardar()) {
                    header('Location: Index.php?action=listar_vuelos&ok=1');
                    exit;
                }

                $error = 'No se pudo guardar el vuelo.';
                require __DIR__ . '/../Views/vuelo/crear.php';

            } catch (PDOException $e) {
                $error = 'Error al guardar el vuelo: ' . $e->getMessage();
                require __DIR__ . '/../Views/vuelo/crear.php';
            }

            return;
        }

        require __DIR__ . '/../Views/vuelo/crear.php';
    }


    public function editar()
    {
        // numero_vuelo es un código (ej. "AV306"), no un entero: se toma como texto
        $numero_vuelo = trim($_GET['numero_vuelo'] ?? '');

        if ($numero_vuelo === '' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_vuelo = trim($_POST['numero_vuelo_original'] ?? '');
        }

        if ($numero_vuelo === '') {
            header('Location: Index.php?action=listar_vuelos&error=1');
            exit;
        }

        $vuelo = $this->model->buscarPorId($numero_vuelo);

        if (!$vuelo) {
            header('Location: Index.php?action=listar_vuelos&error=1');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // numero_vuelo_original identifica la fila a actualizar (viene del campo oculto)
            $numero_vuelo_original = trim($_POST['numero_vuelo_original'] ?? $numero_vuelo);
            $numero_vuelo_nuevo = trim($_POST['numero_vuelo'] ?? '');
            $aerolinea = trim($_POST['aerolinea'] ?? '');
            $origen = trim($_POST['origen'] ?? '');
            $destino = trim($_POST['destino'] ?? '');
            $fecha_salida = trim($_POST['fecha_salida'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $capacidad_maxima = trim($_POST['capacidad_maxima'] ?? '');

            if ($numero_vuelo_nuevo === '' || $aerolinea === '' || $origen === '' || $destino === ''
                || $fecha_salida === '' || $precio === '' || $capacidad_maxima === '') {
                $error = 'Todos los campos del vuelo son obligatorios.';
                require __DIR__ . '/../Views/vuelo/editar.php';
                return;
            }

            // Regla de negocio: no se puede repetir numero de vuelo con OTRO vuelo
            if ($this->model->existeNumeroVuelo($numero_vuelo_nuevo, $numero_vuelo_original)) {
                $error = 'Ya existe otro vuelo registrado con ese número de vuelo.';
                require __DIR__ . '/../Views/vuelo/editar.php';
                return;
            }

            try {
                $this->model->numero_vuelo = $numero_vuelo_nuevo;
                $this->model->aerolinea = $aerolinea;
                $this->model->origen = $origen;
                $this->model->destino = $destino;
                $this->model->fecha_salida = $fecha_salida;
                $this->model->precio = (float) $precio;
                $this->model->capacidad_maxima = (int) $capacidad_maxima;

                if ($this->model->actualizar($numero_vuelo_original)) {
                    header('Location: Index.php?action=listar_vuelos&ok=1');
                    exit;
                }

                $error = 'No se pudo actualizar el vuelo.';
                require __DIR__ . '/../Views/vuelo/editar.php';

            } catch (PDOException $e) {
                $error = 'Error al actualizar el vuelo: ' . $e->getMessage();
                require __DIR__ . '/../Views/vuelo/editar.php';
            }

            return;
        }

        require __DIR__ . '/../Views/vuelo/editar.php';
    }
}
