<?php

function generarIBAN($nombre) {

    $nombre = str_pad($nombre , 4 , "z");

    $primerasLetras = substr($nombre, 0, 4);
    $abecedario = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $cadenaBinaria = "";
  
    for ($i=0; $i <strlen($primerasLetras) ; $i++) { 
       $letra = strtolower($primerasLetras[$i]);
       $valorASCII = ord($letra);
      
      
       $posicion = $valorASCII - ord('a') + 1;
       
       $valorBinario = decbin($posicion);
       $cadenaBinaria = $cadenaBinaria.$valorBinario;
    }

    return $cadenaBinaria;
}




$nombreUsuario = "azzz";
$ibanGenerado = generarIBAN($nombreUsuario);
echo "IBAN generado para '$nombreUsuario': $ibanGenerado";


?>