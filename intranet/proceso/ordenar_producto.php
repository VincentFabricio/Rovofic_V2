<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BlogdePhp.com, demo del script para crear una tienda on-line e-commerce - Web Hosting</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="http://blogdephp.com/script/php/e-commerce/estilo.css" type="text/css" media="screen">
</head>
<body>
<?
if(isset($_POST['producto'])){ // Para evitar agregar un producto al carrito cuando el usuario sólo presionó el link "Ver cesta"
$_SESSION['productos_ordenados'][]=array(

"producto"=> $_POST['producto'],
"unidades"=> $_POST['unidades'],
"precio-unitario"=> $_POST['precio-unitario'],
"subtotal"=> $_POST['precio-unitario']*$_POST['unidades']
);
}
?>

<div id="contenedor">
<div id="cabecera">
Demo script tienda on-line (e-commerce) en php:
</div>
<div id="cuerpo">
<div id="principal_carrito">
<ul>
<li>
<ul class="productos_ordenados Negrita">
<li>Producto<div id="navegacion_carrito"><a href="indice_productos.html">Productos</a> | <a href="ordenar_producto.php">Ver cesta</a> | <a href="javascript:history.back(1)">Volver</a></div></li>
<li>Unidades</li>
<li>Precio Unitario</li>
<li>Subtotal</li>
</ul>
</li>

<?
if(isset($_SESSION['productos_ordenados'])){
foreach($_SESSION['productos_ordenados'] as $producto_ordenado){
$importe_total=$importe_total+$producto_ordenado['subtotal'];
?>

<li>
<ul class="productos_ordenados">
<li>
<?= $producto_ordenado['producto'];?>
</li>
<li>
<?= $producto_ordenado['unidades'];?>
</li>
<li>u$s
<?= $producto_ordenado['precio-unitario'];?>
</li>
<li>u$s
<?= $producto_ordenado['subtotal'];?>
</li>
</ul>
</li>

<?
}
?>

<li>
<ul class="productos_ordenados total">
<li><label class="Negrita">Total:</label></li>
<li></li>
<li></li>
<li><label class="Negrita">u$s
<?= $importe_total;?>
</label></li>
</ul>
</li>

<?
}
else{
?>
<li>Su cesta se encuentra vacía</li>
<?
}
?>

</ul>
<div id="notacesta">
<label class="Negrita">Nota</label>: Esta tienda on-line podría ayudarte a mejorar la calidad de servicio que ofreces a tus clientes e incrementar las ventas en tu negocio, ¿verdad?<br><br>
Si te dedicas a otra actividad y no eres programador, puedes <a href="/instalacion-ecommerce-php-tienda-online">ingresar aquí y contratar el servicio de instalación de la tienda</a> en tu sitio.
</div>

</div>
</div>
</body>
</html>