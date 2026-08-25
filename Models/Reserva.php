<?php

class Reserva
{
    private PDO $pdo;

    public ?int $id_reserva = null;
    public ?int $documento = null;
    public ?string $numero_vuelo = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function listar()
    {
        $sql = "SELECT r.id_reserva, r.fecha_reserva,
                       c.nombre, c.documento,
                       v.numero_vuelo, v.aerolinea, v.origen, v.destino, v.fecha_salida, v.precio
                FROM reservas r
                JOIN clientes c ON c.documento = r.documento
                JOIN vuelos v ON v.numero_vuelo = r.numero_vuelo
                ORDER BY r.id_reserva DESC";

        return $this->pdo->query($sql)->fetchAll();
    }

    public function guardar()
    {
        $sql = "INSERT INTO reservas (documento, numero_vuelo)
                VALUES (:documento, :numero_vuelo)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':documento' => $this->documento,
            ':numero_vuelo' => $this->numero_vuelo,
        ]);
    }
}
