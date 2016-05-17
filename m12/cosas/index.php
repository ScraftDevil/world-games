<?php require('_drawrating.php'); ?>
<head>
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
<link rel="stylesheet" type="text/css" href="css/rating.css" />
<style>
	h1,h2,h3{clear:both}
	pre{border:1px solid #ccc;background:#dadada;font-family:monospace;font-size:11px;color:#333;padding:10px;clear:both}
</style>
</head>
<body>
<?

?>
<h1>Sistema de Votaci&oacute;n</h1>
<p>Suponiendo que mostramos el registro 1 de la base de datos.</p>
<pre>$ide=1;</pre>
<? $ide=1; ?>
<div id='container'><?=rating_bar($ide,5,$valor)?></div>
<h2>C&oacute;digos necesarios</h2>
<h3>Base de Datos</h3>
<pre>CREATE TABLE IF NOT EXISTS `galeria` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `total_votes` int(255) NOT NULL,
  `total_value` int(11) NOT NULL,
  `used_ips` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `titulo`, `total_votes`, `total_value`, `used_ips`) VALUES
(1, 'Título', 0, 0, '');
</pre>
<h3>index.php</h3>
<p>Este archivo es el archivo de tu web donde mostrar&aacute;s el sistema de votaci&oacute;n.</p>
<pre>require('_drawrating.php');</pre>
<p>* Esto debe ir en la l&iacute;ea 1 y dentro de los tags PHP</p>
<? $va1=htmlentities('"<div id=\'container\'>".'); $va2=htmlentities('."</div>";'); ?>
<pre>$ide=1;
echo <?=$va1?>rating_bar($ide,5,$valor)<?=$va2?></pre>
<p>* Donde &dollar;ide=1 debe ser el id de tu base de datos y no 1</p>
<h3>Resto de archivos</h3>
<p>Oc&uacute;pate de modificar la palabra ´galeria´ por el nombre de tu tabla mysql en todos los archivos.</p>
<p>Desc&aacute;rgate el adjunto donde ya est&aacute;n modificados los c&oacute;digos necesarios y configura el archivo ´_config-rating.php´ con los datos de conexi&oacute;n mysql.</p>
</body>