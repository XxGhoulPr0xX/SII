<?php

class Validar
{
    private $ID;
    private $nombre;
    private $apellido;
    private $edad;
    private $direccion;

    function __construct()
    {
        $ID = "";
        $nombre = "";
        $apellido = "";
        $edad = "";
        $telefono = "";
    }

    public function getMatricula()
    {
        return $this->ID;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return  $this->apellido;
    }
    public function getEdad()
    {
        return $this->edad;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }

    public function validarMatricula($sk){
        $this->ID = $this->test_input($sk);
    }

    public function ValidarDatos($sk, $direccion)
    {
        $this->ID = $this->test_input($sk);
        $this->direccion = $this->test_input($direccion);
    }
    public function validarPost($n, $apellido, $edad, $direccion)
    {
        $this->nombre = $this->test_input($n);
        $this->apellido = $this->test_input($apellido);
        $this->edad = $this->test_input($edad);
        $this->direccion = $this->test_input($direccion);
    }

    public function test_input($data)
    {
        $data = trim($data); // remove unnecessary characters (tab, new line, etc)
        $data = stripslashes($data); // remove backslashes (\)
        $data = htmlspecialchars($data);
        return $data;
    }
} //fin de clase Validar
