<?php
/**
*
* acp_mods [Brazilian Portuguese]
*
* @package language
* @version $Id$
* @copyright (c) 2010 Suporte phpBB < http://www.suportephpbb.com.br >
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* Original copyright (c) 2008 phpBB Group
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
	'ADDITIONAL_CHANGES'	=> 'Alterações disponíveis',
	
	'AM_MOD_ALREADY_INSTALLED'	=> 'O AutoMOD detectou que esta MOD já encontra-se instalada, não sendo possível proceder com esta operação.',
	'AM_MANUAL_INSTRUCTIONS'	=> 'AutoMOD está enviando um arquivo compactado para o seu computador.  Porque para a configuração do AutoMOD, os arquivos não podem serem escritos automaticamente em seu site.  Você deve extrair e enviar os arquivos para seu servidor manualmente, Usando um programa FTP ou um método similar.  Se você não receber este arquivo automaticamente, clique %saqui%s.',
	
	'APPLY_THESE_CHANGES'	=> 'Aplicar estas alterações',
	'APPLY_TEMPLATESET'		=> 'para este template',
	'AUTHOR_EMAIL'			=> 'E-mail do autor',
	'AUTHOR_INFORMATION'	=> 'Informações do autor',
	'AUTHOR_NAME'			=> 'Nome do autor',
	'AUTHOR_NOTES'			=> 'Notas do autor',
	'AUTHOR_URL'			=> 'Website',
	'AUTOMOD'				=> 'AutoMOD',
	'AUTOMOD_CANNOT_INSTALL_OLD_VERSION'	=> 'A versão do AutoMOD que você deseja instalar já encontra-se instalada.  Por favor, delete o diretório install/.',
	'AUTOMOD_UNKNOWN_VERSION'	=>	'O AutoMOD não pode ser atualizado porque não foi possível determinar a versão atualmente instalada.',
	'AUTOMOD_VERSION'		=> 'Versão do AutoMOD',

	'CAT_INSTALL_AUTOMOD'	=> 'AutoMOD',
	'CHANGE_DATE'	=> 'Data de lançamento',
	'CHANGE_VERSION'=> 'Versão',
	'CHANGES'		=> 'Alterações',
	'CHECK_AGAIN'  => 'Checar novamente',
	'COMMENT'		=> 'Comentário',
	'CREATE_TABLE'	=> 'Alterações do banco de dados',
	'CREATE_TABLE_EXPLAIN'	=> 'O AutoMOD realizou as devidas alterações no banco de dados com sucesso, incluindo uma permissão que foi assinalada para a tarefa “Administrador Completo”.',
	'DELETE'			=> 'Deletar',
	'DELETE_CONFIRM'	=> 'Você tem certeza que deseja deletar essa MOD?',
	'DELETE_ERROR'		=> 'Um erro ocorreu ao tentar deletar a MOD selecionada.',
	'DELETE_SUCCESS'	=> 'A MOD foi deletada com sucesso.',

	'DIR_PERMS'			=> 'Permissões do diretório',
	'DIR_PERMS_EXPLAIN'	=> 'Alguns sistemas requerem que determinados diretórios tenham permissões específicas para funcionarem apropriadamente.  Normalmente, o valor padrão 0755 é o correto.  Esta configuração não possui impactos no sistema operacional Windows.',
	'DIY_INSTRUCTIONS'	=> 'Instruções manuais',
	'DEPENDENCY_INSTRUCTIONS'	=>	'A MOD que você deseja instalar depende de outra MOD.  O AutoMOD não pode detectar caso esta MOD tenha sido instalada.  Por favor, certifique-se de ter instalado <strong><a href="%1$s">%2$s</a></strong> antes de prosseguir com a instalação da MOD.',
	'DESCRIPTION'	=> 'Descrição',
	'DETAILS'		=> 'Informações',

	'EDITED_ROOT_CREATE_FAIL'	=> 'O AutoMOD não pôde criar o diretório onde os arquivos editados serão armazenados.',
	'ERROR'			=> 'Erro',

	'FILE_EDITS'		=> 'Edições do arquivo',
	'FILE_EMPTY'		=> 'Arquivo em branco',
	'FILE_MISSING'		=> 'Erro ao localizar o arquivo',
	'FILE_PERMS'		=> 'Permissões do arquivo',
	'FILE_PERMS_EXPLAIN'=> 'Alguns sistemas requerem que determinados arquivos tenham permissões específicas para funcionarem apropriadamente.  Normalmente, o valor padrão 0644 é o correto.  Esta configuração não possui impactos no sistema operacional Windows.',
	'FILE_TYPE'			=> 'Tipo de compressão',
	'FILE_TYPE_EXPLAIN'	=> 'Esta configuração somente é válida junto ao método “Baixar arquivo compresso” ativo.',
	'FILESYSTEM_NOT_WRITABLE'	=> 'O AutoMOD determinou que o sistema de arquivos não pode ser escrito, então o método direto de escrita não pode ser utilizado.',
	'FIND'				=> 'Procurar',
	'FIND_MISSING'		=> 'A pesquisa especificada pela MOD não pôde ser encontrada.',
	'FORCE_INSTALL'		=> 'Forçar instalação',
	'FORCE_UNINSTALL'	=> 'Forçar desinstalação',
	'FORCE_CONFIRM'		=> 'A ferramenta em questão significa que a MOD não está completamente instalada.  Você deverá realizar algumas correções manuais em seu painel para concluir a instalação.  Continuar?',
	'FTP_INFORMATION'	=> 'Informação de FTP',
	'FTP_NOT_USABLE'    => 'A função FTP não pode ser utilizada já que foi desativada pelo seu servidor.',
	'FTP_METHOD_ERROR'  => 'Nenhum método de FTP foi encontrado. Por favor, cheque a configuração do autoMOD caso exista uma informação de FTP incorreta.',	
	'FTP_METHOD_EXPLAIN'=> 'Se você tiver problemas com o "FTP" padrão , você pode tentar o "Socket simples" como uma alternativa de se conectar ao servidor FTP.',
	'FTP_METHOD_FTP'	=> 'FTP',
	'FTP_METHOD_FSOCK'	=> 'Socket simples',

	'GO_PHP_INSTALLER'  => 'A MOD requer um instalador externo para concluir a instalação. Clique aqui para continuar essa etapa.',

	'INHERIT_NO_CHANGE'	 => 'Nenhuma modificação foi realizada neste arquivo porque o template %1$s depende de %2$s.',
	'INLINE_FIND_MISSING'=> 'A pesquisa linear especificada pela MOD não pôde ser encontrada.',
	'INLINE_EDIT_ERROR'	=> 'Erro, uma edição na linha no install do MODX está faltando alguns elementos necessários',
	'INSTALL_AUTOMOD'	=> 'Instalação do AutoMOD',
	'INSTALL_AUTOMOD_CONFIRM'	=> 'Você tem certeza que quer instalar o AutoMOD?',
	'INSTALL_TIME'		=> 'Tempo de instalação',
	'INSTALL_MOD'		=> 'Instalar esta MOD',
	'INSTALL_ERROR'		=> 'Um ou mais passos da instalação falharam. Por favor, revise as ações abaixo, faça quaisquer ajustes e tente novamente. Você pode continuar com a instalação mesmo que alguns passos tenham falhado. <strong>Isto não é recomendável e pode fazer com que o seu painel não funcione corretamente.</strong>',
	'INSTALL_FORCED'	=> 'Você forçou a instalação desta MOD mesmo na presença de erros durante a sua instalação. O seu painel pode estar com erros. Por favor, note os passos que falharam abaixo e corrija-os.',
	'INSTALLED'			=> 'MOD instalada',
	'INSTALLED_EXPLAIN'	=> 'A sua MOD foi instalada! Aqui você pode ver alguns dos resultados da instalação. Por favor, note quaisquer erros e solicite suporte através do <a href="http://www.phpbb.com">phpBB.com</a> ou do <a href="http://www.suportephpbb.org">Suporte phpBB</a>.',
	'INSTALLED_MODS'	=> 'MODs Instaladas',
	'INSTALLATION_SUCCESSFUL'	=> 'O AutoMOD foi instalado com sucesso.  Você pode agora gerenciar as MODificações do phpBB através da aba AutoMOD no painel de administração.',
	'INVALID_MOD_INSTRUCTION'	=> 'Esta MOD possui uma instrução inválida, ou alguma operação de pesquisa falhou.',
	'INVALID_MOD_NO_FIND'       => 'A MOD está faltando achar a ação ‘%s’',
	'INVALID_MOD_NO_ACTION'     => 'A MOD está faltando uma ação de busca ‘%s’',

	'LANGUAGE_NAME'		=> 'Nome do idioma',

	'MANUAL_COPY'				=> 'Cópia não solicitada',
	'MOD_CONFIG'				=> 'Configuração do AutoMOD',
	'MOD_CONFIG_UPDATED'        => 'A configuração do AutoMOD foi atualizada com sucesso.',
	'MOD_DETAILS'				=> 'Informações da MOD',
	'MOD_DETAILS_EXPLAIN'		=> 'Aqui você pode ver todas as informações disponíveis sobre a MOD selecionada.',
	'MOD_MANAGER'				=> 'AutoMOD',
	'MOD_NAME'					=> 'Nome da MOD',
	'MOD_OPEN_FILE_FAIL'		=> 'O AutoMOD não pôde abrir %s.',
	'MOD_UPLOAD'				=> 'Enviar MOD',
	'MOD_UPLOAD_EXPLAIN'		=> 'Aqui você pode enviar um pacote zipado com a MOD contendo os arquivos MODX necessários para a instalação.  AutoMOD tentará descompactar o arquivo e prepará-lo para a instalação.',
	'MOD_UPLOAD_INIT_FAIL'		=> 'Houve um erro ao inicializar o processo de envio da MOD.',
	'MOD_UPLOAD_SUCCESS'		=> 'MOD enviada e preparada para instalação.',
	'AUTOMOD_INSTALLATION'		=> 'Instalação do AutoMOD',
	'AUTOMOD_INSTALLATION_EXPLAIN'	=> 'Bem-vindo à instalação do AutoMOD.  Você precisará de suas informações de FTP caso o AutoMOD detecte ser a melhor maneira de escrever os arquivos.  Os resultados do teste de requerimentos encontram-se abaixo.',

	'MODS_CONFIG_EXPLAIN'		=> 'Aqui você pode selecionar como o AutoMOD ajustará os seus arquivos.  O método básico é o de download do arquivo compresso.  Os outros requerem permissões adicionais no servidor.',
	'MODS_COPY_FAILURE'			=> 'O arquivo %s não pôde ser copiado ao local correto.  Por favor, cheque suas permissões ou use um método alternativo.',
	'MODS_EXPLAIN'				=> 'Aqui você pode gerenciar as MODs disponíveis em seu painel. As MODs lhe permitem customizar os seus fóruns instalando automaticamente modificações criadas pela comunidade phpBB. Para mais informações sobre MODs e o AutoMOD, por favor, visite a página <a href="http://www.phpbb.com/mods">phpBB MODs</a>.  Para adicionar uma MOD a esta lista, descompresse os arquivos do pacote no diretório /store/mods/ no seu servidor.',
	'MODS_FTP_FAILURE'			=> 'O AutoMOD não pôde enviar o arquivo %s por FTP ao local correto',
	'MODS_FTP_CONNECT_FAILURE'	=> 'O AutoMOD não pôde se conectar ao seu servidor de FTP.  O erro ocorrido foi %s',
	'MODS_MKDIR_FAILED'			=> 'O diretório %s não pôde ser criado',
	'MODS_SETUP_INCOMPLETE'		=> 'Um problema foi encontrado em sua configuração, e o AutoMOD não pode operar.  Isto deveria ocorrer somente quando as configurações (ex. nome de usuário FTP) fossem alteradas, e pode ser corrigido na página de configuração do AutoMOD.',

	'NAME'			=> 'Nome',
	'NEW_FILES'		=> 'Novos arquivos',
	'NEED_READ_PERMISSIONS' => 'Permissões incorretas: %s não é legível.',
	'NO_ATTEMPT'	=> 'Não solicitado',
	'NO_INSTALLED_MODS'		=> 'Nenhuma MOD instalada foi detectada',
	'NO_MOD'				=> 'A MOD selecionada não pôde ser encontrada.',
	'NO_UNINSTALLED_MODS'	=> 'Nenhuma MOD desinstalada foi detectada',	
	'NO_UPLOAD_FILE'		=> 'Nenhum arquivo especificado.',

	'ORIGINAL'	=> 'Original',

	'PATH'					=> 'Diretório',
	'PREVIEW_CHANGES'		=> 'Prever Modificações',
	'PREVIEW_CHANGES_EXPLAIN'	=> 'Exibe as modificações a serem realizadas antes de executá-las.',
	'PRE_INSTALL'			=> 'Preparando-se para Instalar',
	'PRE_INSTALL_EXPLAIN'	=> 'Aqui você pode prever todas as modificações a serem feitas em seu painel antes que sejam realizadas. <strong>ATENÇÃO!</strong>: uma vez aceito, os arquivos básicos de seu phpBB serão editados e alterações no banco de dados podem ocorrer. Entretanto, caso a instalação não seja concluída com sucesso, assumindo o seu acesso ao AutoMOD, você terá a opção de retornar a este ponto.',
	'PRE_UNINSTALL'			=> 'Preparando-se para Desinstalar',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Aqui você pode prever todas as modificações a serem feitas em seu painel para a desinstalação da MOD. <strong>ATENÇÃO!</strong>: uma vez aceito, os arquivos básicos de seu phpBB serão editados e alterações no banco de dados podem ocorrer. Também, este processo usa técnicas reversíveis que podem não atingir 100% de precisão. Entretanto, caso a desinstalação não seja concluída com sucesso, assumindo o seu acesso ao AutoMOD, você terá a opção de retornar a este ponto.',

	'REMOVING_FILES'	=> 'Arquivos a serem removidos',
	'RETRY'				=> 'Tentar novamente',
	'RETURN_MODS'		=> 'Voltar ao AutoMOD',
	'REVERSE'			=> 'Reverter',
	'ROOT_IS_READABLE'	=> 'O diretório raiz do phpBB pode ser lido.',
	'ROOT_NOT_READABLE'	=> 'O AutoMOD não pôde abrir o phpBB\'s index.php para leitura.  Isto provavelmente se deve ao fato de as permissões relativas ao diretório raiz de seu phpBB estarem muito restritas, o que privará o AutoMOD de seu funcionamento correto.  Por favor, ajuste suas permissões e tente novamente.',


	'SOURCE'		=> 'Recurso',
	'SQL_QUERIES'	=> 'Entradas SQL',
	'STATUS'		=> 'Status',
	'STORE_IS_WRITABLE'			=> 'O diretório store/ pode ser lido.',
	'STORE_NOT_WRITABLE_INST'	=> 'A instalação do AutoMOD detectou que o diretório store/ não pode ser lido.  Isto é requerido para que o AutoMOD funcione corretamente.  Por favor, ajuste suas permissões e tente novamente.',
	'STORE_NOT_WRITABLE'		=> 'O diretório store/ não pode ser lido.',
	'STYLE_NAME'	=> 'Nome do estilo',
	'SUCCESS'		=> 'Sucesso',

	'TARGET'		=> 'Alvo',

	'UNKNOWN_MOD_AUTHOR-NOTES'	  => 'Nenhuma nota foi especificada pelo autor.',
	'UNKNOWN_MOD_DESCRIPTION'	  => '',
	'UNKNOWN_MOD_DIY-INSTRUCTIONS'=>'', // empty string hides this if not specified.
	'UNKNOWN_MOD_COMMENT'		  => '',
	'UNKNOWN_MOD_INLINE-COMMENT'  => '',
	'UNKNOWN_QUERY_REVERSE'       => 'Entrada reversível desconhecida',

	'UNINSTALL'				=> 'Desinstalar',
	'UNINSTALL_AUTOMOD'		=> 'Desinstalação do AutoMOD',
	'UNINSTALL_AUTOMOD_CONFIRM' => 'Você tem certeza que quer desinstalar o AutoMOD?  Isso não irá remover as MODs quando o AutoMOD for desinstalado.',
	'UNINSTALLED'			=> 'MOD desinstalada',
	'UNINSTALLED_MODS'		=> 'MODs Desinstaladas',
	'UNINSTALLED_EXPLAIN'	=> 'A sua MOD foi desinstalada! Aqui você pode ver alguns dos resultados da desinstalação. Por favor, note quaisquer erros e solicite suporte através do <a href="http://www.phpbb.com">phpBB.com</a> ou do <a href="http://www.suportephpbb.org">Suporte phpBB</a>.',
	'UNRECOGNISED_COMMAND'	=> 'Erro, comando não foi reconhecido %s',
	'UPDATE_AUTOMOD'		=> 'Atualizar AutoMOD',
	'UPDATE_AUTOMOD_CONFIRM'=> 'Por favor, confirme caso você deseje atualizar o AutoMOD.',

	'UPLOAD'				=> 'Enviar',
	'VERSION'		=> 'Versão',

	'WRITE_DIRECT_FAIL'		=> 'O AutoMOD não pôde copiar o arquivo %s ao local correto usando o método direto.  Por favor, use outro método de escrita e tente novamente.',
	'WRITE_DIRECT_TOO_SHORT'=> 'O AutoMOD não pôde concluir a escrita do arquivo %s.  Isto geralmente pode ser resolvido com o botão Tentar novamente.  Caso não funcione, tente outro método de escrita.',
	'WRITE_MANUAL_FAIL'		=> 'O AutoMOD não pôde adicionar o arquivo %s a um pacote compresso.  Por favor, tente outro método de escrita.',
	'WRITE_METHOD'			=> 'Método de escrita',
	'WRITE_METHOD_DIRECT'	=> 'Direto',
	'WRITE_METHOD_EXPLAIN'	=> 'Você pode selecionar o seu método preferido para escrever os arquivos.  A opção mais compatível é a “Baixar arquivo compresso”.',
	'WRITE_METHOD_FTP'		=> 'FTP',
	'WRITE_METHOD_MANUAL'	=> 'Baixar arquivo compresso',

	// These keys for action names are purposely lower-cased and purposely contain spaces
	'after add'				=> 'Depois, Adicionar',
	'before add'			=> 'Antes, Adicionar',
	'find'					=> 'Procurar',
	'in-line-after-add'		=> 'Depois da linha, Adicionar',
	'in-line-before-add'	=> 'Antes da linha, Adicionar',
	'in-line-edit'			=> 'Procurar na linha',
	'in-line-operation'		=> 'Incrementar na linha',
	'in-line-replace'		=> 'Substituir na linha',
	'in-line-replace-with'	=> 'Substituir na linha',
	'replace'				=> 'Substituir por',
	'replace with'			=> 'Substituir por',
	'operation'				=> 'Incrementar',
));

?>