<?php
/**
 * This file is part of French (Casual Honorifics) UMIL translation.
 * Copyright (C) 2010 Maël Soucaze
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @package   umil
 * @author    Maël Soucaze <maelsoucaze@gmail.com> http://mael.soucaze.com/
 * @author    EXreaction <N/A> (Nathan Guse) http://lithiumstudios.org
 * @author    Highway of Life <highwayoflife@gmail.com> (David Lewis) N/A
 * @copyright (c) 2008 phpBB Group
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @version   $Id: umil.php 228 2010-06-29 19:43:25Z SyntaxError90 $
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACTION'						=> 'Action',
	'ADVANCED'						=> 'Avancé',
	'AUTH_CACHE_PURGE'				=> 'Purgation du cache d’authentification',

	'CACHE_PURGE'					=> 'Purgation du cache de ton forum',
	'CONFIGURE'						=> 'Configurer',
	'CONFIG_ADD'					=> 'Ajout d’une nouvelle variable de configuration : %s',
	'CONFIG_ALREADY_EXISTS'			=> 'ERREUR : la variable de configuration %s existe déjà.',
	'CONFIG_NOT_EXIST'				=> 'ERREUR : la variable de configuration %s n’existe pas.',
	'CONFIG_REMOVE'					=> 'Suppression d’une variable de configuration : %s',
	'CONFIG_UPDATE'					=> 'Mise à jour d’une variable de configuration : %s',

	'DISPLAY_RESULTS'				=> 'Afficher tous les résultats',
	'DISPLAY_RESULTS_EXPLAIN'		=> 'Sélectionne “oui” afin d’afficher toutes les actions et tous les résultats durant l’action demandée.',

	'ERROR_NOTICE'					=> 'Une ou plusieurs erreurs sont survenues lors de la réalisation de l’action demandée. Télécharge <a href="%1$s">ce fichier</a> listant les erreurs et demande de l’aide à l’auteur du MOD.<br /><br />Si tu éprouves des difficultés à télécharger ce fichier, télécharge-le directement par FTP en cliquant sur le lien suivant : %2$s',
	'ERROR_NOTICE_NO_FILE'			=> 'Une ou plusieurs erreurs sont survenues lors de la réalisation de l’action demandée. Procède à un enregistrement complet de toutes les erreurs et demande de l’aide à l’auteur du MOD.',

	'FAIL'							=> 'Échec',
	'FILE_COULD_NOT_READ'			=> 'ERREUR : il n’a pas été possible d’ouvrir le fichier %s afin de le lire.',
	'FOUNDERS_ONLY'					=> 'Tu dois être un fondateur du forum afin d’accéder à cette page.',

	'GROUP_NOT_EXIST'				=> 'Le groupe n’existe pas',

	'IGNORE'						=> 'Ignorer',
	'IMAGESET_CACHE_PURGE'			=> 'Rafraîchir l’archive d’images %s',
	'INSTALL'						=> 'Installer',
	'INSTALL_MOD'					=> 'Installer %s',
	'INSTALL_MOD_CONFIRM'			=> 'Es-tu prêt à installer %s ?',

	'MODULE_ADD'					=> 'Ajout du module %1$s : %2$s',
	'MODULE_ALREADY_EXIST'			=> 'ERREUR : le module existe déjà.',
	'MODULE_NOT_EXIST'				=> 'ERREUR : le module n’existe pas.',
	'MODULE_REMOVE'					=> 'Suppression du module %1$s : %2$s',

	'NONE'							=> 'Aucun',
	'NO_TABLE_DATA'					=> 'ERREUR : aucune donnée n’a été spécifiée dans la table',

	'PARENT_NOT_EXIST'				=> 'ERREUR : la catégorie parent spécifiée pour ce module n’existe pas.',
	'PERMISSIONS_WARNING'			=> 'Les réglages de la nouvelle permission ont été ajoutés. Assure-toi de vérifier les réglages de ta permission afin qu’ils soient exactement comme tu le souhaites.',
	'PERMISSION_ADD'				=> 'Ajout d’une nouvelle option de permission : %s',
	'PERMISSION_ALREADY_EXISTS'		=> 'ERREUR : l’option de permission %s existe déjà.',
	'PERMISSION_NOT_EXIST'			=> 'ERREUR : l’option de permission %s n’existe pas.',
	'PERMISSION_REMOVE'				=> 'Suppression d’une option de permission : %s',
	'PERMISSION_ROLE_ADD'			=> 'Ajout d’un nouveau rôle de permission : %s',
	'PERMISSION_ROLE_UPDATE'		=> 'Mise à jour d’un rôle de permission : %s',
	'PERMISSION_ROLE_REMOVE'		=> 'Suppression d’un rôle de permission : %s',
	'PERMISSION_SET_GROUP'			=> 'Régler les permissions du groupe %s.',
	'PERMISSION_SET_ROLE'			=> 'Régler les permissions du rôle %s.',
	'PERMISSION_UNSET_GROUP'		=> 'Dérégler les permissions du groupe %s.',
	'PERMISSION_UNSET_ROLE'			=> 'Dérégler les permissions du rôle %s.',

	'ROLE_ALREADY_EXISTS'			=> 'Le rôle de permission existe déjà.',
	'ROLE_NOT_EXIST'				=> 'Le rôle n’existe pas',

	'SUCCESS'						=> 'Succès',

	'TABLE_ADD'						=> 'Ajout d’une nouvelle table à la base de données : %s',
	'TABLE_ALREADY_EXISTS'			=> 'ERREUR : la table de la base de données %s existe déjà.',
	'TABLE_COLUMN_ADD'				=> 'Ajout d’une nouvelle colonne nommée %2$s à la table %1$s',
	'TABLE_COLUMN_ALREADY_EXISTS'	=> 'ERREUR : la colonne %2$s existe déjà dans la table %1$s.',
	'TABLE_COLUMN_NOT_EXIST'		=> 'ERREUR : la colonne %2$s n’existe pas dans la table %1$s.',
	'TABLE_COLUMN_REMOVE'			=> 'Suppression de la colonne nommée %2$s de la table %1$s',
	'TABLE_COLUMN_UPDATE'			=> 'Mise à jour de la colonne nommée %2$s de la table %1$s',
	'TABLE_KEY_ADD'					=> 'Ajout d’une clé nommée %2$s à la table %1$s',
	'TABLE_KEY_ALREADY_EXIST'		=> 'ERREUR : l’index %2$s existe déjà dans la table %1$s.',
	'TABLE_KEY_NOT_EXIST'			=> 'ERREUR : l’index %2$s n’existe pas dans la table %1$s.',
	'TABLE_KEY_REMOVE'				=> 'Suppression de la clé nommée %2$s de la table %1$s',
	'TABLE_NOT_EXIST'				=> 'ERREUR : la table de la base de données %s n’existe pas.',
	'TABLE_REMOVE'					=> 'Suppression d’une table de la base de données : %s',
	'TABLE_ROW_INSERT_DATA'			=> 'Insertion de données dans la table de la base de données %s.',
	'TABLE_ROW_REMOVE_DATA'			=> 'Suppression d’une rangée dans la table de la base de données %s',
	'TABLE_ROW_UPDATE_DATA'			=> 'Mise à jour d’une rangée dans la table de la base de données %s.',
	'TEMPLATE_CACHE_PURGE'			=> 'Rafraîchissement du template %s',
	'THEME_CACHE_PURGE'				=> 'Rafraîchissement du thème %s',

	'UNINSTALL'						=> 'Désinstaller',
	'UNINSTALL_MOD'					=> 'Désinstaller %s',
	'UNINSTALL_MOD_CONFIRM'			=> 'Es-tu prêt à désinstaller %s ? Tous les réglages et toutes les données sauvegardées par ce MOD seront supprimés !',
	'UNKNOWN'						=> 'Inconnu',
	'UPDATE_MOD'					=> 'Mettre à jour %s',
	'UPDATE_MOD_CONFIRM'			=> 'Es-tu prêt à mettre à jour %s ?',
	'UPDATE_UMIL'					=> 'Cette version d’UMIL n’est pas à jour.<br /><br />Télécharge la dernière version d’UMIL sur : <a href="%1$s" target="_blank">%1$s</a>',

	'VERSIONS'						=> 'Version du MOD : <strong>%1$s</strong><br />Actuellement installée : <strong>%2$s</strong>',
	'VERSION_SELECT'				=> 'Sélectionne la version',
	'VERSION_SELECT_EXPLAIN'		=> 'Ne modifie pas “ignorer” sauf si tu sais ce que tu fais.',
));

?>