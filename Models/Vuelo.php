<?php

class Vuelo
{
    private PDO $pdo;

    public string $numero_vuelo = '';
    public string $aerolinea = '';
    public string $origen = '';
    public string $destino = '';
    public string $fecha_salida = '';
    public float $precio = 0;
    public int $capacidad_maxima = 0;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $sql = "SELECT numero_vuelo, aerolinea, origen, destino,
                       fecha_salida, precio, capacidad_maxima
                FROM vuelos
                ORDER BY fecha_salida";

        return $this->pdo->query($sql)->fetchAll();
    }


    public function buscarPorId(string $numero_vuelo)
    {
        $sql = "SELECT numero_vuelo, aerolinea, origen, destino,
                       fecha_salida, precio, capacidad_maxima
                FROM vuelos
                WHERE numero_vuelo = :numero_vuelo";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':numero_vuelo' => $numero_vuelo]);

        $resultado = $stmt->fetch();

        return $resultado !== false ? $resultado : null;
    }


    public function existeNumeroVuelo(string $numero_vuelo, ?string $ignorar_id = null): bool
    {
        $sql = "SELECT numero_vuelo FROM vuelos WHERE numero_vuelo = :numero_vuelo";

        if ($ignorar_id !== null) {
            $sql .= " AND numero_vuelo <> :ignorar_id";
        }

        $stmt = $this->pdo->prepare($sql);
        $parametros = [':numero_vuelo' => $numero_vuelo];

        if ($ignorar_id !== null) {
            $parametros[':ignorar_id'] = $ignorar_id;
        }

        $stmt->execute($parametros);

        return $stmt->fetch() !== false;
    }


    public function guardar()
    {
        $sql = "INSERT INTO vuelos (numero_vuelo, aerolinea, origen, destino, fecha_salida, precio, capacidad_maxima)
                VALUES (:numero_vuelo, :aerolinea, :origen, :destino, :fecha_salida, :precio, :capacidad_maxima)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':numero_vuelo' => $this->numero_vuelo,
            ':aerolinea' => $this->aerolinea,
            ':origen' => $this->origen,
            ':destino' => $this->destino,
            ':fecha_salida' => $this->fecha_salida,
            ':precio' => $this->precio,
            ':capacidad_maxima' => $this->capacidad_maxima,
        ]);
    }


    public function actualizar(string $numero_vuelo_original)
    {
        $sql = "UPDATE vuelos
                SET numero_vuelo = :numero_vuelo,
                    aerolinea = :aerolinea,
                    origen = :origen,
                    destino = :destino,
                    fecha_salida = :fecha_salida,
                    precio = :precio,
                    capacidad_maxima = :capacidad_maxima
                WHERE numero_vuelo = :numero_vuelo_original";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':numero_vuelo' => $this->numero_vuelo,
            ':aerolinea' => $this->aerolinea,
            ':origen' => $this->origen,
            ':destino' => $this->destino,
            ':fecha_salida' => $this->fecha_salida,
            ':precio' => $this->precio,
            ':capacidad_maxima' => $this->capacidad_maxima,
            ':numero_vuelo_original' => $numero_vuelo_original,
        ]);
    }
}
