# world-games
Proyecto M12
Git para proyecto M12
Web: http://worldgamesm12.hol.es/

Trabajos pendientes para cada uno:
Operaciones de Juego (Form + PHP) [Administracion y Parte Usuario] => Carlos
Operaciones de Juego, Generos y Plataformas, Detalle Producto (Incluyendo comentarios) (Form + PHP) [Administracion y Parte Usuario] => Carlos
Operaciones de Usuarios (Form + PHP) [Administracion y Parte Usuario] => David y Ignacio (Parte Usuario)
Operaciones de Ofertas (Form + PHP) [Administracion y Parte Usuario] => Cristian
Operaciones de Lista Juegos i ofertas PRINCIPAL (Form + PHP) [Administracion y Parte Usuario] => Cristian
Operaciones de Perfil Usuario (Form + PHP) [Administracion y Parte Usuario] => Ignacio (queda añadir para poder subir imagen de perfil y validaciones de cliente)

Hay mas cosas ya se iran asignando...
Operaciones de Buzon(Quejas y Denuncias) [Administracion] => David
Operaciones de Buzon(Quejas y Denuncias) [Parte Usuario] => Carlos
Operaciones de Mensajes Privados (Form + PHP) [Administracion y Parte Usuario] => Ignacio (queda añadir validaciones de cliente)

Menos prioridad:
Estadisticas web => Ignacio (ya está creada la gráfica en el apartado admin de la cantidad de juegos por plataforma)
Cookies para session admin => David
Buy en la shopping cart (detalles + compra paypal) => PENDIENTE


Gestion de paises => NO
Gestion de mensajes privados => NO
Gestion de comentarios de juegos => SEGURAMENTE NO HAY TIEMPO



Como usar el UPLOADER BY DARKFOX [CristianO]
Se debe incluir en el formulario PHP lo siguiente:
##################################################################

$uploadText['text'] = "Subir Imagen de Juego"; //Texto a mostrar como label antes del boton

$uploadText['textUploadBtn'] = "Elegir imagen"; //Texto a mostrar en el boton

$pathUpload = "../../../view/resources/images/avatars/".$id."/"; //ruta relativa a la ruta del uploader para guardar la imagen

include("../../../view/sections/uploader/showUploadView.php");//Ruta para incluir el form uploader

##################################################################


Tareas de documentacion

infraestructura web amb maquina virtual -> david
administracio remota -> david
virtual host -> david
connexions segures -> david
documentacio (sistema de php doc) -> ignacio
sistema control de versions -> ignacio

##############################################################
FALTA:
-Editar Juego
-Eliminar ofertas
-Gestion comentarios juego, plataformas, generos
-Recapcha en Login Registrado
-Cargar dinamicamente filtros plataformas y generos disponbibles
-Arreglar estadisticas y agregar al index administrator panel
-JS de footer aparte
-Detalles de compra (Compra incluida paypal)
-Aviso al hacer el redirect con problema de permisos
-Aviso si no hay session shop en home
-Aviso al añadir algo al carro
##############################################################