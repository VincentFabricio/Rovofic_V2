<?php
$clave  = 'Lorem ipsum dolor sit amet consectetur adipiscing elit ante in class luctus ligula donec, ut lacinia congue sem duis cursus commodo enim laoreet molestie fames. Nulla semper aliquam aptent tortor eget sem nisi curae ridiculus, conubia aliquet habitant nibh arcu lobortis ullamcorper. Ornare aenean integer torquent placerat ullamcorper bibendum vel eros dapibus magna sodales donec, sollicitudin suspendisse tristique inceptos purus class fermentum facilisi porttitor eget nisl nullam, varius non montes rhoncus fusce hendrerit himenaeos nec nisi vitae quam. Sollicitudin donec mus imperdiet congue taciti facilisis nibh pretium fermentum, duis eget convallis pulvinar turpis auctor inceptos quis vehicula, per litora ultrices porta lectus velit magna interdum.';
//Metodo de encriptaci�n
$method = 'aes-256-cbc';
// Puedes generar una diferente usando la funcion $getIV()
$iv = base64_decode("6rFp7P2hO/E6cqal7XIReg==");
 /*
 Encripta el contenido de la variable, enviada como parametro.
  */
 $encriptar = function ($valor) use ($method, $clave, $iv) {
     return openssl_encrypt ($valor, $method, $clave, false, $iv);
 };
 /*
 Desencripta el texto recibido
 */
 $desencriptar = function ($valor) use ($method, $clave, $iv) {
     $encrypted_data = base64_decode($valor);
     return openssl_decrypt($valor, $method, $clave, false, $iv);
 };