<?php

class Empleado {
    protected string $nombre;
    protected int $idEmpleado;
    protected float $salarioBase;

    public function __construct(string $nombre, int $idEmpleado, float $salarioBase) {
        $this->nombre = $nombre;
        $this->idEmpleado = $idEmpleado;
        $this->salarioBase = $salarioBase;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getIdEmpleado(): int {
        return $this->idEmpleado;
    }

    public function getSalarioBase(): float {
        return $this->salarioBase;
    }

    // Setters
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setIdEmpleado(int $idEmpleado): void {
        $this->idEmpleado = $idEmpleado;
    }

    public function setSalarioBase(float $salarioBase): void {
        $this->salarioBase = $salarioBase;
    }
}
