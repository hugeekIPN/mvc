<?php
require_once("config/database.php");

class m_apoyo_gasto{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /*
    * Funcion para poblar el dataTable de apoyos.
    * Se obtiene mediante ajax 
    * @param tipo es el tipo del apoyo. 0-apoyo 1-gasto
    
    * @return arrray indexado con los datos necesarios para el dataTable
    **/
    public function getApoyosForTable($tipo=0){
        $result = [];
        $query = $this->db->select(
                "SELECT 
                 a.id_apoyo
                 ,textoCorto(a.concepto) as concepto
                 ,a.referencia
                 ,e.nombre
                 ,textoCorto(p.razon_social) as razon_social
                 ,date(a.fecha_creacion)
                 ,estatus(a.estatus)
                 FROM apoyosgastos as a
                 INNER JOIN proveedores as p ON a.id_proveedor = p.id_proveedor   
                 INNER JOIN eventos as e ON a.id_evento = e.id_evento
                 WHERE a.tipo = :tipo "
                 ,["tipo"=>$tipo]
                 ,PDO::FETCH_NUM);
            if($query)
                $result = $query;
        return $result;
    }

    /**
    * Obtiene un apoyo por su id
    * @param id_apoyo - El id del usuario
    * @return Los datos del usuario en caso de éxito, array vacio en caso contrario
    **/
    public function getApoyoById($id_apoyo=null, $tipo=0) 
    {
        $result= [];

        $query = "SELECT 
        a.id_apoyo
        ,a.tipo
        ,a.estatus
        ,a.concepto
        ,a.importe
        ,importe(a.importe,a.tipo_cambio) as importe_real
        ,a.tipo_cambio        
        ,a.observaciones
        ,a.referencia
        ,a.mes_contable
        ,a.docto_salida
        ,a.poliza
        ,date(a.fecha_referencia) as fecha_referencia
        ,date(a.fecha_docto_salida) as fecha_docto_salida
        ,date(a.fecha_creacion) as fecha_creacion
        ,a.ultima_modificacion
        ,p.id_proveedor
        ,p.tipo as tipo_proveedor
        ,p.razon_social
        ,e.nombre as evento
        ,e.id_evento
        ,a.id_especie_apoyo
        ,f.id_frecuencia_apoyo 
        ,f.nombre as frecuencia
        ,a.id_estado
        ,st.nombre
        ,a.id_moneda
        ,m.acronimo
        ,m.nombre
        FROM apoyosgastos as a
        INNER JOIN proveedores as p ON a.id_proveedor = p.id_proveedor   
        INNER JOIN eventos as e ON a.id_evento = e.id_evento        
        INNER JOIN frecuencia_apoyo AS f ON f.id_frecuencia_apoyo = a.id_frecuencia_apoyo
        INNER JOIN estado AS st ON st.id_estado = a.id_estado
        INNER JOIN moneda AS m ON m.id_moneda = a.id_moneda
        WHERE a.id_apoyo = :id AND p.tipo = :tipo ";

        $data = $this->db->select($query,["id"=>$id_apoyo,"tipo"=>$tipo]);

        if($data)
            $result = $data[0];

        return $result;
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
            'importe_ext'         => $data['importe_ext'],
            'moneda'         => $data['moneda'], 
            //'tipo_cambio'         => $data['tipo_cambio'], 
            
            'folio'         => $data['folio'],
            'frecuencia'         => $data['frecuencia'],
            'id_especie'         => $data['id_especie'],
            'id_evento'         => $data['id_evento'],
            'id_proveedor'         => $data['id_proveedor'],
            'tipo_apoyo'         => $data['tipo_apoyo'], 
            'pais'         => $data['pais'], 
            'entidad'         => $data['entidad'], 
            'observaciones'         => $data['observaciones'],
            'referencia'         => $data['referencia'], 
            'unidad'         => $data['unidad'],
            'cantidad'      => $data['cantidad'],
            'mes_contable'         => $data['mes_contabel_libretaflujo'],
            'fecha_referencia'     => $data['fecha_recibo'],
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
