<?php
/** 
*
* acp_mods [Italian]
*
* @package language
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @copyright (c) 2010 phpBB.it - translated on 2010/06/21
* @copyright (c) 2011 portalxl.eu - upgrade translation on 2011/04/15
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
	'ADDITIONAL_CHANGES'	=> 'Modifiche disponibili',

	'AM_MOD_ALREADY_INSTALLED'	=> 'AutoMOD ha rilevato che questa MOD è già installata e non può procedere.',
	'AM_MANUAL_INSTRUCTIONS'	=> 'AutoMOD invia un file compresso al tuo computer. A causa della configurazione AutoMOD, i file non possono essere scritti sul tuo sito automaticamente. Sarà necessario estrarre l’archivio e caricare i file sul tuo server manualmente utilizzando un client FTP. Se non hai ricevuto questo file automaticamente fai clic %squi%s.',

	'APPLY_THESE_CHANGES'	=> 'Applica queste modifiche',
	'APPLY_TEMPLATESET'		=> 'a questo template',
	'AUTHOR_EMAIL'			=> 'E-mail autore',
	'AUTHOR_INFORMATION'	=> 'Informazioni autore',
	'AUTHOR_NAME'			=> 'Nome autore',
	'AUTHOR_NOTES'			=> 'Note autore',
	'AUTHOR_URL'			=> 'URL autore',
	'AUTOMOD'				=> 'AutoMOD',
	'AUTOMOD_CANNOT_INSTALL_OLD_VERSION'	=> 'La versione di AutoMOD che stai tentando di installare è già installata.  Per cortesia cancella questa cartella install/ .',
	'AUTOMOD_UNKNOWN_VERSION'	=>	'AutoMOD non è riuscito ad aggiornare perché non riesce a determinare la versione attualmente installata. La versione indicata per la tua installazione è %s.',
	'AUTOMOD_VERSION'		=> 'Versione AutoMOD',
	
	'CAT_INSTALL_AUTOMOD'	=> 'AutoMOD',
	'CHANGE_DATE'	=> 'Data rilascio',
	'CHANGE_VERSION'=> 'Numero versione',
	'CHANGES'		=> 'Modifiche',
	'CHECK_AGAIN'   => 'Verifica di nuovo',
	'CLICK_HIDE_FILES' => 'Clicca per nascondere i file senza errori',
	'CLICK_HIDE_EDITS' => 'Clicca per nascondere le modifiche senza errori',
	'CLICK_SHOW_FILES' => 'Clicca per visualizzare tutti i file',
	'CLICK_SHOW_EDITS' => 'Clicca per visualizzare tutte le modifiche',	
	'COMMENT'		=> 'Commento',
	'CREATE_TABLE'	=> 'Modifiche del database',
	'CREATE_TABLE_EXPLAIN'	=> 'AutoMOD è riuscito a terminare le modifiche del database, incluso un permesso che è stato assegnato al ruolo “Amministratore globale”.',
	'DELETE'			=> 'Cancella',
	'DELETE_CONFIRM'	=> 'Sei sicuro di voler cancellare questa MOD?',
	'DELETE_ERROR'		=> 'E’ stato trovato un errore durante la cancellazione della MOD selezionata.',
	'DELETE_SUCCESS'	=> 'La MOD è stata correttamente cancellata.',
	
	'DIR_PERMS'			=> 'Permessi cartella',
	'DIR_PERMS_EXPLAIN'	=> 'Alcuni sistemi richiedono che le cartelle abbiano certi permessi per funzionare correttamente.  Normalmente il valore di default 0755 è corretto.  Questa impostazione non ha effetto su sistemi Windows.',
	'DIY_INSTRUCTIONS'	=> 'Istruzioni Fai-da-te',
	'DEPENDENCY_INSTRUCTIONS'	=>	'La MOD che stai cercando di installare è subordinata a un’altra MOD.  AutoMOD non riesce a verificare se questa MOD è stata installata.  Per cortesia controlla di aver installato <strong><a href="%1$s">%2$s</a></strong> prima di installare questa MOD.',
	'DESCRIPTION'	=> 'Descrizione',
	'DETAILS'		=> 'Dettagli',

	'EDITED_ROOT_CREATE_FAIL'	=> 'AutoMOD non è riuscito a creare la cartella dove memorizzare i file modificati.',
	'ERROR'			=> 'Errore',

	'FILE_EDITS'		=> 'Modifiche file',
	'FILE_EMPTY'		=> 'File vuoto',
	'FILE_MISSING'		=> 'File non trovato',
	'FILE_PERMS'		=> 'Permessi file',
	'FILE_PERMS_EXPLAIN'=> 'Alcuni sistemi richiedono che i file abbiano certi permessi per funzionare correttamente.  Normalmente il valore di default 0644 è corretto.  Questa impostazione non ha effetto su sistemi Windows.',
	'FILE_TYPE'			=> 'Tipo file compresso',
	'FILE_TYPE_EXPLAIN'	=> 'Azione valida solo con il metodo di scrittura "Scarica file compresso"',
	'FILESYSTEM_NOT_WRITABLE'	=> 'AutoMOD ha determinato che il filesystem non è scrivibile, quindi il metodo di scrittura diretta non è utilizzabile.',
	'FIND'				=> 'Trova',
	'FIND_MISSING'		=> 'Il "Trova" specificato dalla MOD non è stato trovato',
	'FORCE_INSTALL'		=> 'Installazione forzata',
	'FORCE_UNINSTALL'	=> 'Disinstallazione forzata',
	'FORCE_CONFIRM'		=> 'La caratteristica "Installazione forzata" indica che la MOD non è completamente installata. Dovrai effettuare delle modifiche manuali al forum per terminare l’installazione. 
Continuare?',
	'FTP_INFORMATION'	=> 'Informazioni FTP',
	'FTP_NOT_USABLE'  => 'La funzione FTP non può essere utilizzata in quanto disabilitata dal tuo hosting.',
	'FTP_METHOD_ERROR' => 'Nessun metodo FTP trovato. Per cortesia controlla sotto configurazione AutoMOD se è stato impostato un metodo FTP corretto.',
	'FTP_METHOD_EXPLAIN'=> 'Se si verificano problemi con l’impostazione predefinita "FTP", puoi provare la "porta semplice" come un modo alternativo per la connessione al server FTP.',
	'FTP_METHOD_FTP'	=> 'FTP',
	'FTP_METHOD_FSOCK'	=> 'Porta semplice',
	
	'GO_PHP_INSTALLER'  => 'La MOD richiede un installer esterno per terminare l’installazione.  Clicca quì per continuare al prossimo step.',

	'INHERIT_NO_CHANGE'	=> 'Nessuna modifica possibile a questo file perché il template %1$s è subordinato a %2$s.',
	'INLINE_FIND_MISSING'=> 'La ricerca nella stessa riga specificata dalla MOD non è stata trovata.',
	'INLINE_EDIT_ERROR'	=> 'Errore, una modifica è necessaria nel MODX xml di installazione',
	'INSTALL_AUTOMOD'	=> 'Installazione AutoMOD',
	'INSTALL_AUTOMOD_CONFIRM'	=> 'Sei sicuro di voler installare AutoMOD?',	
	'INSTALL_TIME'		=> 'Tempo di installazione',
	'INSTALL_MOD'		=> 'Installa questa MOD',
	'INSTALL_ERROR'		=> 'Una o più azioni di installazione sono fallite. Controlla le azioni elencate di seguito, apporta le necessarie modifiche e riprova. E’ possibile continuare l’installazione anche se qualche azione fallisce. <strong>Questo, però, non è consigliato ed il forum potrebbe non funzionare correttamente.</strong>',
	'INSTALL_FORCED'	=> 'Hai forzato l’installazione di questa MOD sebbene fossero stati segnalati alcuni errori di installazione. Il forum potrebbe non funzionare. Controlla le azioni fallite elencate di seguito ed apporta le necessarie correzioni.',
	'INSTALLED'			=> 'MOD installata',
	'INSTALLED_EXPLAIN'	=> 'La MOD è stata installata! Qui puoi vedere alcuni risultati di questa installazione. Prendi nota di eventuali errori e cerca aiuto e soluzioni su <a href="http://www.phpbb.com">phpBB.com</a>',
	'INSTALLED_MODS'	=> 'MOD installate',
	'INSTALLATION_SUCCESSFUL'	=> 'AutoMOD installata correttamente. Ora puoi gestire le MODifiche phpBB tramite il tab AutoMOD nel Pannello di Controllo Amministratore.',
	'INVALID_MOD_INSTRUCTION'	=> 'Questa MOD contiene un’istruzione non valida, oppure un’operazione di "trova nella stessa riga" è fallita.',
	'INVALID_MOD_NO_FIND'       => 'La MOD manca di unis missing a find matching the action ‘%s’',
	'INVALID_MOD_NO_ACTION'     => 'The MOD is missing an action matching the find ‘%s’',

	'LANGUAGE_NAME'		=> 'Lingua',

	'MANUAL_COPY'				=> 'Copia non riuscita',
	'MOD_CONFIG'				=> 'Configurazione AutoMOD',
	'MOD_CONFIG_UPDATED'        => 'La configurazione di AutoMOD è stata aggiornata.',
	'MOD_DETAILS'				=> 'Dettagli MOD',
	'MOD_DETAILS_EXPLAIN'		=> 'Qui puoi trovare le informazioni sulla MOD che hai selezionato.',
	'MOD_MANAGER'				=> 'AutoMOD',
	'MOD_NAME'					=> 'Nome della MOD',
	'MOD_OPEN_FILE_FAIL'		=> 'AutoMOD non riesce ad aprire %s.',
	'MOD_UPLOAD'				=> 'Carica MOD',
	'MOD_UPLOAD_EXPLAIN'		=> 'Qui è possibile caricare un pacchetto compresso contenente i file necessari per eseguire l’installazione della MOD. AutoMOD quindi tenterà di decomprimere il file e averlo pronto per l’installazione.',
	'MOD_UPLOAD_INIT_FAIL'		=> 'Risultano alcuni errori di inizializzazione durante il processo di caricamento della MOD.',
	'MOD_UPLOAD_SUCCESS'		=> 'MOD caricata e pronta per l’installazione.',
	'MOD_UPLOAD_UNRECOGNIZED'	=> 'La struttura della directory relativa alla MOD caricata non è stata riconosciuto. Controlla che l’archivio zip che hai caricato non sia danneggiato o mancante di qualsiasi file, in alternativa contatta l’autore della MOD.',	
	'AUTOMOD_INSTALLATION'		=> 'Installazione AutoMOD',
	'AUTOMOD_INSTALLATION_EXPLAIN'	=> 'Benvenuto nell’installazione di AutoMOD. Avrai bisogno dei tuoi dettagli FTP se AutoMOD rilevasse questo metodo come il migliore per la scrittura dei file.  I risultati del test sono riportati di seguito.',

	'MODS_CONFIG_EXPLAIN'		=> 'Puoi scegliere come AutoMOD elabora i file. Il metodo di base è "Scarica file compresso". Gli altri richiedono permessi addizionali sul tuo server.',
	'MODS_COPY_FAILURE'			=> 'Il file %s non può essere copiato. Controlla i tuoi permessi oppure scegli un altro metodo di scrittura.',
	'MODS_EXPLAIN'				=> 'Qui puoi gestire le MOD disponibili nel forum. Le MOD ti permettono di personalizzare il forum installando automaticamente le modifiche prodotte dalla community phpBB. Per ulteriori informazioni su MOD e AutoMOD visita il <a href="http://www.phpbb.com/mods">sito phpBB</a>. Per aggiungere una MOD a questa lista, decomprimila e carica i file nella cartella /store/mods/ nel tuo server.',
	'MODS_FTP_FAILURE'			=> 'AutoMOD non riesce a caricare via FTP il file %s.',
	'MODS_FTP_CONNECT_FAILURE'	=> 'AutoMOD non riesce a connettersi al tuo server FTP. L’errore è %s',
	'MODS_MKDIR_FAILED'			=> 'La cartella %s non può essere creata',
	'MODS_RMDIR_FAILURE'		=> 'La directory %s non può essere eliminata',
	'MODS_RMFILE_FAILURE'		=> 'Il file %s non può essere eliminato',
	'MODS_NOT_WRITABLE'			=> 'La directory store/mods/ non è scrivibile.  Affinchè il "Caricamento della MOD" funzioni correttamente è necessario che la directory sia scrivibile, per fare questo devi impostare il "metodo di scrittura" tramite "FTP". Prova ad impostare i corretti permessi di scrittura alla directory store/mods/ e riprova.',
	'MODS_SETUP_INCOMPLETE'		=> 'È stato rilevato un problema nella tua configurazione e AutoMOD non può operare. Questo può accadere quando sono state cambiate le opzioni (per esempio, il nome dell’utente FTP) che possono essere corrette nella pagina di configurazione di AutoMOD.',

	'NAME'			=> 'Nome',
	'NEW_FILES'		=> 'Nuovi file',
	'NEED_READ_PERMISSIONS' => 'Permessi non corretti: %s non è leggibile.',	
	'NO_ATTEMPT'	=> 'Nessun tentativo',
	'NO_INSTALLED_MODS'		=> 'Non sono state rilevate MOD installate',
	'NO_MOD'				=> 'La MOD selezionata non è stata trovata.',
	'NO_UNINSTALLED_MODS'	=> 'Non sono state rilevate MOD disinstallate',	
	'NO_UPLOAD_FILE'		=> 'Nessun file specificato.',

	'ORIGINAL'	=> 'Originale',

	'PATH'					=> 'Percorso',
	'PREVIEW_CHANGES'		=> 'Anteprima modifiche',
	'PREVIEW_CHANGES_EXPLAIN'	=> 'Mostra le modifiche da apportare prima dell’esecuzione.',
	'PRE_INSTALL'			=> 'Preparazione dell’installazione',
	'PRE_INSTALL_EXPLAIN'	=> 'Qui puoi vedere in anteprima le modifiche da apportare al forum, prima che esse vengano effettuate. <strong>ATTENZIONE!</strong>, una volta accettate le modifiche, i file phpBB ed il database verranno modificati. Tuttavia, se l’installazione fallisse, avendo la possibilità di accedere ad AutoMOD, potrai utilizzare l’opzione di ripristino delle condizioni esistenti attualmente.',
	'PRE_UNINSTALL'			=> 'Preparazione della disinstallazione',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Qui puoi vedere in anteprima le modifiche da apportare al forum per disinstallare la MOD. <strong>ATTENZIONE!</strong>, una volta accettate le modifiche, i file phpBB ed il database verranno modificati. Anche questo processo utilizza una tecnica di reversing che tuttavia non può essere accurata al 100%. Tuttavia, se la disinstallazione fallisse, avendo la possibilità di accedere ad AutoMOD, potrai utilizzare l’opzione di ripristino delle condizioni esistenti attualmente.',

	'REMOVING_FILES'	=> 'File da eliminare',
	'RETRY'				=> 'Riprova',
	'RETURN_MODS'		=> 'Ritorna ad AutoMOD',
	'REVERSE'			=> 'Annulla',
	'ROOT_IS_READABLE'	=> 'La root di phpBB è leggibile.',
	'ROOT_NOT_READABLE'	=> 'AutoMOD non riesce ad aprire il file index.php di phpBB per leggerlo. Questo può dipendere dal fatto che i permessi della root di phpBB sono restrittivi ed impediscono ad AutoMOD di operare. Configura i permessi e riprova.',


	'SOURCE'		=> 'Sorgente',
	'SQL_QUERIES'	=> 'Query SQL',
	'STATUS'		=> 'Stato',
	'STORE_IS_WRITABLE'			=> 'La cartella store/ è scrivibile.',
	'STORE_NOT_WRITABLE_INST'	=> 'L’installazione di AutoMOD ha rilevato che la cartella store/ non è scrivibile.  AutoMOD necessita questa modifica per funzionare correttamente.  Per cortesia modifica i permessi cartella e riprova.',
	'STORE_NOT_WRITABLE'		=> 'La cartella store/ NON è scrivibile.',
	'STYLE_NAME'	=> 'Nome stile',
	'SUCCESS'		=> 'Riuscito',

	'TARGET'		=> 'Destinazione',

	'UNKNOWN_MOD_AUTHOR-NOTES'	=> 'Nessuna Nota autore specificata.',
	'UNKNOWN_MOD_DESCRIPTION'	=> '',
	'UNKNOWN_MOD_DIY-INSTRUCTIONS'=>'', // empty string hides this if not specified.
	'UNKNOWN_MOD_COMMENT'		=> '',
	'UNKNOWN_MOD_INLINE-COMMENT'=> '',
	'UNKNOWN_QUERY_REVERSE' => 'Query di reverse sconosciuta',

	'UNINSTALL'				=> 'Disinstalla',
	'UNINSTALL_AUTOMOD'		=> 'Disinstallazione AutoMOD',
	'UNINSTALL_AUTOMOD_CONFIRM' => 'Sei sicuro di voler procedere alla disinstallazione di AutoMOD? Ciò non eliminerà le MOD che sono state installate con AutoMOD.',
	'UNINSTALLED'			=> 'MOD disinstallata',
	'UNINSTALLED_MODS'		=> 'MOD disinstallate',
	'UNINSTALLED_EXPLAIN'	=> 'La MOD è stata disinstallata! Qui puoi vedere alcuni risultati di questa disinstallazione. Prendi nota di eventuali errori e cerca aiuto e soluzioni su <a href="http://www.phpbb.com">phpBB.com</a>.',
	'UNRECOGNISED_COMMAND'	=> 'Errore, comando %s non riconosciuto',
	'UPDATE_AUTOMOD'		=> 'Aggiorna AutoMOD',
	'UPDATE_AUTOMOD_CONFIRM'=> 'Per cortesia conferma di voler aggiornare AutoMOD.',

	'UPLOAD'		=> 'Carica',
	'VERSION'		=> 'Versione',

	'WRITE_DIRECT_FAIL'		=> 'AutoMOD non può copiare il file %s utilizzando il metodo di scrittura diretto. Utilizza un altro metodo di scrittura e riprova.',
	'WRITE_DIRECT_TOO_SHORT'=> 'AutoMOD non può finire di scrivere il file %s. Questo problema in genere si risolve premendo il pulsante "Riprova". Se non funziona, prova un altro metodo di scritttura.',
	'WRITE_MANUAL_FAIL'		=> 'AutoMOD non può aggiungere il file %s ad un archivio compresso. Provare un altro metodo di scrittura.',
	'WRITE_METHOD'			=> 'Metodo di scrittura',
	'WRITE_METHOD_DIRECT'	=> 'Diretto',
	'WRITE_METHOD_EXPLAIN'	=> 'Scegliere il metodo preferito di scrittura file. L’opzione più compatibile è “Scarica file compresso”.',
	'WRITE_METHOD_FTP'		=> 'FTP',
	'WRITE_METHOD_MANUAL'	=> 'Scarica file compresso',

	// These keys for action names are purposely lower-cased and purposely contain spaces
	'after add'				=> 'Aggiungi dopo',
	'before add'			=> 'Aggiungi prima',
	'find'					=> 'Trova',
	'in-line-after-add'		=> 'Nella stessa riga, dopo, aggiungi',
	'in-line-before-add'	=> 'Nella stessa riga, prima, aggiungi',
	'in-line-edit'			=> 'Nella stessa riga trova',
	'in-line-operation'		=> 'Nella stessa riga incrementa',
	'in-line-replace'		=> 'Nella stessa riga sostituisci',
	'in-line-replace-with'	=> 'Nella stessa riga sostituisci',
	'replace'				=> 'Sostituisci con',
	'replace with'			=> 'Sostituisci con',
	'operation'				=> 'Incrementa',
));

?>