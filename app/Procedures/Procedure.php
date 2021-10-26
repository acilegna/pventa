<?php
//Especifico la ruta donde se encuentra este archivo
namespace App\Procedures;
 
//Nombre de la clase
class  Procedure {
//Metodo que llamará a mi procedimiento
    public function getProcedimiento()
    {
        return \DB::select('CALL procedures');
    }

    //ENVIANDO PARAMETROS
     public function getProcedimiento1($precios)
    {
        return \DB::select('CALL procedures1(?)',array($precios));
    }
} 