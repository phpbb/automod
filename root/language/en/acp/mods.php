<?php
/** 
*
* acp_mods [Spanish]
*
* @package language
* @version $Id: mods.php 242 2012-01-16 23:17:35Z urielmx $
* @copyright (c) 2008 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
/**
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE 
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	'ADDITIONAL_CHANGES'	=> 'Cambios disponibles',

	'AM_MOD_ALREADY_INSTALLED'	=> 'AutoMOD ha detectado que MOD ya esta instalado y no puede continuar.',
	'AM_MANUAL_INSTRUCTIONS'	=> 'AutoMOD is sending a compressed file to your computer.  Because of the AutoMOD configuration, files cannot be written to your site automatically.  You will need to extract the file and upload the files to your server manually, using an FTP client or similar method.  If you did not receive this file automatically, click %shere%s.',

	'APPLY_THESE_CHANGES'	=> 'Aplicar estos cambios',
	'APPLY_TEMPLATESET'		=> 'a este templae',
	'AUTHOR_EMAIL'			=> 'Email del autor',
	'AUTHOR_INFORMATION'	=> 'Informaci&oacute;n del autor',
	'AUTHOR_NAME'			=> 'Nombre del autor',
	'AUTHOR_NOTES'			=> 'Notas del autor',
	'AUTHOR_URL'			=> 'URL del autor',
	'AUTOMOD'				=> 'AutoMOD',
	'AUTOMOD_CANNOT_INSTALL_OLD_VERSION'	=> 'La versi&oacute;n de AutoMOD que intentas instalar ya ha sido instalada.  Por favor elimina el directorio de instalaci&oacute;n.',
	'AUTOMOD_UNKNOWN_VERSION'	=>	'AutoMOD no ha podido ser actualizado por que no pudo determinar tu versi&oacute;n actual.  La versi&oacute;n listada de tu instalaci&oacute;n es %s.',
	'AUTOMOD_VERSION'		=> 'Versi&oacute;n de AutoMOD',

	'CAT_INSTALL_AUTOMOD'	=> 'AutoMOD',
	'CHANGE_DATE'	=> 'Fecha de lanzamiento',
	'CHANGE_VERSION'=> 'N&uacute;mero de versi&oacute;n',
	'CHANGES'		=> 'Cambios',
	'CHECK_AGAIN'  => 'Verifica de nuevo',
	'COMMENT'		=> 'Comentar',
	'CREATE_TABLE'	=> 'Modificaciones a la base de datos',
	'CREATE_TABLE_EXPLAIN'	=> 'AutoMOD ha realizado exit&oacute;samente las modificaciones a la base de datos, incluyendo un permiso para los “Full Administrator”.',
	'DELETE'			=> 'Borrar',
	'DELETE_CONFIRM'	=> '&iquest;Estas seguro que deseas eliminar este MOD?',
	'DELETE_ERROR'		=> 'Ha habido un error eliminando el MOD seleccionado.',
	'DELETE_SUCCESS'	=> 'El MOD ha sido eliminado exitosamente.',

	'DIR_PERMS'			=> 'Permisos de directorios',
	'DIR_PERMS_EXPLAIN'	=> 'Algunos sistemas requieren que determinados directorios tengan permisos para funcionar adecuadamente. Por lo general 0755 es correcto.  Esta configuracion no funciona en sistemas Windows.',
	'DIY_INSTRUCTIONS'	=> 'Instrucciones para instalar manualmente',
	'DEPENDENCY_INSTRUCTIONS'	=>	'El MOD que intentas instalar depende de otro MOD.  AutoMOD no puede detectar si tal MOD se encuentra instalado.  Por favor verifica que tengas instalado <strong><a href="%1$s">%2$s</a></strong> antes de instalar este MOD.',
	'DESCRIPTION'	=> 'Descripci&oacute;n',
	'DETAILS'		=> 'Detalles',

	'EDITED_ROOT_CREATE_FAIL'	=> 'AutoMOD no ha podido crear el directorio donde los archivos editados ser&aacute;n almacenados.',
	'ERROR'			=> 'Error',

	'FILE_EDITS'		=> 'File edits',
	'FILE_EMPTY'		=> 'Archivo vacio',
	'FILE_MISSING'		=> 'No se ha podido localizar el archivo',
	'FILE_PERMS'		=> 'Permisos del archivo',
	'FILE_PERMS_EXPLAIN'=> 'Algunos sistemas requieren que determinados directorios tengan permisos para funcionar adecuadamente. Por lo general 0644 es correcto.  Esta configuracion no funciona en sistemas Windows.',
	'FILE_TYPE'			=> 'Tipo de archivo comprimido',
	'FILE_TYPE_EXPLAIN'	=> 'Esto s&oacute;lo es v&aacute;lido con el m&eacute;todo de escritura “Descarga de archivo comprimido”',
	'FILESYSTEM_NOT_WRITABLE'	=> 'AutoMOD ha detectado que el archivo de sistema no es escribible, por lo que el sistema de "Escritura directa" no puede ser usado.',
	'FIND'				=> 'Encontrar',
	'FIND_MISSING'		=> 'No ha podido ser localizada la b&uacute;squeda especificada por el MOD',
	'FORCE_INSTALL'		=> 'Forzar instalaci&oacute;n',
	'FORCE_UNINSTALL'	=> 'Forzar desinstalaci&oacute;n',
	'FORCE_CONFIRM'		=> 'La propiedad de Forzar Instalaci&oacute;n implica que el MOD no sea instalado por completo. Tendr&aacute;s que hacer algunos arreglos manualmente a tu panel para concluir la instalaci&oacute;n. &iquest;Continuar?',
	'FTP_INFORMATION'	=> 'Informaci&oacute;n de FTP',
	'FTP_NOT_USABLE'  => 'La informaci&oacute;n de FTP no puede ser usada ya que ha sido deshabilitado por tu hosting.',
	'FTP_METHOD_ERROR' => 'No ha sido encontrado un m&eacute;todo FTP. Verifica dentro de la configuraci&oacute;n de autoMOD si hay un m&eacute;todo indicado correctamente.',
	'FTP_METHOD_EXPLAIN'=> 'Si experimentar problemas con "FTP", puedes intentar con "Conecci&oacute;n simple" como m&eacute;todo alternativo.',
	'FTP_METHOD_FTP'	=> 'FTP',
	'FTP_METHOD_FSOCK'	=> 'Conecci&oacute;n simple',

	'GO_PHP_INSTALLER'  => 'EL MOD requiere un instalador externo para terminar la instalaci&oacute;n.  Haga click aqu&iacute; para ir a ese paso.',

	'INHERIT_NO_CHANGE'	=> 'No se han llevado a cabo cambios en este archivo por que la plantilla %1$s depende de %2$s.',
	'INLINE_FIND_MISSING'=> 'La b&uacute;squeda in-line especificada por el MOD no ha podido ser localizada.',
	'INLINE_EDIT_ERROR'	=> 'Error, a una edici&oacute;n en linea del archivo de instalaci&oacute;n del MODX le faltan todos los archivos',
	'INSTALL_AUTOMOD'	=> 'Instalaci&oacute;n de AutoMOD',
	'INSTALL_AUTOMOD_CONFIRM'	=> '&iquest;estas seguro que deseas instalar AutoMOD?',
	'INSTALL_TIME'		=> 'Tiempo de instalaci&oacute;n',
	'INSTALL_MOD'		=> 'Instalar este MOD',
	'INSTALL_ERROR'		=> 'Una o m&aacute;s acciones han fallado. Por favor verifica las acciones siguientes, realiza los cambios pertinentes y reintenta. Puedes continuar con la instalaci&oacute;n a&uacute;n cuando algunas acciones hallan fallado. <strong>No es recomendad ya que puede provocar que el panel no funcione correctamente.</strong>',
	'INSTALL_FORCED'	=> 'Has forzado la instalaci&oacute;n de este MOD a&uacute;n cuando hubo errores en la instalaci&oacute;n. Tu panel podr&iacute;a estar da&ntilde;ado. Verifica las acciones que fallaron y corr&iacute;gelas.',
	'INSTALLED'			=> 'MOD instalado',
	'INSTALLED_EXPLAIN'	=> '&iexcl;Tu MOD ha sido instalado! Aqu&iacute; puedes ver algunos de los resultados de la instalaci&oacute;n. Por favor verifica los errores y de ser necesario busca ayuda en <a href="http://www.phpbb.com" target="_blank">phpBB.com</a>',
	'INSTALLED_MODS'	=> 'MODs instalados',
	'INSTALLATION_SUCCESSFUL'	=> 'AutoMOD instalado exit&oacute;samente. Ahora puedes manejar las modificaciones de phpBB por medio de AutoMOD en el panel de control de administraci&oacute;n (ACP).',
	'INVALID_MOD_INSTRUCTION'	=> 'Este MOD tiene una instrucci&oacute;n inv&aacute;lida, o un &quot;Encontrar en linea&quot; fallido.',
	'INVALID_MOD_NO_FIND'       => 'Al MOD le falta un &quot;Encontrar&quot; que concuerde con la acci&oacute;n ‘%s’',
	'INVALID_MOD_NO_ACTION'     => 'Al MOD le falta una acci&oacute;n que concuerde con el Encontrar ‘%s’',

	'LANGUAGE_NAME'		=> 'Nombre del idioma',

	'MANUAL_COPY'				=> 'No se ha intentado copiar',
	'MOD_CONFIG'				=> 'Configuraci&oacute;n de AutoMOD',
	'MOD_CONFIG_UPDATED'        => 'La configuraci&oacute;n de AutoMOD ha sido actualizada.',
	'MOD_DETAILS'				=> 'Detalles del MOD',
	'MOD_DETAILS_EXPLAIN'		=> 'Aqu&iacute; puedes ver tofa la informaci&oacute;n acerca del MOD seleccionado.',
	'MOD_MANAGER'				=> 'AutoMOD',
	'MOD_NAME'					=> 'Nombre del MOD',
	'MOD_OPEN_FILE_FAIL'		=> 'AutoMOD no pudo abrir %s.',
	'MOD_UPLOAD'				=> 'Subir MOD',
	'MOD_UPLOAD_EXPLAIN'		=> 'Aqu&iacute; puedes subir un MOD comprimido en zip que contenga los archivos MODX necesarios para ejecutar la instalaci&oacute;n.  AutoMOD intentar&aacute; descomprimir el archivo y dejarlo listo para instalar.',
	'MOD_UPLOAD_INIT_FAIL'		=> 'ha habido un error inicializando el proceso de subida del MOD.',
	'MOD_UPLOAD_SUCCESS'		=> 'El MOD ha sido subido y preparado para la instalaci&oacute;n.',
	'AUTOMOD_INSTALLATION'		=> 'Instalaci&oacute;n de AutoMOD',
	'AUTOMOD_INSTALLATION_EXPLAIN'	=> 'Bienvenido a la instalaci&oacute;n de AutoMOD. Necesitar&aacute;s tus datos de acceso de FTP si AutoMOD detecta que es la mejor forma de instalar.  Los resultados de las pruebas se muestran posteriormente.',

	'MODS_CONFIG_EXPLAIN'		=> 'Aqu&iacute; puedes configurar tus preferencias de AutoMOD. el m&eacute;todo mas sencillo es &quot;Descarga de archivo comprimido&quot;.  Los otros requieren permisos adicionales en el servidor.',
	'MODS_COPY_FAILURE'			=> 'El archivo %s no pudo ser puesto en su lugar.  Por favor verifica los permisos de escritura o usa un m&eacute;todo alterno de instalaci&oacute;n.',
	'MODS_EXPLAIN'				=> 'Aqu&iacute; puedes controlar los MODs disponibles en tu panel. AutoMODs te permite personalizar tu panel instalando autom&aacute;ticamente las modificaciones producidas por la comunidad phpBB. Para mayor informaci&oacute;n acerca de los MODs y AutoMOD por favor visita el <a href="http://www.phpbb.com/mods" target="_blank">sitio de phpBB</a>.  Para agregar un MOD a esta lista, usa el formulario al pie de esta p&aacute;gina.  Altrnativamente, puedes descomprimir y subir los archivos al directorio /store/mods/ de tu servidor.',
	'MODS_FTP_FAILURE'			=> 'AutoMOD could not FTP the file %s into place',
	'MODS_FTP_CONNECT_FAILURE'	=> 'AutoMOD no se pudo conectar a tu servidor FTP.  El error fu&eacute; %s',
	'MODS_MKDIR_FAILED'			=> 'El directorio %s no pudo ser creado',
	'MODS_SETUP_INCOMPLETE'		=> 'Fu&eacute; encontrado un problema con tu configuraci&oacute;n, y AutoMOD no pudo funcionar.  Esto normalmente s&oacute;lo ocurre cuando los datos de configuraci&oacute;n (p.e. el usuario FTP) han cambiado, y pueden ser corregidos en la p&aacute;gina de configuraci&oacute;n de AutoMOD.',

	'NAME'			=> 'Nombre',
	'NEW_FILES'		=> 'Archivos nuevos',
	'NO_ATTEMPT'	=> 'No intentado',
	'NO_INSTALLED_MODS'		=> 'No han sido detectados MODs instalados',
	'NO_MOD'				=> 'El MOD seleccionado no pudo ser localizado.',
	'NO_UNINSTALLED_MODS'	=> 'No han sido localizados MODs desinstalados',
	'NO_UPLOAD_FILE'		=> 'No ha sido especificado un archivo.',

	'ORIGINAL'	=> 'Original',

	'PATH'					=> 'Path',
	'PREVIEW_CHANGES'		=> 'Previsualizar cambios',
	'PREVIEW_CHANGES_EXPLAIN'	=> 'Mostrar los cambios que se realizar&aacute;n antes de que sean ejecutados.',
	'PRE_INSTALL'			=> 'Prepar&aacute;ndose a instalar',
	'PRE_INSTALL_EXPLAIN'	=> 'Aqu&iacute; puedes previsualizar todas las modificaciones a llevarse a cabo en tu panel, antes de que sean llevadas a cabo. <strong>&iexcl;CUIDADO!</strong>, una vez aceptadas, los archivos base de tu phpBB ser&aacute;n editados y podr&iacute;an ocurrir alteraciones a la base de datos. De cualquier forma, si la instalacion no es exitosa, y asumiendo que tengas acceso a AutoMOD, tendr&aacute;s la opcion de restaurar a este punto.',
	'PRE_UNINSTALL'			=> 'Prepar&aacute;ndose a desinatalar',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Aqu&iacute; puedes previsualizar todas las modificaciones a llevarse a cabo en tu panel, a fin de desintalar el MOD. <strong>&iexcl;CUIDADO!</strong>, una vez aceptadas, una vez aceptadas, los archivos base de tu phpBB ser&aacute;n editados y podr&iacute;an ocurrir alteraciones a la base de datos. De cualquier forma, si la instalacion no es exitosa, y asumiendo que tengas acceso a AutoMOD, tendr&aacute;s la opcion de restaurar a este punto.',

	'REMOVING_FILES'	=> 'Archivos a ser removidos',
	'RETRY'				=> 'Reintentar',
	'RETURN_MODS'		=> 'Regresar a AutoMOD',
	'REVERSE'			=> 'Reversa',
	'ROOT_IS_READABLE'	=> 'El directorio ra&iacute;z de phpBB es legible.',
	'ROOT_NOT_READABLE'	=> 'AutoMOD no pudo abrir el index.php de phpBB para su lectura. Est probablemente se deba a que los permisos de la ra&iacute;z de tu foro phpBB son muy restrictivos, lo cual le impedir&aacute; a AutoMOD trabajar. Por favor verifica los permisos e intenta de nuevo.',


	'SOURCE'		=> 'Fuente',
	'SQL_QUERIES'	=> 'Consultas SQL',
	'STATUS'		=> 'Estado',
	'STORE_IS_WRITABLE'			=> 'El directorio store/ es escribible.',
	'STORE_NOT_WRITABLE_INST'	=> 'El instalador AutoMOD ha detectado que el directorio store/ no es escribible. Esto es requerido para que AutoMOD trabaje apropiadamente. Por favor verifica los permisos e intenta de nuevo.',
	'STORE_NOT_WRITABLE'		=> 'El directorio store/ no es escribible.',
	'STYLE_NAME'	=> 'Nombre del estilo',
	'SUCCESS'		=> '&Eacute;xito',

	'TARGET'		=> 'Objetivo',

	'UNKNOWN_MOD_AUTHOR-NOTES'	=> 'No hay notas especificadas de parte del autor.',
	'UNKNOWN_MOD_DESCRIPTION'	=> '',
	'UNKNOWN_MOD_DIY-INSTRUCTIONS'=>'', // empty string hides this if not specified.
	'UNKNOWN_MOD_COMMENT'		=> '',
	'UNKNOWN_MOD_INLINE-COMMENT'=> '',
	'UNKNOWN_QUERY_REVERSE' => 'Consulta de reversa desconocida',

	'UNINSTALL'				=> 'Desinstalar',
	'UNINSTALL_AUTOMOD'		=> 'Desinstalaci&oacute;n de AutoMOD',
	'UNINSTALL_AUTOMOD_CONFIRM' => '&iquest;Estas seguro que deseas desinstalar AutoMOD? Esto no desinstalar&aacute; los MODs instalados con AutoMOD.',
	'UNINSTALLED'			=> 'MOD desinstalado',
	'UNINSTALLED_MODS'		=> 'MODs desinstalados',
	'UNINSTALLED_EXPLAIN'	=> '&iexcl;El MOD ha sido desinstalado! Aqu&iacute; puedes ver algunos resultados de la desinstalaci&oacute;n. Por favor toma nota de cualquier error, y busca posibles soluciones en <a href="http://www.phpbb.com" target="_blank">phpBB.com</a>.',
	'UNRECOGNISED_COMMAND'	=> 'Error, comando no reconocido %s',
	'UPDATE_AUTOMOD'		=> 'Actualizar AutoMOD',
	'UPDATE_AUTOMOD_CONFIRM'=> 'Por favor confirma que quieres actualizar AutoMOD.',

	'UPLOAD'				=> 'Subir',
	'VERSION'				=> 'Versi&oacute;n',

	'WRITE_DIRECT_FAIL'		=> 'AutoMOD no pudo copiar el archivo %s en su lugar usando el m&eacute;todo Directo. Por favor selecciona otro m&eacute;todo de escritura e intenta de nuevo.',
	'WRITE_DIRECT_TOO_SHORT'=> 'AutoMOD no pudo terminar de escribir el archivo %s. A menudo, esto puede ser resuelto con el bot&oacute;nn Reintentar. Si esto no funciona, intenta otro m&eacute;todo de escritura.',
	'WRITE_MANUAL_FAIL'		=> 'AutoMOD no pudo agregar el archivo %s a un archivo comprimido. Por favor utiliza otro m&eacute;todo de escritura.',
	'WRITE_METHOD'			=> 'M&eacute;todo de escritura',
	'WRITE_METHOD_DIRECT'	=> 'Directo',
	'WRITE_METHOD_EXPLAIN'	=> 'Puedes eligir tu m&eacute;todo preferido de escritura. La opci&oacute;n mas compatible es “Descarga de archivo comprimido”.',
	'WRITE_METHOD_FTP'		=> 'FTP',
	'WRITE_METHOD_MANUAL'	=> 'Descarga de archivo comprimido',

	// Estas palabras clave de acciones estan a propósito en minúsculas y con espacios
	'after add'				=> 'Agregar antes',
	'before add'			=> 'Agregar despues',
	'find'					=> 'Encontrar',
	'in-line-after-add'		=> 'En l&iacute;nea despu&eacute;s, Agregar',
	'in-line-before-add'	=> 'En l&iacute;nea Antes, Agregar',
	'in-line-edit'			=> 'En l&iacute;nea Encontrar',
	'in-line-operation'		=> 'En l&iacute;nea Incrementar',
	'in-line-replace'		=> 'En l&iacute;nea Reemplazar',
	'in-line-replace-with'	=> 'En l&iacute;nea Reemplzar',
	'replace'				=> 'Reemplzar con',
	'replace with'			=> 'Reemplzar con',
	'operation'				=> 'Incrementar',
));

?>