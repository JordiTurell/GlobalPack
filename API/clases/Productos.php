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
        public $videourl;
        public $videotitle;
        public $videodesc;
        public $comparativa;
        public $anogarantia;
        public $home;
        public $relacionados;
        public $list_relacionados = array();
        public $servicios = array();
        public $Categoria;

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

        public function SetCategoria($cat){
            $this->Categoria = $cat;
        }

        public function SetRelacionados($product){
            array_push($this->list_relacionados, $product);
        }
        public function SetCountRelacionados($count){
            $this->relacionados = $count;
        }

        public function SetHome($home){
            $this->home = $home;
        }

        public function SetAnoGarantia($ano){
            $this->anogarantia = $ano;
        }

        public function SetComparativa($comp){
            $this->comparativa = $comp;
        }

        public function SetFichaTecnica($ficha){
            $this->FichaTecnica = $ficha;
        }

        public function SetImage($img){
            $this->imagen = $img;
        }

        public function Setvideo($url, $titulo, $desc){
            $this->videourl = $url;
            $this->videotitle = $titulo;
            $this->videodesc = $desc;
        }

        public function SetServicios($service){
            array_push($this->servicios, $service);
        }

        public function SetImages($img){
            if($this->imagen == ''){
                $this->imagen = array();
            }
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