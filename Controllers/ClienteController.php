<?php

class ClienteController
{
    private Cliente $model;

    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $clientes = $this->model->listar();
        require __DIR__ . '/../Views/cliente/index.php';
    }


    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $documento = trim($_POST['documento'] ?? '');
            $nombre = trim($_POST['nombre'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');

            if ($documento === '' || $nombre === '' || $correo === '' || $telefono === '' ) {
                $error = 'Todos los campos son obligatorios.';
                require __DIR__ . '/../Views/cliente/crear.php';
                return;
            }

            if ($this->model->existeDocumento($documento)) {
                $error = 'Ya existe un cliente registrado con ese número de documento.';
                require __DIR__ . '/../Views/cliente/crear.php';
                return;
            }

            try {
                $this->model->documento = $documento;
                $this->model->nombre = $nombre;
                $this->model->correo = $correo;
                $this->model->telefono = $telefono;
                

                if ($this->model->guardar()) {
                    header('Location: Index.php?action=listar_clientes&ok=1');
                    exit;
                }

                $error = 'No se pudo guardar el cliente.';
                require __DIR__ . '/../Views/cliente/crear.php';

            } catch (PDOException $e) {
                $error = 'Error al guardar el cliente: ' . $e->getMessage();
                require __DIR__ . '/../Views/cliente/crear.php';
            }

            return;
        }

        require __DIR__ . '/../Views/cliente/crear.php';
    }
}
