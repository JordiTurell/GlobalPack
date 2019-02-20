<?php

namespace Api\Models
{
	/**
	 * Post short summary.
	 *
	 * Post description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
	class Post
	{
        public $idBlog;
        public $Titulo;
        public $Descripcion;
        public $Descripcion_corta;
        public $FechaC;
        public $video;
        public $Activado;
        public $imagenes = [];

        function __construct($idBlog, $Titulo, $Descripcion, $Descripcion_corta, $FechaC, $video, $activado){
            $this->idBlog = $idBlog;
            $this->Titulo = $Titulo;
            $this->Descripcion = $Descripcion;
            $this->Descripcion_corta = $Descripcion_corta;
            $this->FechaC = $FechaC;
            $this->video = $video;
            $this->Activado = $activado;
        }

        public function SetImages($image){
            array_push($this->imagenes, $image);
        }
	}
}