<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conditions_meteo
 *
 * @author sam
 */
class conditions_meteo
  {
  private $date;
  private $heure;
  private $temperature;
  private $conditionCiel;
  private $ventVitesse;
  private $ventDirection;

  // ------------------------
   function getDate() {
    return $this->date;
  }
   function getHeure() {
    return $this->heure;
  }
   function getTemperature() {
    return $this->temperature;
  }
   function getConditionCiel() {
    return $this->conditionCiel;
  }
   function getVentVitesse() {
    return $this->ventVitesse;
  }
   function getVentDirection() {
    return $this->ventDirection;
  }
  // ------------------------
   function setDate($date) {
    $this->date = $date;
  }
   function setHeure($heure) {
    $this->heure = $heure;
  }
   function setTemperature($temperature) {
    $this->temperature = $temperature;
  }
   function setConditionCiel($conditionCiel) {
    $this->conditionCiel = $conditionCiel;
  }
   function setVentVitesse($ventVitesse) {
    $this->ventVitesse = $ventVitesse;
  }
   function setVentDirection($ventDirection) {
    $this->ventDirection = $ventDirection;
  }

  // ========================================
  }
