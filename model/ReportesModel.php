<?php
require_once("config/database.php");

/**
* Modelo para reportes 
*/
class ReportesModel
{
	private $db = null;
	
	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function getSaldo(){
		$query = "select saldo()";
		return $this->db->select($query,[],PDO::FETCH_NUM)[0][0];
	}

	public function reporteFlujo($fechaInicio, $fechaFin){
		$query = "SELECT
				a.id_apoyo as id
				,a.mes_contable as mesContable
				,a.fecha_referencia as fechaReferencia
				,a.referencia 
				,a.fecha_docto_salida as fechaDoctoSalida
				,d.nombre as doctoSalida
				,a.poliza
				,a.concepto
				,null as cargo
				,importe(a.importe,a.tipo_cambio) as abono
				,saldo() as saldo
				FROM apoyosgastos as a
				INNER JOIN documento_salida as d on a.id_documento_salida=d.id_documento_salida
				WHERE a.fecha_docto_salida BETWEEN $fechaInicio AND $fechaFin
			UNION 
				SELECT
				id_cargo as id
				,mes_contable as mesContable
				,null as fechaReferencia
				,null as referencia
				,fecha_docto_salida as fechaDoctoSalida
				,doc.nombre as doctoSalida
				,null as poliza
				,concepto
				,cargo
				,null as abono
				,saldo() as saldo
				FROM cargo
				INNER JOIN documento_salida as doc on cargo.id_documento_salida=doc.id_documento_salida
				WHERE fecha_docto_salida BETWEEN $fechaInicio AND $fechaFin
			ORDER BY fechaDoctoSalida
			 ";
	}


}