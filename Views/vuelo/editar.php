<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Editar vuelo</h1>
</div>

<?php if (!empty($error)): ?>
    <p class="alerta alerta-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php

$datos = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $vuelo;
?>

<form method="POST" action="Index.php?action=editar_vuelo" class="formulario">

    <input type="hidden" name="numero_vuelo_original" value="<?= htmlspecialchars($vuelo['numero_vuelo']) ?>">

    <label for="numero_vuelo">Número de vuelo</label>
    <input type="text" id="numero_vuelo" name="numero_vuelo"
           value="<?= htmlspecialchars($datos['numero_vuelo'] ?? '') ?>" required>

    <label for="aerolinea">Aerolínea</label>
    <input type="text" id="aerolinea" name="aerolinea"
           value="<?= htmlspecialchars($datos['aerolinea'] ?? '') ?>" required>

    <label for="origen">Origen</label>
    <input type="text" id="origen" name="origen"
           value="<?= htmlspecialchars($datos['origen'] ?? '') ?>" required>

    <label for="destino">Destino</label>
    <input type="text" id="destino" name="destino"
           value="<?= htmlspecialchars($datos['destino'] ?? '') ?>" required>

    <label for="fecha_salida">Fecha y hora de salida</label>
    <input type="datetime-local" id="fecha_salida" name="fecha_salida"
           value="<?= htmlspecialchars(str_replace(' ', 'T', substr($datos['fecha_salida'] ?? '', 0, 16))) ?>" required>

    <label for="precio">Precio del tiquete</label>
    <input type="number" step="0.01" min="0" id="precio" name="precio"
           value="<?= htmlspecialchars($datos['precio'] ?? '') ?>" required>

    <label for="capacidad_maxima">Capacidad máxima de pasajeros</label>
    <input type="number" min="1" id="capacidad_maxima" name="capacidad_maxima"
           value="<?= htmlspecialchars($datos['capacidad_maxima'] ?? '') ?>" required>

    <div class="acciones-formulario">
        <button type="submit" class="btn btn-primario">Actualizar vuelo</button>
        <a href="Index.php?action=listar_vuelos" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../footer.php'; ?>
