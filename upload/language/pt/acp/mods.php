<?php
/**
*
* acp_mods [Portuguese]
*
* @package language
* @version $Id: mods.php 242 2010-04-29 00:56:35Z jelly_doughnut $
* @copyright (c) 2008 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* phpBB Portugal ( http://phpbbportugal.com )
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
   'ADDITIONAL_CHANGES'        			=> 'Alterações Disponíveis',

   'AM_MOD_ALREADY_INSTALLED'      		=> 'O AutoMOD detectou que este MOD já estava instalado.',
   'AM_MANUAL_INSTRUCTIONS'     		=> 'O AutoMOD está a enviar um ficheiro comprimido para seu computador. Devido à configuração do AutoMOD, os ficheiros não podem ser enviados automaticamente para o seu site. Descomprima o ficheiro e envie os ficheiros manualmente para o servidor, usando um cliente de FTP ou outro método semelhante. Se não receber esse ficheiro automaticamente, clique %saqui%s.',

   'APPLY_THESE_CHANGES'         		=> 'Aplicar estas mudanças',
   'APPLY_TEMPLATESET'           		=> 'a este template',
   'AUTHOR_EMAIL'               		=> 'Email do Autor',
   'AUTHOR_INFORMATION'         		=> 'Informação do Autor',
   'AUTHOR_NAME'               			=> 'Nome do Autor',
   'AUTHOR_NOTES'               		=> 'Notas do Autor',
   'AUTHOR_URL'               			=> 'URL do Autor',
   'AUTOMOD'                 			=> 'AutoMOD',
   'AUTOMOD_CANNOT_INSTALL_OLD_VERSION' => 'A versão do AutoMOD que tentou instalar já se encontra instalada. Por favor, apague o directório install/ .',
   'AUTOMOD_UNKNOWN_VERSION'      		=> 'O AutoMOD não está disnponível para ser actualizado porque não é possível determinar a versão actualmente instalada. A versão listada para a sua instalação é a %s.',
   'AUTOMOD_VERSION'            		=> 'Versão do AutoMod',
   
   'CAT_INSTALL_AUTOMOD'         		=> 'AutoMOD',
   'CHANGE_DATE'               			=> 'Data de Publicação',
   'CHANGE_VERSION'           			=> 'Versão',
   'CHANGES'                 			=> 'Alterações',
   'CHECK_AGAIN'               			=> 'Verificar novamente',
   'COMMENT'                  			=> 'Comentário',
   'CREATE_TABLE'              			=> 'Alterações à Base de Dados',
   'DELETE'                  			=> 'Apagar',
   'CREATE_TABLE_EXPLAIN'         		=> 'O AutoMOD terminou as alterações com sucesso, incluindo a permissão à qual foi atribuída “Acesso Completo”.',
   'DELETE_CONFIRM'            			=> 'Tem a certeza de que deseja apagar este MOD?',
   'DELETE_ERROR'               		=> 'Ocorreu um erro ao apagar o MOD seleccionado.',
   'DELETE_SUCCESS'            			=> 'O MOD foi apagado com sucesso.',
   
   'DIR_PERMS'                  		=> 'Permissões da Directoria',
   'DIR_PERMS_EXPLAIN'            		=> 'Em alguns servidores, para funcionarem correctamente, as directorias necessitam permissões específicas. Normalmente o valor padrão 0755 permite um correcto funcionamento. Esta configuração não tem qualquer impacto nos sistemas Windows.',
   'DIY_INSTRUCTIONS'           		=> 'Instruções',
   'DEPENDENCY_INSTRUCTIONS'     		=> 'O MOD que está a tentar instalar depende de outro MOD. O AutoMOD não consegue detectar se este MOD esté instalado. Por favor, verifique que <strong><a href="%1$s">%2$s</a></strong> está instalado antes de instalar o novo MOD.',
   'DESCRIPTION'               			=> 'Descrição',
   'DETAILS'                  			=> 'Detalhes',

   'EDITED_ROOT_CREATE_FAIL'      		=> 'O AutoMOD é incapaz de criar a directoria onde os ficheiros editados serão armazenados.',
   'ERROR'                     			=> 'Erro',

   'FILE_EDITS'               			=> 'Editar Ficheiro',
   'FILE_EMPTY'               			=> 'Ficheiro vazio',
   'FILE_MISSING'               		=> 'Impossível localizar o Ficheiro',
   'FILE_PERMS'               			=> 'Permissões do Ficheiro',
   'FILE_PERMS_EXPLAIN'         		=> 'Em alguns servidores, para funcionarem correctamente, os ficheiros necessitam permissões específicas. Normalmente o valor padrão 0644 permite um correcto funcionamento. Esta configuração não tem qualquer impacto nos sistemas Windows.',
   'FILE_TYPE'                  		=> 'Tipo compressão',
   'FILE_TYPE_EXPLAIN'            		=> 'Isto só é válido com o método de "Transferência do Ficheiro Comprimido"',
   'FILESYSTEM_NOT_WRITABLE'      		=> 'O AutoMOD detectou que o ficheiro não pode ser Escrito, por isso, o método de Escrita Directa não pode ser usada.',
   'FIND'                     			=> 'Procurar',
   'FIND_MISSING'               		=> 'A procura especificada pelo MOD não foi encontrada',
   'FORCE_INSTALL'              		=> 'Instalação Forçada',
   'FORCE_UNINSTALL'            		=> 'Forçar desinstalação',
   'FORCE_CONFIRM'               		=> 'Forçar a instalação significa que MOD não está totalmente instalado. Vai ter que fazer correcções manualmente no fórum para concluir a instalação. Continue?',
   'FTP_INFORMATION'            		=> 'Informação FTP',
   'FTP_NOT_USABLE'           			=> 'A função FTP não pode ser usada porque foi desativada pelo seu serviço de alojamento.',
   'FTP_METHOD_ERROR'             		=> 'Não foi encontrado nenhum servidor FTP. Verifique na configuração do AutoMOD as definições correctas de FTP.',
   'FTP_METHOD_EXPLAIN'         		=> 'Se tiver problemas com o padrão "FTP", pode tentar "Simple Socket" como uma forma alternativa de ligar ao servidor FTP.',
   'FTP_METHOD_FTP'            			=> 'FTP',
   'FTP_METHOD_FSOCK'            		=> 'Simple Socket',

   'GO_PHP_INSTALLER'  					=> 'Para concluir a instalação o MOD requer um instalador externo, clique aqui para continuar.',

   'INHERIT_NO_CHANGE'            		=> 'Não podem ser feitas alterações a este ficheiro porque o template %1$s depende de %2$s.',
   'INLINE_FIND_MISSING'         		=> 'A "Procura Por Linha" (In-Line Find) especificada pelo MOD não foi encontrada.',
   'INLINE_EDIT_ERROR'					=> 'Ocorreu um erro ao editar um ficheiro. Estão em falta os elementos necessários.',
   'INSTALL_AUTOMOD'            		=> 'Instalação do AutoMOD',
   'INSTALL_AUTOMOD_CONFIRM'      		=> 'Tem a certeza que deseja instalar o AutoMOD?',
   'INSTALL_TIME'               		=> 'Tempo de Instalação',
   'INSTALL_MOD'               			=> 'Instalar este MOD',
   'INSTALL_ERROR'               		=> 'Uma ou mais instalações falharam. Por favor, reveja as acções abaixo, faça quaisquer ajustamentos e volte a tentar. Pode continuar com a instalação mesmo que algumas acções tenham falhado. <strong>Isto não é recomendado e pode causar problemas ao seu fórum.</strong>',
   'INSTALL_FORCED'            			=> 'Forçou a instalação deste MOD mesmo existindo alguns erros. O seu fórum pode estar inutilizável. Por favor, anote as accções abaixo que falharam e corrija-as.',
   'INSTALLED'                  		=> 'MOD instalado.',
   'INSTALLED_EXPLAIN'            		=> 'O seu MOD foi instalado! Aqui pode ver alguns resultados da instalação. Por favor, anote quaisquer erros e reporte-os em <a href="http://phpbbportugal.com/forum/portal.php">phpBB Portugal</a> e/ou <a href="http://www.phpbb.com">phpBB.com</a>',
   'INSTALLED_MODS'            			=> 'Modificações instaladas',
   'INSTALLATION_SUCCESSFUL'      		=> 'AutoMOD instalado com êxito. Pode agora gerir as Modificações phpBB através do separador do AutoMOD no Painel de Administração.',
   'INVALID_MOD_INSTRUCTION'      		=> 'Este MOD tem uma instrução inválida ou uma "Procura Por Linha" (In-Line Find) falhou',
   'INVALID_MOD_NO_FIND'       			=> 'Erro numa acção Procurar ‘%s’',
   'INVALID_MOD_NO_ACTION'     			=> 'Erro não foi possível concluir uma acção Procurar ‘%s’',
   
   'LANGUAGE_NAME'              		=> 'Idioma',

   'MANUAL_COPY'               			=> 'Tentativa de copia falhada',
   'MOD_CONFIG'               			=> 'Configuração do AutoMOD',
   'MOD_CONFIG_UPDATED'         		=> 'A Configuração do AutoMOD foi actualizada.',
   'MOD_DETAILS'               			=> 'Detalhes do MOD ',
   'MOD_DETAILS_EXPLAIN'         		=> 'Aqui pode visualizar todas as informações conhecidas sobre o MOD que seleccionou.',
   'MOD_MANAGER'               			=> 'AutoMOD',
   'MOD_NAME'                 			=> 'Nome do MOD',
   'MOD_OPEN_FILE_FAIL'         		=> 'O AutoMOD é incapaz de abrir %s.',
   'MOD_UPLOAD'               			=> 'Enviar Modificação',
   'MOD_UPLOAD_EXPLAIN'        			=> 'Aqui pode enviar um ficheiro comprimido, com uma modificação MODX para instalar no seu fórum. O AutoMOD tentará descomprimir o ficheiro e disponibilizar a modificação para instalação.',
   'MOD_UPLOAD_INIT_FAIL'        		=> 'Houve um erro ao iniciar o processo de upload do MOD',
   'MOD_UPLOAD_SUCCESS'         		=> 'MOD carregado e pronto para instalação.',
   'AUTOMOD_INSTALLATION'         		=> 'Instalação do AutoMOD',
   'AUTOMOD_INSTALLATION_EXPLAIN'   	=> 'Bem vindo à instalação do AutoMOD. Se o AutoMOD detectar que é a melhor forma para alterar os ficheiros, necessita de saber as configurações do seu FTP. Os requisitos dos resultados dos testes estão abaixo.',

   'MODS_CONFIG_EXPLAIN'        	 	=> 'Aqui pode seleccionar como o AutoMOD modifica os seus ficheiros. <br />O método mais simples é a "Transferência do Ficheiro Comprimido". Outros métodos requerem permissões adicionais no servidor.',
   'MODS_COPY_FAILURE'           		=> 'O ficheiro %s não copiado para o local. Por favor, verifique as permissões ou use um método alternativo de Escritura.',
   'MODS_EXPLAIN'              			=> 'Aqui pode gerir as Modificações disponíveis no seu fórum. As Modificações permitem-lhe personalizar automaticamente o seu fórum, instalando modificações criadas pela comunidade phpBB. Para mais informações sobre MODs e AutoMOD visite o site <a href="http://phpbbportugal.com" target="_blank">phpBB Portugal</a> ou <a href="http://www.phpbb.com/mods" target="_blank">phpBB.com</a>. Para adicionar MODs à sua lista, descompacte-os e faça upload para o directório <strong>/store/mods/</strong> no seu servidor.',
   'MODS_FTP_FAILURE'            		=> 'O AutoMOD não transferiu o ficheiro por FTP',
   'MODS_FTP_CONNECT_FAILURE'     		=> 'O AutoMOD é incapaz de se conectar ao servidor FTP. O erro foi %s',
   'MODS_MKDIR_FAILED'            		=> 'A directória %s não foi criada',
   'MODS_SETUP_INCOMPLETE'        		=> 'Foi encontrado um problema na configuração e o AutoMOD não funcionou. Isso só deve ocorrer quando as configurações (ex. FTP username) foram alteradas e pode ser corrigido na página de configurações do AutoMOD.',

   'NAME'                    			=> 'Nome',
   'NEW_FILES'                  		=> 'Novos Ficheiros',
   'NO_ATTEMPT'               			=> 'Falhado',
   'NO_INSTALLED_MODS'           		=> 'Não há Modificações instaladas',
   'NO_MOD'                 			=> 'O MOD selecionado não foi encontrado.',
   'NO_UNINSTALLED_MODS'         		=> 'Não há Modificações desinstaladas',
   'NO_UPLOAD_FILE'            			=> 'Nenhum ficheiro especificado.',   

   'ORIGINAL'                  			=> 'Original',

   'PATH'                     			=> 'Atalho',
   'PREVIEW_CHANGES'            		=> 'Prever Alterações',
   'PREVIEW_CHANGES_EXPLAIN'      		=> 'Mostra as alterações a realizar antes de serem executadas.',
   'PRE_INSTALL'               			=> 'Preparar para Instalar',
   'PRE_INSTALL_EXPLAIN'         		=> 'Aqui pode visualizar todas as alterações a serem realizadas no seu fórum antes de serem executadas. <strong>AVISO!</strong>, uma vez aceite, os ficheiros-base do phpBB poderão ser editados assim como poderão ocorrer alterações na Base de Dados. No entanto, se a instalação não tiver êxito, supondo que pode acessar AutoMOD, ser-lhe-á dada a opção para restaurar este ponto.',
   'PRE_UNINSTALL'               		=> 'Preparar para Desinstalar',
   'PRE_UNINSTALL_EXPLAIN'         		=> 'Aqui pode visualizar todas as alterações a serem desinstaladas no seu fóum antes de serem executadas. <strong>AVISO!</strong>, uma vez aceite, os ficheiros-base do phpBB poderão ser editados assim como poderão ocorrer alterações na Base de Dados. Além disso, este processo usa técnicas de inversão que podem não ser 100% eficazes. No entanto, se a instalação não tiver êxito, supondo que pode acessar AutoMOD, ser-lhe-á dada a opção para restaurar este ponto.',

   'REMOVING_FILES'           			=> 'Ficheiros a serem removidos',
   'RETRY'                     			=> 'Tentar novamente',
   'RETURN_MODS'               			=> 'Voltar ao AutoMOD',
   'REVERSE'                  			=> 'Inverter',
   'ROOT_IS_READABLE'            		=> 'O directório /root do phpBB foi encontrado.',
   'ROOT_NOT_READABLE'           		=> 'O AutoMOD é incapaz de abrir o ficheiro index.php do phpBB para ser lido. Isto provavelmente significa que as permissões do seu diretório raiz são demasiado restritivas, o que impedirá o AutoMOD de funcionar. Por favor, ajuste as permissões e tente novamente.',


   'SOURCE'                  			=> 'Origem',
   'SQL_QUERIES'               			=> 'SQL Queries',
   'STATUS'                  			=> 'Estado',
   'STORE_IS_WRITABLE'            		=> 'O directório /store pode ser Escrito.',
   'STORE_NOT_WRITABLE_INST'      		=> 'O AutoMOD detectou que o directório /store não pode ser Escrito. Isto é requerido para que o AutoMOD funcione correctamente. Por favor, ajuste as permissões e tente novamente.',
   'STORE_NOT_WRITABLE'         		=> 'O directório /store não pode ser Escrito.',
   'STYLE_NAME'              			=> 'Nome do Estilo',
   'SUCCESS'                  			=> 'Êxito',

   'TARGET'                  			=> 'Alvo',

   'UNKNOWN_MOD_AUTHOR-NOTES'      		=> 'Nenhuma nota do Autor foi especificada.',
   'UNKNOWN_MOD_DESCRIPTION'      		=> '',
   'UNKNOWN_MOD_DIY-INSTRUCTIONS'  		=> '', // empty string hides this if not specified.
   'UNKNOWN_MOD_COMMENT'         		=> '',
   'UNKNOWN_MOD_INLINE-COMMENT'  		=> '',
   'UNKNOWN_QUERY_REVERSE'       		=> 'Unknown reverse query',

   'UNINSTALL'                  		=> 'Desinstalar',
   'UNINSTALL_AUTOMOD'            		=> 'Desinstalação do AutoMOD',
   'UNINSTALL_AUTOMOD_CONFIRM'    		=> 'Tem a certeza que deseja desinstalar o AutoMOD? Não removerá qualquer modificação instalada com o AutoMOD.',
   'UNINSTALLED'              			=> 'MOD desinstalado',
   'UNINSTALLED_MODS'            		=> 'Modificações Desinstaladas',
   'UNINSTALLED_EXPLAIN'         		=> 'O seu MOD foi desinstalado! Aqui pode ver alguns resultados da desinstalação. Por favor, anote quaisquer erros e reporte-os em <a href="http://phpbbportugal.com/forum/portal.php">phpBB Portugal</a> e/ou <a href="http://phpbb.com">phpBB.com</a>.',
   'UNRECOGNISED_COMMAND'				=> 'Erro, comando não reconhecido %s',
   'UPDATE_AUTOMOD'            			=> 'Actualizar AutoMOD',
   'UPDATE_AUTOMOD_CONFIRM'      		=> 'Por favor, confirme que quer actualizar o AutoMOD.',

   'UPLOAD'                  			=> 'Upload',
   'VERSION'                  			=> 'Versão',

   'WRITE_DIRECT_FAIL'            		=> 'O AutoMOD não copiou o ficheiro %s usando o método directo. Por favor, defina outro método e tente novamente.',
   'WRITE_DIRECT_TOO_SHORT'      		=> 'O AutoMOD é incapaz de gravar o ficheiro %s. Isto pode ser resolvido clicando no botão Actualizar. Se não funcionar, defina outro método e tente novamente.',
   'WRITE_MANUAL_FAIL'            		=> 'O AutoMOD é incapaz de adicionar o ficheiro %s num ficheiro comprimido. Por favor, tente outro método de modificação.',
   'WRITE_METHOD'               		=> 'Método de Modificação',
   'WRITE_METHOD_DIRECT'         		=> 'Directo',
   'WRITE_METHOD_EXPLAIN'         		=> 'Pode definir um método para alterar os ficheiros. A opção mais simples é a "Transferência do Ficheiro Comprimido".',
   'WRITE_METHOD_FTP'            		=> 'FTP',
   'WRITE_METHOD_MANUAL'        		=> 'Transferência do Ficheiro Comprimido',

   // These keys for action names are purposely lower-cased and purposely contain spaces
   'after add'                  		=> 'Adicionar Depois',
   'before add'               			=> 'Adicionar Antes',
   'find'                     			=> 'Procurar',
   'in-line-after-add'            		=> 'Adicionar Depois, na linha',
   'in-line-before-add'         		=> 'Adicionar Antes, na linha',
   'in-line-edit'               		=> 'Procura na linha',
   'in-line-operation'            		=> 'Aumento na linha',
   'in-line-replace'            		=> 'Substituir na linha',
   'in-line-replace-with'         		=> 'Substituir na linha com',
   'replace'                  			=> 'Substituir',
   'replace with'               		=> 'Substituir com',
   'operation'                  		=> 'Aumento',
));

?>