<?php

/**
 * Description of preguntaRepository
 *
 * @author Sandra
 */
class encuestaRepository {
    
    private $encuestas = null;
    private $respuestas = null;
    
    
    public function __construct(){
        
        $this->encuestas = new encuestasModel();
        $this->respuestas = new encuestasRespuestasModel();
        
    }

    /**
     * Obtenemos todas las encuestas
     * @param Int $visible
     * @return type
     */
    public function getEncuestas() {

        $result_encuestas = $this->encuestas->select('encuesta_id>0 ORDER BY encuesta_id DESC');
        
        foreach ($result_encuestas as $key => $enc){
            
            $where = "encuesta_id=$enc->encuesta_id AND (texto_libre IS NOT NULL OR si_no!=0 OR opciones IS NOT NULL OR opciones_multiple IS NOT NULL "
                . "OR opciones_select IS NOT NULL OR numero_libre IS NOT NULL OR otros IS NOT NULL)";
            $total = $this->respuestas->select($where,'','count(pregunta_id) as total_respuestas');
            $result_encuestas[$key]->total_respuestas = $total[0]->total_respuestas;
            
        }
        
        return $result_encuestas;
        
        
    }
    
    public function getRespuestasEncuesta(Int $id){
        
        $where = "wi_encuestas_respuestas.encuesta_id=$id";
        $join = " LEFT JOIN wi_encuestas_respuestas_multiple "
                . "ON (wi_encuestas_respuestas.encuesta_id=wi_encuestas_respuestas_multiple.encuesta_id "
                . "AND wi_encuestas_respuestas.pregunta_id=wi_encuestas_respuestas_multiple.pregunta_id)"
                . " LEFT JOIN wi_encuestas_respuestas_select "
                . "ON (wi_encuestas_respuestas.encuesta_id=wi_encuestas_respuestas_select.encuesta_id "
                . "AND wi_encuestas_respuestas.pregunta_id=wi_encuestas_respuestas_select.pregunta_id)"
                . " INNER JOIN wi_preguntas ON (wi_encuestas_respuestas.pregunta_id=wi_preguntas.pregunta_id)"
                . " LEFT JOIN wi_preguntas_opciones ON (wi_encuestas_respuestas.opciones=wi_preguntas_opciones.opcion_id "
                . "OR wi_encuestas_respuestas_multiple.opcion_id=wi_preguntas_opciones.opcion_id)"
                . " LEFT JOIN wi_select ON(wi_encuestas_respuestas_select.select_id=wi_select.select_id)"
                . " LEFT JOIN wi_countries ON(wi_encuestas_respuestas_select.value_select=wi_countries.country_id)"
                . " LEFT JOIN wi_comunidades ON(wi_encuestas_respuestas_select.value_select=wi_comunidades.comunidad_id)"
                . " LEFT JOIN wi_states ON(wi_encuestas_respuestas_select.value_select=wi_states.state_id)"
                . "LEFT JOIN wi_cities ON(wi_encuestas_respuestas_select.value_select=wi_cities.city_id)";
        $select = "wi_encuestas_respuestas.*, wi_preguntas.titulo, wi_preguntas.pregunta_tipo_id, wi_preguntas.activar_otros, wi_preguntas.num_select, wi_preguntas.visible,"
                . "wi_encuestas_respuestas_multiple.opcion_id, wi_encuestas_respuestas_select.select_id, wi_encuestas_respuestas_select.value_select,"
                . "wi_preguntas_opciones.nombre as nombre_opcion, wi_select.nombre as nombre_select,"
                . "wi_countries.name as nombre_pais, wi_comunidades.name as nombre_comunidad, wi_states.name as nombre_provincia, wi_cities.name as nombre_ciudad";
        $as = "";
        
        $result_respuestas = $this->respuestas->select($where, $as, $select, $join);
        
        return $this->orderRespuestas($result_respuestas);
        
        
    }
    
    
    public function getRespuestasEncuestasPorPregunta (Int $pregunta_id, $order=false){
        
        $where = "wi_encuestas_respuestas.pregunta_id=$pregunta_id";
        $join = " LEFT JOIN wi_encuestas_respuestas_multiple "
                . "ON (wi_encuestas_respuestas.encuesta_id=wi_encuestas_respuestas_multiple.encuesta_id "
                . "AND wi_encuestas_respuestas.pregunta_id=wi_encuestas_respuestas_multiple.pregunta_id)"
                . " LEFT JOIN wi_encuestas_respuestas_select "
                . "ON (wi_encuestas_respuestas.encuesta_id=wi_encuestas_respuestas_select.encuesta_id "
                . "AND wi_encuestas_respuestas.pregunta_id=wi_encuestas_respuestas_select.pregunta_id)"
                . " INNER JOIN wi_preguntas ON (wi_encuestas_respuestas.pregunta_id=wi_preguntas.pregunta_id)"
                . " LEFT JOIN wi_preguntas_opciones ON (wi_encuestas_respuestas.opciones=wi_preguntas_opciones.opcion_id "
                . "OR wi_encuestas_respuestas_multiple.opcion_id=wi_preguntas_opciones.opcion_id)"
                . " LEFT JOIN wi_select ON(wi_encuestas_respuestas_select.select_id=wi_select.select_id)"
                . " LEFT JOIN wi_countries ON(wi_encuestas_respuestas_select.value_select=wi_countries.country_id)"
                . " LEFT JOIN wi_comunidades ON(wi_encuestas_respuestas_select.value_select=wi_comunidades.comunidad_id)"
                . " LEFT JOIN wi_states ON(wi_encuestas_respuestas_select.value_select=wi_states.state_id)"
                . "LEFT JOIN wi_cities ON(wi_encuestas_respuestas_select.value_select=wi_cities.city_id)";
        $select = "wi_encuestas_respuestas.*, wi_preguntas.titulo, wi_preguntas.pregunta_tipo_id, wi_preguntas.activar_otros, wi_preguntas.num_select, wi_preguntas.visible,"
                . "wi_encuestas_respuestas_multiple.opcion_id, wi_encuestas_respuestas_select.select_id, wi_encuestas_respuestas_select.value_select,"
                . "wi_preguntas_opciones.nombre as nombre_opcion, wi_select.nombre as nombre_select,"
                . "wi_countries.name as nombre_pais, wi_comunidades.name as nombre_comunidad, wi_states.name as nombre_provincia, wi_cities.name as nombre_ciudad";
        $as = "";
        
        $result_respuestas = $this->respuestas->select($where, $as, $select, $join);
        if($order){
            return $this->orderRespuestas($result_respuestas);
        }        
        
        return $result_respuestas;
        
    }
    
    public function getEncuestasFechas($date_from, $date_to){
        
        
        
    }

    
    public function getEncuestasTotales(){
        
        return $this->encuestas->select('','','count(encuesta_id) as encuestasTotales');
        
    }
    
    public function getEncuestasDia(){
        
        return $this->encuestas->select('DATE(fecha_encuesta) = CURDATE()','','count(encuesta_id) as totalesDia');
        
    }
    
    public function getEncuestasBalance($date_from, $date_to){        
        
        $query = "fecha_encuesta between '$date_from' AND '$date_to' group by month(fecha_encuesta),year(fecha_encuesta) order by anio, mes ASC";
        $select = "count(encuesta_id) as total, month(fecha_encuesta) as mes, year(fecha_encuesta) as anio";
        
        return $this->formatEncuestasFechas($this->encuestas->select($query, '', $select));
    }
    
    public function getEncuestasLocalizacion(Int $tipo, Int $limit=10){
        
        $select = "count(wi_encuestas_respuestas.encuesta_id) as total";
        $join = " INNER JOIN wi_encuestas_respuestas_select ON(wi_encuestas_respuestas_select.encuesta_id=wi_encuestas_respuestas.encuesta_id)";
        
        switch ($tipo){
            
            case 1:
                $select.= ', wi_cities.name ';
                $join .= 'INNER JOIN wi_cities ON(wi_encuestas_respuestas_select.value_select=wi_cities.city_id)';
                $group = 'wi_cities.city_id';
                break;
            
            case 2:
                $select.= ', wi_states.name ';
                $join .= 'INNER JOIN wi_states ON(wi_encuestas_respuestas_select.value_select=wi_states.state_id)';
                $group = 'wi_states.state_id';
                break;
            
            case 3:
                $select.= ', wi_comunidades.name ';
                $join .= 'INNER JOIN wi_comunidades ON(wi_encuestas_respuestas_select.value_select=wi_comunidades.comunidad_id)';
                $group = 'wi_comunidades.comunidad_id';
                break;
            
            case 4:
                $select.= ', wi_countries.name ';
                $join .= 'INNER JOIN wi_countries ON(wi_encuestas_respuestas_select.value_select=wi_countries.country_id)';
                $group = 'wi_countries.country_id';
                break;
            
            default:
                $group = '';
                break;
            
        }
        
        $query = "wi_encuestas_respuestas.opciones_select=1 AND wi_encuestas_respuestas_select.select_id=$tipo group by $group order by total DESC limit $limit";
     
        return $this->formatEncuestasBiData($this->respuestas->select($query, '', $select, $join));
        
    }
    
    public function getEncuestasOpciones(Int $pregunta_id){
        
        $query = "wi_encuestas_respuestas.pregunta_id=$pregunta_id group by wi_preguntas_opciones.opcion_id, wi_preguntas_opciones.nombre order by total DESC";
        $select = "count(wi_encuestas_respuestas.encuesta_id) as total, wi_preguntas_opciones.nombre as name";
        $join = "INNER JOIN wi_preguntas_opciones ON(wi_encuestas_respuestas.opciones=wi_preguntas_opciones.opcion_id)";
        
        return $this->formatEncuestasBiData($this->respuestas->select($query, '', $select, $join));
        
    }
    
    public function getEncuestasOpcionesMultiple(Int $pregunta_id){
        
        $query = "wi_encuestas_respuestas.pregunta_id=$pregunta_id AND wi_encuestas_respuestas.opciones_multiple=1 "
                . "group by wi_encuestas_respuestas_multiple.opcion_id, wi_preguntas_opciones.nombre order by total DESC";
        $select = "count(wi_encuestas_respuestas.encuesta_id) as total, wi_preguntas_opciones.nombre as name";
        $join = "INNER JOIN wi_encuestas_respuestas_multiple ON(wi_encuestas_respuestas_multiple.encuesta_id=wi_encuestas_respuestas.encuesta_id "
                . "AND wi_encuestas_respuestas_multiple.pregunta_id=wi_encuestas_respuestas.pregunta_id) "
                . "INNER JOIN wi_preguntas_opciones ON(wi_encuestas_respuestas_multiple.opcion_id=wi_preguntas_opciones.opcion_id)";
        
        return $this->formatEncuestasBiData($this->respuestas->select($query, '', $select, $join));
        
    }
    
    
    public function getEncuestasSiNo(Int $pregunta_id){
        
        $query_si = "wi_encuestas_respuestas.pregunta_id=$pregunta_id and si_no=1";
        $query_no = "wi_encuestas_respuestas.pregunta_id=$pregunta_id and si_no=0";
        $select = "count(si_no) as total";
        
        $si_respuestas = $this->respuestas->select($query_si,'',$select);
        $no_respuestas = $this->respuestas->select($query_no,'',$select);
        
        $newEncuestas = new stdClass();
        $newEncuestas->labels = array('Si','No');        
        $newEncuestas->totales = array($si_respuestas[0]->total,$no_respuestas[0]->total);
        
        return $newEncuestas;
    }
    
    private function formatEncuestasFechas($encuestas){
        
        $labels = array();
        $totales = array();
        foreach ($encuestas as $enc) {
            
            array_push($totales,$enc->total);
            
            switch ($enc->mes) {
                case 1:
                    array_push($labels,'Enero '.$enc->anio);
                    break;
                
                case 2:
                    array_push($labels,'Febrero '.$enc->anio);
                    break;
                
                case 3:
                    array_push($labels,'Marzo '.$enc->anio);
                    break;
                
                case 4:
                    array_push($labels,'Abril '.$enc->anio);
                    break;
                
                case 5:
                    array_push($labels,'Mayo '.$enc->anio);
                    break;
                
                case 6:
                    array_push($labels,'Junio '.$enc->anio);
                    break;
                
                case 7:
                    array_push($labels,'Julio '.$enc->anio);
                    break;
                
                case 8:
                    array_push($labels,'Agosto '.$enc->anio);
                    break;
                
                case 9:
                    array_push($labels,'Septiembre '.$enc->anio);
                    break;
                
                case 10:
                    array_push($labels,'Octubre '.$enc->anio);
                    break;
                
                case 11:
                    array_push($labels,'Noviembre '.$enc->anio);
                    break;
                
                case 12:
                    array_push($labels,'Diciembre '.$enc->anio);
                    break;

                default:
                    break;
            }
            
        }
        
        $newEncuestas = new stdClass();
        $newEncuestas->labels = $labels;
        $newEncuestas->totales = $totales;
        
        return $newEncuestas;
        
    }
    
    private function formatEncuestasBiData($encuestas){
        
        $labels = array();
        $totales = array();
        
        foreach ($encuestas as $enc) {
            
            array_push($totales,$enc->total);
            array_push($labels,$enc->name);
            
        }
        
        $newEncuestas = new stdClass();
        $newEncuestas->labels = $labels;
        $newEncuestas->totales = $totales;
        
        return $newEncuestas;
    }
    
    /**
     * Ordenación del array de preguntas
     * @param type $preguntas
     * @return array
     */
    private function orderRespuestas($respuestas): Array{
        
        $preguntasNew = array();
        
        foreach ($respuestas as $value) {
            
            $pregunta_id = $value->pregunta_id;
            $select_id = $value->select_id;
            $option_id = $value->opcion_id;
            
            
            if(empty($preguntasNew[$pregunta_id])){
                
                $preguntasNew[$pregunta_id] = new stdClass();
                
                $preguntasNew[$pregunta_id]->pregunta_id = $pregunta_id;
                $preguntasNew[$pregunta_id]->texto_libre = $value->texto_libre;
                $preguntasNew[$pregunta_id]->si_no = $value->si_no;
                $preguntasNew[$pregunta_id]->opciones = $value->opciones;
                $preguntasNew[$pregunta_id]->opciones_multiple = $value->opciones_multiple;
                $preguntasNew[$pregunta_id]->opciones_select = $value->opciones_select;
                $preguntasNew[$pregunta_id]->numero_libre = $value->numero_libre;
                $preguntasNew[$pregunta_id]->otros = $value->otros;
                $preguntasNew[$pregunta_id]->value_opcion = $value->nombre_opcion;
                
                $preguntasNew[$pregunta_id]->titulo = $value->titulo;
                $preguntasNew[$pregunta_id]->pregunta_tipo_id = $value->pregunta_tipo_id;
                $preguntasNew[$pregunta_id]->activar_otros = $value->activar_otros;
                $preguntasNew[$pregunta_id]->num_select = $value->num_select;
                $preguntasNew[$pregunta_id]->visible = $value->visible;
                $preguntasNew[$pregunta_id]->selects = array();
                $preguntasNew[$pregunta_id]->options = array();
                
            }
            
            if($value->opciones_select==1){
                
                if(empty($preguntasNew[$pregunta_id]->selects[$select_id])){
                    
                    $preguntasNew[$pregunta_id]->selects[$select_id] = new stdClass();
                    $preguntasNew[$pregunta_id]->selects[$select_id]->select_id = $select_id;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->value_select = $value->value_select; 
                    $preguntasNew[$pregunta_id]->selects[$select_id]->nombre_select = $value->nombre_select;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->nombre_pais = $value->nombre_pais;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->nombre_comunidad = $value->nombre_comunidad;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->nombre_provincia = $value->nombre_provincia;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->nombre_ciudad = $value->nombre_ciudad;
                    
                }                
                
            }
            
            if($value->opciones_multiple==1 && !empty($option_id)){
                
                if(empty($preguntasNew[$pregunta_id]->options[$option_id])){
                    
                    $preguntasNew[$pregunta_id]->options[$option_id] = new stdClass();
                    $preguntasNew[$pregunta_id]->options[$option_id]->opcion_id = $option_id;
                    $preguntasNew[$pregunta_id]->options[$option_id]->value_opcion = $value->nombre_opcion;
                    
                }                
                
            }
            
            
        }
        
        return $preguntasNew;
        
    }

}
