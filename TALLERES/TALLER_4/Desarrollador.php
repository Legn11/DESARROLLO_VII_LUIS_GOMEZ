<?php
require_once "Empleado.php";

class Desarrollador extends Empleado {
    private string $lenguajePrincipal;
    private string $nivelExperiencia;

    public function __construct(string $nombre, int $idEmpleado, float $salarioBase, string $lenguajePrincipal, string $nivelExperiencia) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->lenguajePrincipal = $lenguajePrincipal;
        $this->nivelExperiencia = $nivelExperiencia;
    }

    public function getLenguajePrincipal(): string {
        return $this->lenguajePrincipal;
    }

    public function setLenguajePrincipal(string $lenguajePrincipal): void {
        $this->lenguajePrincipal = $lenguajePrincipal;
    }

    public function getNivelExperiencia(): string {
        return $this->nivelExperiencia;
    }

    public function setNivelExperiencia(string $nivelExperiencia): void {
        $this->nivelExperiencia = $nivelExperiencia;
    }

    public function mostrarPerfil(): string {
        return "Desarrollador {$this->getNombre()} ({$this->nivelExperiencia}) especializado en {$this->lenguajePrincipal}.";
    }
}
