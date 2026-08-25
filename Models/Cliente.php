<?php

class Cliente
{
    private PDO $pdo;
    public string $documento = '';
    public string $nombre = '';
    public string $correo = '';
    public string $telefono = '';


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $sql = "SELECT documento, nombre, correo, telefono
                FROM clientes
                ORDER BY nombre";

        return $this->pdo->query($sql)->fetchAll();
    }


    public function buscarPorId(int $documento)
    {
        $sql = "SELECT documento, nombre, correo, telefono
                FROM clientes
                WHERE documento = :documento";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':documento' => $documento]);

        $resultado = $stmt->fetch();

        return $resultado !== false ? $resultado : null;
    }


    public function existeDocumento(string $documento)
    {
        $sql = "SELECT documento FROM clientes WHERE documento = :documento";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':documento' => $documento]);

        return $stmt->fetch() !== false;
    }


    public function guardar()
    {
        $sql = "INSERT INTO clientes (documento, nombre, correo, telefono)
                VALUES (:documento, :nombre, :correo, :telefono)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':documento' => $this->documento,
            ':nombre' => $this->nombre,
            ':correo' => $this->correo,
            ':telefono' => $this->telefono,
        ]);
    }
}
