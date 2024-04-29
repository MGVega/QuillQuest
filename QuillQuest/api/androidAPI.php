<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include_once dirname(__FILE__) . '/../config/includes.php';

$model = new rutasModel();
$join = " LEFT JOIN wi_rutas_latlon USING (ruta_id)"
        . " LEFT JOIN wi_rutas_points USING (ruta_id)";

$select = "wi_rutas.*, wi_rutas_latlon.id as latlon_id, wi_rutas_latlon.lat as latlon_lat, wi_rutas_latlon.lon as latlon_lon,"
        . "wi_rutas_points.id as points_id, wi_rutas_points.lat as points_lat, wi_rutas_points.lon as points_lon, wi_rutas_points.title as points_title";
$result_model = $model->select("", "", $select, $join);


$new_rutas = array();

foreach ($result_model as $ruta){
    
    $latlon_id = $ruta->latlon_id;
    $points_id = $ruta->points_id;
    $ruta_id = $ruta->ruta_id;

    if(empty($new_rutas[$ruta_id])){
        
        $new_rutas[$ruta_id] = new stdClass();
        $new_rutas[$ruta_id]->ruta_id = $ruta_id;
        $new_rutas[$ruta_id]->titulo = $ruta->titulo;
        $new_rutas[$ruta_id]->descripcion = $ruta->descripcion;
        $new_rutas[$ruta_id]->imagen = $ruta->imagen;
        $new_rutas[$ruta_id]->link_descarga = $ruta->link_descarga;
        $new_rutas[$ruta_id]->dificultad = $ruta->dificultad;
        $new_rutas[$ruta_id]->km = $ruta->km;
        $new_rutas[$ruta_id]->tipo_ruta = $ruta->tipo_ruta;
        $new_rutas[$ruta_id]->descargas = $ruta->descargas;
        $new_rutas[$ruta_id]->visualizaciones = $ruta->visualizaciones;
        $new_rutas[$ruta_id]->center_lat = $ruta->center_lat;
        $new_rutas[$ruta_id]->center_lon = $ruta->center_lon;
        $new_rutas[$ruta_id]->latlon = array();
        $new_rutas[$ruta_id]->points = array();
        
    }
    
    if(empty($new_rutas[$ruta_id]->latlon[$latlon_id]) && !empty($latlon_id)){
        
        $new_rutas[$ruta_id]->latlon[$latlon_id] = new stdClass();
        $new_rutas[$ruta_id]->latlon[$latlon_id]->id = $latlon_id;
        $new_rutas[$ruta_id]->latlon[$latlon_id]->ruta_id = $ruta->ruta_id;
        $new_rutas[$ruta_id]->latlon[$latlon_id]->lat = $ruta->latlon_lat;
        $new_rutas[$ruta_id]->latlon[$latlon_id]->lon = $ruta->latlon_lon;
        
    }
    
    if(empty($new_rutas[$ruta_id]->points[$points_id]) && !empty($points_id)){
        
        $new_rutas[$ruta_id]->points[$points_id] = new stdClass();
        $new_rutas[$ruta_id]->points[$points_id]->id = $points_id;
        $new_rutas[$ruta_id]->points[$points_id]->ruta_id = $ruta->ruta_id;
        $new_rutas[$ruta_id]->points[$points_id]->lat = $ruta->points_lat;
        $new_rutas[$ruta_id]->points[$points_id]->lon = $ruta->points_lon;
        $new_rutas[$ruta_id]->points[$points_id]->title = $ruta->points_title;
        
    }

    
}

foreach ($new_rutas as $key => $value) {
    
    $new_rutas[$key]->points = array_values($value->points);
    $new_rutas[$key]->latlon = array_values($value->latlon);
    
}

echo json_encode(array_values($new_rutas));
?>