<?php

use Api\Config\Setup as Data;
use Api\Config\Token;
use Api\Config\DataContext;

require_once("../API/Config/Token.php");
require_once("../API/Config/Config.php");
require_once("../API/Config/DataContext.php");


if(!empty($_GET["token"])){
    if(Token::CheckTokenAdmin($_GET['token'])){
        $xls_filename = 'export_'.date('Y-m-d').'.xls';

        $config = new Data(DataContext::Admin);
        $conn = $config->Conect();

        $sql = "SELECT * FROM productos";
        $res = mysqli_query($conn, $sql);
        $output = '';

        if(mysqli_num_rows($res) > 0){
            $output .= '<table class="table" bordered="1">
                    <tr style="border:solid;">
                        <th>Indice</th>
                        <th>Id_Producto</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Video</th>
                        <th>Referencia</th>
                        <th>Comparativa</th>
                        <th>pdf</th>
                        <th>Ficha_Tecnica</th>
                        <th>FechaC</th>
                        <th>FechaM</th>
                        <th>Descripcio_min</th>
                        <th>PVP</th>
                        <th>PVP_Ocasion</th>
                        <th>Anogarantia</th>
                        <th>Ocasion</th>
                        <th>Habilitado</th>
                        <th>Titulo_Video</th>
                        <th>Descripcion_Video</th>
                        <th>Home</th>
                        <th>Orden</th>
                    </tr>';
            while($row = mysqli_fetch_array($res))
            {
                $output .= '<tr>
                    <td>'.$row["Indice"].'</td>
                    <td>'.$row["Id_Producto"].'</td>
                    <td>'.$row["Titulo"].'</td>
                    <td>'.$row["Descripcion"].'</td>
                    <td>'.$row["Video"].'</td>
                    <td>'.$row["Referencia"].'</td>
                    <td>'.$row["Comparativa"].'</td>
                    <td>'.$row["pdf"].'</td>
                    <td>'.$row["Ficha_Tecnica"].'</td>
                    <td>'.$row["FechaC"].'</td>
                    <td>'.$row["FechaM"].'</td>
                    <td>'.$row["Descripcio_min"].'</td>
                    <td>'.$row["PVP"].'</td>
                    <td>'.$row["PVP_Ocasion"].'</td>
                    <td>'.$row["Anogarantia"].'</td>
                    <td>'.$row["Ocasion"].'</td>
                    <td>'.$row["Habilitado"].'</td>
                    <td>'.$row["Titulo_Video"].'</td>
                    <td>'.$row["Descripcion_Video"].'</td>
                    <td>'.$row["Home"].'</td>
                    <td>'.$row["Orden"].'</td>
                </tr>';
            }
            $output .= '</table>';

            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename='.$xls_filename);
            echo $output;
        }
    }
}

?>