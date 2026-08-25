<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Nuevo vuelo</h1>
</div>

<?php if (!empty($error)): ?>
    <p class="alerta alerta-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="Index.php?action=crear_vuelo" class="formulario">

    <label for="numero_vuelo">Número de vuelo</label>
    <input type="text" id="numero_vuelo" name="numero_vuelo"
           value="<?= htmlspecialchars($_POST['numero_vuelo'] ?? '') ?>" required>

    <label for="aerolinea">Aerolínea</label>
    <input type="text" id="aerolinea" name="aerolinea"
           value="<?= htmlspecialchars($_POST['aerolinea'] ?? '') ?>" required>

    <label for="origen">Origen</label>
    <input type="text" id="origen" name="origen"
           value="<?= htmlspecialchars($_POST['origen'] ?? '') ?>" required>

    <label for="destino">Destino</label>
    <input type="text" id="destino" name="destino"
           value="<?= htmlspecialchars($_POST['destino'] ?? '') ?>" required>

    <label for="fecha_salida">Fecha y hora de salida</label>
    <input type="datetime-local" id="fecha_salida" name="fecha_salida"
           value="<?= htmlspecialchars($_POST['fecha_salida'] ?? '') ?>" required>

    <label for="precio">Precio del tiquete</label>
    <input type="number" step="0.01" min="0" id="precio" name="precio"
           value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>" required>

    <label for="capacidad_maxima">Capacidad máxima de pasajeros</label>
    <input type="number" min="1" id="capacidad_maxima" name="capacidad_maxima"
           value="<?= htmlspecialchars($_POST['capacidad_maxima'] ?? '') ?>" required>

    <div class="acciones-formulario">
        <button type="submit" class="btn btn-primario">Guardar vuelo</button>
        <a href="Index.php?action=listar_vuelos" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../footer.php'; ?>
