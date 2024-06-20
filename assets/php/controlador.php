<?php

class Controlador
{
    private $validador;
    private $conexion;

    public function __construct()
    {
        require_once("validar.php");
        require_once("sql.php");
        $this->validador = new Validar();
        $this->conexion = new Conexion();
    }

    public function procesarFormulario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["nombre"], $_POST["apellido"], $_POST["edad"], $_POST["direccion"])) {
                $this->procesarInsercion();
            } elseif (isset($_POST["Buscar"])) {
                $this->procesarBusqueda();
            } elseif (isset($_POST["Eliminar"])) {
                $this->procesarEliminacion();
            } elseif (isset($_POST["Matricula"], $_POST["Domicilio"])) {
                $this->procesarActualizacion();
            }
        }
    }

    private function procesarInsercion()
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];
        $direccion = $_POST["direccion"];

        $this->validador->ValidarDatos($nombre, $apellido, $edad, $direccion);

        if (!empty($nombre) && !empty($apellido) && !empty($edad) && !empty($direccion)) {
            $this->validador->validarPost($nombre, $apellido, $edad, $direccion);
            $this->conexion->Conexion();
            $this->conexion->create($this->validador->getNombre(), $this->validador->getApellido(), $this->validador->getEdad(), $this->validador->getDireccion());
            echo "Se ha dado de alta el aspirante con la matricula";
        } else {
            echo "Por favor, completa todos los campos.";
        }
    }

    private function procesarBusqueda()
    {
        $this->validador->validarMatricula($_POST["Buscar"]);
        $matricula = $this->validador->getMatricula();
        if (!empty($matricula)) {
            $this->conexion->Conexion();
            $result = $this->conexion->read($matricula);
            if ($result) {
                echo "Matrícula: " . $result['Id'];
                echo "<br>";
                echo "Nombre: " . $result['nombre'];
                echo "<br>";
                echo "Apellido: " . $result['apellido'];
                echo "<br>";
                echo "Edad: " . $result['edad'];
                echo "<br>";
                echo "Dirección: " . $result['direccion'];
                echo "<br>";
            } else {
                echo "No se encontraron resultados.";
            }
        } else {
            echo "La matrícula está vacía.";
        }
    }

    private function procesarEliminacion()
    {
        $this->validador->validarMatricula($_POST["Eliminar"]);
        $eliminar = $this->validador->getMatricula();
        if (!empty($eliminar)) {
            $this->conexion->Conexion();
            $this->conexion->delete($this->validador->getMatricula());
            }
        else {
            echo "Favor de llenar todos los parámetros";
        }
    }

    private function procesarActualizacion()
    {
        $this->validador->ValidarDatos($_POST["Matricula"], $_POST["Domicilio"]);
        if (!empty($_POST["Matricula"]) && !empty($_POST["Domicilio"])) {
            $this->conexion->Conexion();
            $this->conexion->update($this->validador->getDireccion(), $this->validador->getMatricula());
            echo "se ha actualizado";
        } else {
            echo "No se pudo encontrar";
        }
    }
}

$controlador = new Controlador();
$controlador->procesarFormulario();
