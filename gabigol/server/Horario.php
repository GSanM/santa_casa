<?php

class Horario {
    public $dia_sem;
    public $lista_horas = array();

    public function __constructor($dia_sem) {
        $this->dia_sem = $dia_sem;
    }

    public function addHora($nova_hora) {
        $this->lista_horas[] = $nova_hora;
    }
}

?>