<?php

/**
 * Description of preguntaRepository
 *
 * @author Sandra
 */
class preguntaRepository {
    
    private $preguntas = null;
    
    public function __construct(){
        
        $this->preguntas = new preguntasModel();
        
    }

    /**
     * Obtenemos preguntas
     * @param Int $visible
     * @return type
     */
    public function getPreguntas(Int $visible) {

        $as = "";
        
        if(!empty($visible)){
            $where = "wi_preguntas.visible=$visible ORDER BY wi_preguntas.pregunta_id ASC, wi_preguntas_select.select_id DESC";
        }else{
            $where = "ORDER BY wi_preguntas.pregunta_id ASC, wi_preguntas_select.select_id DESC";
        }        
        
        $select = "wi_preguntas.*,"
                . "wi_preguntas_opciones.opcion_id, wi_preguntas_opciones.nombre as option_name, wi_preguntas_opciones.orden,"
                . "wi_preguntas_select.select_id,"
                . "wi_select.nombre as select_name";
        $join = " LEFT JOIN wi_preguntas_opciones USING(pregunta_id)"
                . " LEFT JOIN wi_preguntas_select USING(pregunta_id)"
                . " LEFT JOIN wi_select USING(select_id)";
        $result_Preguntas = $this->preguntas->select($where, $as, $select, $join);

        return $this->orderPreguntas($result_Preguntas);
        
        
    }
    
    public function getPreguntasSimple(Int $visible) {
        
        $where = "wi_preguntas.visible=$visible ORDER BY wi_preguntas.pregunta_id ASC";       

        $result_Preguntas = $this->preguntas->select($where);

        return $result_Preguntas;
        
        
    }
    
    public function getUnaPregunta(Int $pregunta_id) {
        
        $where = "wi_preguntas.pregunta_id=$pregunta_id";       

        $result_Preguntas = $this->preguntas->select($where);

        return $result_Preguntas[0];
        
        
    }
    
    public function getPreguntaPorTipo(Int $tipo){
        
        
        $where = "wi_preguntas.pregunta_tipo_id=$tipo and visible=1";       

        $result_Preguntas = $this->preguntas->select($where);

        return $result_Preguntas;
    }
    
    public function getPreguntaView(Int $id){
       
        $as = "";
        
        $where = "wi_preguntas.pregunta_id=$id ORDER BY wi_preguntas_select.select_id DESC,wi_preguntas_opciones.opcion_id ASC";       
        
        $select = "wi_preguntas.*,"
                . "wi_preguntas_opciones.opcion_id, wi_preguntas_opciones.nombre as option_name, wi_preguntas_opciones.orden,"
                . "wi_preguntas_select.select_id,"
                . "wi_select.nombre as select_name";
        $join = " LEFT JOIN wi_preguntas_opciones USING(pregunta_id)"
                . " LEFT JOIN wi_preguntas_select USING(pregunta_id)"
                . " LEFT JOIN wi_select USING(select_id)";
        $result_Preguntas = $this->preguntas->select($where, $as, $select, $join);

        return $this->orderPreguntas($result_Preguntas);
        
    }
    
    /**
     * Ordenación del array de preguntas
     * @param type $preguntas
     * @return array
     */
    private function orderPreguntas($preguntas): Array{
        
        $preguntasNew = array();
        
        foreach ($preguntas as $value) {
            
            $pregunta_id = $value->pregunta_id;
            $select_id = $value->select_id;
            $option_id = $value->opcion_id;
            
            
            if(empty($preguntasNew[$pregunta_id])){
                
                $preguntasNew[$pregunta_id] = new stdClass();
                
                $preguntasNew[$pregunta_id]->pregunta_id = $pregunta_id;
                $preguntasNew[$pregunta_id]->titulo = $value->titulo;
                $preguntasNew[$pregunta_id]->pregunta_tipo_id = $value->pregunta_tipo_id;
                $preguntasNew[$pregunta_id]->activar_otros = $value->activar_otros;
                $preguntasNew[$pregunta_id]->num_select = $value->num_select;
                $preguntasNew[$pregunta_id]->visible = $value->visible;
                $preguntasNew[$pregunta_id]->selects = array();
                $preguntasNew[$pregunta_id]->options = array();
                
            }
            
            if(!empty($select_id)){
                
                if(empty($preguntasNew[$pregunta_id]->selects[$select_id])){
                    
                    $preguntasNew[$pregunta_id]->selects[$select_id] = new stdClass();
                    $preguntasNew[$pregunta_id]->selects[$select_id]->select_id = $select_id;
                    $preguntasNew[$pregunta_id]->selects[$select_id]->select_name = $value->select_name;                    
                    
                }                
                
            }
            
            if(!empty($option_id)){
                
                if(empty($preguntasNew[$pregunta_id]->options[$option_id])){
                    
                    $preguntasNew[$pregunta_id]->options[$option_id] = new stdClass();
                    $preguntasNew[$pregunta_id]->options[$option_id]->opcion_id = $option_id;
                    $preguntasNew[$pregunta_id]->options[$option_id]->option_name = $value->option_name;
                    $preguntasNew[$pregunta_id]->options[$option_id]->orden = $value->orden;
                    
                }                
                
            }
            
            
        }
        
        return $preguntasNew;
        
    }

}
