<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Config/database_Jose.php';
require_once __DIR__ . '/Models/Cliente.php';
require_once __DIR__ . '/Models/Vuelo.php';
require_once __DIR__ . '/Models/Reserva.php';

require_once __DIR__ . '/Controllers/ClienteController.php';
require_once __DIR__ . '/Controllers/VueloController.php';
require_once __DIR__ . '/Controllers/ReservaController.php';

$database = new Database();
$pdo = $database->conectar();

$clienteModel = new Cliente($pdo);
$vueloModel = new Vuelo($pdo);
$reservaModel = new Reserva($pdo);

$clienteController = new ClienteController($clienteModel);
$vueloController = new VueloController($vueloModel);
$reservaController = new ReservaController($reservaModel, $clienteModel, $vueloModel);

$action = $_GET['action'] ?? 'inicio';

switch ($action) {

    case 'listar_clientes':
        $clienteController->index();
        break;

    case 'crear_cliente':
        $clienteController->crear();
        break;

    case 'listar_vuelos':
        $vueloController->index();
        break;

    case 'crear_vuelo':
        $vueloController->crear();
        break;

    case 'editar_vuelo':
        $vueloController->editar();
        break;

    case 'listar_reservas':
        $reservaController->index();
        break;

    case 'crear_reserva':
        $reservaController->crear();
        break;

    default:
        require __DIR__ . '/Views/header.php';
        ?>

        <div class="texto-centro">
            <h1>Bienvenido a SkyBooking</h1>
            <p class="texto-tenue">Selecciona qué deseas administrar</p>
        </div>

        <div class="tarjetas-menu">

            <div class="tarjeta">
                <h2>Clientes</h2>
                <p>Registra y consulta los clientes</p>
                <a href="Index.php?action=listar_clientes" class="btn btn-primario">Ver clientes</a>
            </div>

            <div class="tarjeta">
                <h2>Vuelos</h2>
                <p>Registra, consulta y actualiza los vuelos disponibles.</p>
                <a href="Index.php?action=listar_vuelos" class="btn btn-primario">Ver vuelos</a>
            </div>

            <div class="tarjeta">
                <h2>Reservas</h2>
                <p>Crea y consulta las reservas de tiquetes.</p>
                <a href="Index.php?action=listar_reservas" class="btn btn-primario">Ver reservas</a>
            </div>

        </div>

        <?php
        require __DIR__ . '/Views/footer.php';
        break;
}
