<?php
/**
*
* This file is part of French (Formal Honorifics) AutoMOD translation.
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
* AutoMOD [French (Formal Honorifics)]
*
* @package   language
* @author    Maël Soucaze <maelsoucaze@gmail.com> http://mael.soucaze.com/
* @copyright (c) 2008 phpBB Group
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
* @version   $Id: info_acp_modman.php 242 2010-04-29 00:56:35Z jelly_doughnut $
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
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_CAT_MODS'			=> 'AutoMOD',
	'ACP_MODS'				=> 'AutoMOD',
	'ACP_AUTOMOD'			=> 'AutoMOD',
	'ACP_AUTOMOD_CONFIG'	=> 'Configuration d’AutoMOD',

	'LOG_MOD_ADD'		=> '<strong>Ajout d’un nouveau MOD</strong><br />» %s',
	'LOG_MOD_CHANGE'	=> '<strong>Modification de composants pour un MOD</strong><br />» %x',
	'LOG_MOD_REMOVE'	=> '<strong>Suppression d’un MOD</strong><br />» %s',

	'MOD_CHANGELOG'		=> 'Historique des modifications du MOD',

	'acl_a_mods'		=> array('lang' => 'Peut utiliser AutoMOD', 'cat' => 'misc'),
));



?>
