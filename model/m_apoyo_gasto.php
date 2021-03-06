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
    public function getApoyosForTable($categoria=0){
        $result = [];
        $query = $this->db->select(
                "SELECT 
                 a.id_apoyo
                 ,textoCorto(a.concepto) as concepto
                 ,a.referencia
                 ,textoCorto(e.nombre)
                 ,textoCorto(p.razon_social) as razon_social
                 ,date(a.fecha_creacion)
                 ,estatus(a.estatus)
                 FROM apoyosgastos as a
                 INNER JOIN proveedores as p ON a.id_proveedor = p.id_proveedor   
                 INNER JOIN eventos as e ON a.id_evento = e.id_evento
                 WHERE a.categoria = :categoria "
                 ,["categoria"=>$categoria]
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
        a.id_apoyo as idApoyo
        ,a.categoria
        ,a.estatus 
        ,a.concepto
        ,a.importe
        ,importe(a.importe,a.tipo_cambio) as importeReal
        ,a.tipo_cambio as tipoCambio       
        ,a.observaciones 
        ,a.referencia
        ,a.mes_contable as mesContable
        ,IFNULL(a.id_documento_salida,0)as doctoSalida
        ,a.poliza
        ,date(a.fecha_referencia) as fechaReferencia
        ,date(a.fecha_docto_salida) as fechaDoctoSalida
        ,date(a.fecha_creacion) as fechaCaptura
        ,a.ultima_modificacion as ultimaModificacion
        ,p.id_proveedor as idProveedor
        ,p.tipo as tipoProveedor
        ,p.razon_social as razonSocial
        ,e.nombre as evento
        ,e.id_evento as idEvento
        ,f.id_frecuencia_apoyo idFrecuencia 
        ,f.nombre as frecuencia
        ,a.id_estado as idEstado
        ,pais.id_pais as idPais
        ,pais.nombre as pais
        ,st.nombre as nombreEstado
        ,a.id_moneda as idMoneda
        ,m.acronimo
        ,m.nombre as nombreMoneda
        FROM apoyosgastos as a
        INNER JOIN proveedores as p ON a.id_proveedor = p.id_proveedor   
        INNER JOIN eventos as e ON a.id_evento = e.id_evento        
        INNER JOIN frecuencia_apoyo AS f ON f.id_frecuencia_apoyo = a.id_frecuencia_apoyo
        INNER JOIN estado AS st ON st.id_estado = a.id_estado
        INNER JOIN pais as pais on st.id_pais = pais.id_pais
        INNER JOIN moneda AS m ON m.id_moneda = a.id_moneda
        WHERE a.id_apoyo = :id AND a.categoria = :tipo ";

        $data = $this->db->select($query,["id"=>$id_apoyo,"tipo"=>$tipo]);

        if($data){
            $result = $data[0];
            $query = "SELECT
                a.id_especie
                ,e.descripcion                
                ,a.cantidad
                ,u.id_unidad
                ,u.nombre                            
                FROM especie_apoyo as a
                INNER JOIN especies as e ON a.id_especie = e.id_especie
                INNER JOIN unidades as u on a.id_unidad = u.id_unidad
                WHERE a.id_apoyo = :id";

            $especieApoyo = $this->db->select($query,['id'=>$id_apoyo]);
            if($especieApoyo){
                $especieApoyo = $especieApoyo[0];
                $result['idEspecie'] = $especieApoyo['id_especie'];
                $result['descripcionEspecie'] = $especieApoyo['descripcion'];
                $result['cantidad'] = $especieApoyo['cantidad'];
                $result['unidad'] = $especieApoyo['nombre'];
                $result['idUnidad'] = $especieApoyo['id_unidad'];
            }else{
                $result['idEspecie'] = null;
            }

            //verificamos si tiene docto salida asociado
            if($data['doctoSalida']){
                
            }
        }
        return $result;
    }


    /**
    * Guarda un nuevo apoyo_gasto
    * @param Arreglo con los datos del apoyo_gasto
    * @return true si logra guardar los datos
    **/
    public function addApoyoGasto($data)
    {   
        $newData = [
            'concepto' => $data['concepto'], 
            'id_frecuencia_apoyo' => $data['frecuencia'],
            'importe' => $data['abono'],
            'observaciones' => $data['observaciones'],
            'referencia' => $data['numeroReferencia'],
            'mes_contable' => $data['mesContable'],
            'id_documento_salida' =>$data['doctoSalida']?:null,
            'poliza' => $data['poliza'],
            'fecha_referencia'=> $data['fechaReferencia']?:null,          
            'fecha_docto_salida' => $data['fechaDoctoSalida']?:null,
            'fecha_creacion' => $data['fechaCaptura'],
            'id_frecuencia_apoyo' => $data['frecuencia'],
            'id_estado' => $data['estado'],
            'id_moneda' => $data['moneda'],
            'id_evento' => $data['evento']
        ];

        if($data['estatus'])
            $newData['estatus'] = 1;

        if($data['proveedor']) 
            $newData['id_proveedor'] = $data['proveedor'];
        else
            $newData['id_proveedor'] = $data['donatario'];

        return $this->db->insertLastId('apoyosgastos', $newData);
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

    /**
    ** Obtiene todos los paises registrados
    **/
    public function getPaises(){
        $query = "select * from pais";
        return $this->db->select($query,[]);
    }

    /**
    ** Obtiene todos los estados
    **/
    public function getEstados($idPais=null){
        if($idPais){
            $query = "select * from estado where id_pais = :id";
            $result = $this->db->select($query,['id'=>$idPais]);
        }else{
            if($idPais==0){
                $query = "select * from estado where id_pais > 2";
                $result = $this->db->select($query,[]);
            }else{
                $query = "select * from estado";
                $result = $this->db->select($query,[]);
            }            
        }
        return $result;
    }

    /**
    * Obtiene todas las monedas registradas
    **/
    public function getMonedas(){
        $query = "select * from moneda";
        return $this->db->select($query,[]);
    }

    /**
    * Agrega una nueva unidad para especies
    **/
    public function addUnidad($unidad){
        return $this->db->insertLastId('unidades',['nombre' => $unidad]);
    }

    /**
    * Inserta datos en la relacion especie apoyo. 
    * Este caso es para cuando se selecciona un apoyo en especie
    **/
    public function addEspecieApoyo($data){
        return $this->db->insertLastId('especie_apoyo',
            [
            'id_apoyo' => $data['idApoyo'],
            'id_especie' => $data['idEspecie'],
            'cantidad' =>$data['cantidad'],
            'id_unidad' => $data['idUnidad']
            ]
        );
    }


    /**
    * Elimina una relacion de especie_apoyo
    * @param el id del apoyo
    **/
    public function deleteEspecieApoyo($idApoyo){
        return $this->db->delete("especie_apoyo", "id_apoyo = :id", array( "id" => $idApoyo));  
    }


    /**
    * Actuliza una relacion especie apoyo
    **/
    public function updateEspecieApoyo($data,$idApoyo){
        return $this->db->update("especie_apoyo", 
                    $data, 
                    "id_apoyo = :id",
                    array( "id" => $idApoyo )
               );
    }

    /**
    **Obtiene docto de salida para apoyos
    **/
    public function getDoctoSalida(){
        $query = "SELECT * FROM documento_salida WHERE id_documento_salida<5";
        return $this->db->select($query); 
    }


}
