<?php

namespace Api\Models
{
	/**
	 * Productos short summary.
	 *
	 * Productos description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
	class Productos
	{
        public $indice;
        public $Id_Producto;
        public $Titulo;
        public $FechaC;
        public $PVP;
        public $PVP_Ocasion;
        public $Ocasion;
        public $Habilitado;
        public $imagen;
        public $Descripcion_corta;
        public $Descripcion;
        public $Id_SubCategoria;
        public $FichaTecnica;

        function __construct($Id_Producto, $Titulo, $FechaC, $PVP, $PVP_Ocasion, $Ocasion, $Habilitado){
            $this->Id_Producto = $Id_Producto;
            $this->Titulo = $Titulo;
            $this->FechaC = $FechaC;
            $this->PVP = $PVP;
            $this->PVP_Ocasion = $PVP_Ocasion;
            $this->Ocasion = $Ocasion;
            $this->Habilitado = $Habilitado;
            $this->imagen = '';
        }

        public function SetFichaTecnica($ficha){
            $this->FichaTecnica = $ficha;
        }

        public function SetImage($img){
            $this->imagen = $img;
        }

        public function SetImages($img){
            $this->imagen = array();
            array_push($this->imagen, $img);
        }

        public function SetDescripcionCorta($desc){
            $this->Descripcion_corta = $desc;
        }

        public function SetDescripcion($desc){
            $this->Descripcion = $desc;
        }

        public function SetId($id){
            $this->indice = $id;
        }

        public function SetSubCategoria($id){
            $this->Id_SubCategoria = $id;
        }
	}
}