<?php
require_once("config/database.php");

class m_apoyo_gasto{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un apoyo_gasto por id
    * @param id_apoyo - El id del usuario
    * @return Los datos del usuario en caso de éxito, null en caso contrario
    **/
    public function getApoyoGasto($id_apoyo) 
    {
        $result = $this->db->select(
                    "SELECT * FROM apoyosgastos as a 
                    INNER JOIN saldo as s ON a.id_saldo = s.id_saldo 
                    WHERE id_apoyo = :id",  array ("id" => $id_apoyo)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }


    /**
    * Guarda un nuevo apoyo_gasto
    * @param Arreglo con los datos del apoyo_gasto
    * @return true si logra guardar los datos
    **/
    public function nuevoApoyoGasto($data)
    {             
        return $this->db->insert('apoyosgastos',  array ( 
            'tipo'         => $data['tipo'], 
            'estatus'      => $data['estatus'],
            'concepto'      => $data['concepto'],
            'importe'         => $data['importe'],
            'moneda'         => $data['moneda'], 
            //'tipo_cambio'         => $data['tipo_cambio'], 
            'id_saldo'         =>  $data['id_saldo'],
            'mes_contable_anamaria'  => $data['mes_contable_anamaria'],
            'mes_captura_anamaria'   => $data['mes_captura_anamaria'],
            'referencia_anamaria'         => $data['referencia_anamaria'],
            'folio'         => $data['folio'],
            'frecuencia'         => $data['frecuencia'],
            'id_especie'         => $data['id_especie'],
            'id_evento'         => $data['id_evento'],
            'id_proveedor'         => $data['id_proveedor'],
            'id_donatario'         => $data['id_donatario'], 
            'tipo_apoyo'         => $data['tipo_apoyo'], 
            'pais'         => $data['pais'], 
            'entidad'         => $data['entidad'], 
            'observaciones'         => $data['observaciones'], 
            'factura'         => $data['factura'], 
            'referencia'         => $data['referencia'], 
            'fecha_recibo'     => $data['fecha_recibo'], 
            'unidad'         => $data['unidad'],
            'cantidad'      => $data['cantidad'],
             'mes_contabel_libretaflujo'         => $data['mes_contabel_libretaflujo'], 
            'fecha_docto_salida'         => $data['fecha_docto_salida'], 
            'docto_salida'         => $data['docto_salida'], 
            'poliza'         => $data['poliza']

        ));
        
          
    }

    /**
    * Actualiza los datos de un apoyo_gasto
    * @param Arreglo con los datos a actualizar
    * @param userId - El id del apoyo_gasto 
    * @return true si logra actualizar
    **/
    public function updateApoyoGasto($updateData, $id_apoyo)
    {    
       return $this->db->update("apoyosgastos", 
                    $updateData, 
                    "id_apoyo = :id",
                    array( "id" => $id_apoyo )
               );

    }

    /**
    * Elimina a un apoyo_gasto
    * @param userId - el id del apoyo_gasto a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteApoyoGasto($id_apoyo)  /// update Estado = eliminado
    {    
        $this->db->delete("apoyosgastos", "id_apoyo = :id", array( "id" => $id_apoyo ));        
        
        return true;
    }

    /**
    * Obtiene todos los apoyos_gastos de la base de datos
    **/
    public function getAllApoyosGastos(){
        $query = "SELECT * from apoyosgastos as a INNER JOIN  eventos as e ON a.id_evento= e.id_evento WHERE a.tipo=1";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }

    public function getApoyoEventos($evento, $anio) 
    {
        $result = $this->db->select(
                    "SELECT a.id_apoyo, a.concepto, e.nombre, a.factura  FROM apoyosgastos as a INNER JOIN eventos as e ON a.id_evento=e.id_evento WHERE a.id_evento = :id and year(a.fecha_recibo) = :anio",  array ("anio" => $anio, "id" => $evento)
                  );
        if ( count($result) > 0 )
            return $result;
        else
            return null;
    }


    public function getAllApoyosGastos_type($type){
        $query = "SELECT * from apoyosgastos as a INNER JOIN  eventos as e ON a.id_evento= e.id_evento WHERE a.tipo=".$type;
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }

    public function getUltimoApoyo(){
        $query = "SELECT * from apoyosgastos order by id_apoyo desc limit 1";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result[0];
        else
            return 0;
    }
}

?>
