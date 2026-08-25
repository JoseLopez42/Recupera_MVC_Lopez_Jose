<?php

class ReservaController
{
    private Reserva $model;
    private Cliente $clienteModel;
    private Vuelo $vueloModel;

    public function __construct(Reserva $model, Cliente $clienteModel, Vuelo $vueloModel)
    {
        $this->model = $model;
        $this->clienteModel = $clienteModel;
        $this->vueloModel = $vueloModel;
    }

    public function index()
    {
        $reservas = $this->model->listar();

        require __DIR__ . '/../Views/reserva/index.php';
    }


    public function crear()
    {
        $clientes = $this->clienteModel->listar();
        $vuelos = $this->vueloModel->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $documento = filter_input(INPUT_POST, 'documento', FILTER_VALIDATE_INT);
            $numero_vuelo = trim((string) filter_input(INPUT_POST, 'numero_vuelo'));

            if ($documento === false || $documento === null || $numero_vuelo === '') {
                $error = 'Debe seleccionar un cliente y un vuelo válidos.';
                require __DIR__ . '/../Views/reserva/crear.php';
                return;
            }

            try {
                $this->model->documento = (int) $documento;
                $this->model->numero_vuelo = $numero_vuelo;

                if ($this->model->guardar()) {
                    header('Location: Index.php?action=listar_reservas&ok=1');
                    exit;
                }

                $error = 'No se pudo guardar la reserva.';
                require __DIR__ . '/../Views/reserva/crear.php';

            } catch (PDOException $e) {
                $error = 'Error al guardar la reserva: ' . $e->getMessage();
                require __DIR__ . '/../Views/reserva/crear.php';
            }

            return;
        }

        require __DIR__ . '/../Views/reserva/crear.php';
    }
}
