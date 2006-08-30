
-- 
-- Table structure for table `phpbb_acl_groups`
-- 

CREATE TABLE `phpbb_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  KEY `group_id` (`group_id`),
  KEY `auth_option_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_acl_groups`
-- 

INSERT INTO `phpbb_acl_groups` VALUES (7, 0, 0, 5, 0);
INSERT INTO `phpbb_acl_groups` VALUES (7, 0, 0, 1, 0);
INSERT INTO `phpbb_acl_groups` VALUES (4, 0, 0, 6, 0);
INSERT INTO `phpbb_acl_groups` VALUES (5, 0, 0, 6, 0);
INSERT INTO `phpbb_acl_groups` VALUES (6, 0, 0, 5, 0);
INSERT INTO `phpbb_acl_groups` VALUES (6, 0, 0, 10, 0);
INSERT INTO `phpbb_acl_groups` VALUES (1, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (2, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (3, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (4, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (5, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (8, 1, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (1, 2, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (2, 2, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (3, 2, 0, 17, 0);
INSERT INTO `phpbb_acl_groups` VALUES (4, 2, 0, 15, 0);
INSERT INTO `phpbb_acl_groups` VALUES (5, 2, 0, 15, 0);
INSERT INTO `phpbb_acl_groups` VALUES (6, 2, 0, 21, 0);
INSERT INTO `phpbb_acl_groups` VALUES (7, 2, 0, 14, 0);
INSERT INTO `phpbb_acl_groups` VALUES (7, 2, 0, 10, 0);
INSERT INTO `phpbb_acl_groups` VALUES (8, 2, 0, 19, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_acl_options`
-- 

CREATE TABLE `phpbb_acl_options` (
  `auth_option_id` mediumint(8) unsigned NOT NULL auto_increment,
  `auth_option` varchar(20) NOT NULL default '',
  `is_global` tinyint(1) NOT NULL default '0',
  `is_local` tinyint(1) NOT NULL default '0',
  `founder_only` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`auth_option_id`),
  KEY `auth_option` (`auth_option`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_acl_options`
-- 

INSERT INTO `phpbb_acl_options` VALUES (1, 'f_', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (2, 'f_announce', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (3, 'f_attach', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (4, 'f_bbcode', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (5, 'f_bump', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (6, 'f_delete', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (7, 'f_download', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (8, 'f_edit', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (9, 'f_email', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (10, 'f_flash', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (11, 'f_icons', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (12, 'f_ignoreflood', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (13, 'f_img', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (14, 'f_list', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (15, 'f_noapprove', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (16, 'f_print', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (17, 'f_poll', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (18, 'f_post', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (19, 'f_postcount', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (20, 'f_read', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (21, 'f_reply', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (22, 'f_report', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (23, 'f_search', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (24, 'f_sigs', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (25, 'f_smilies', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (26, 'f_sticky', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (27, 'f_subscribe', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (28, 'f_user_lock', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (29, 'f_vote', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (30, 'f_votechg', 0, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (31, 'm_', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (32, 'm_approve', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (33, 'm_chgposter', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (34, 'm_delete', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (35, 'm_edit', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (36, 'm_info', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (37, 'm_lock', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (38, 'm_merge', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (39, 'm_move', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (40, 'm_report', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (41, 'm_split', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (42, 'm_warn', 1, 1, 0);
INSERT INTO `phpbb_acl_options` VALUES (43, 'm_ban', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (44, 'a_', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (45, 'a_aauth', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (46, 'a_attach', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (47, 'a_authgroups', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (48, 'a_authusers', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (49, 'a_backup', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (50, 'a_ban', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (51, 'a_bbcode', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (52, 'a_board', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (53, 'a_bots', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (54, 'a_clearlogs', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (55, 'a_email', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (56, 'a_fauth', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (57, 'a_forum', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (58, 'a_forumadd', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (59, 'a_forumdel', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (60, 'a_group', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (61, 'a_groupadd', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (62, 'a_groupdel', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (63, 'a_icons', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (64, 'a_jabber', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (65, 'a_language', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (66, 'a_mauth', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (67, 'a_modules', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (68, 'a_names', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (69, 'a_phpinfo', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (70, 'a_profile', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (71, 'a_prune', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (72, 'a_ranks', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (73, 'a_reasons', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (74, 'a_roles', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (75, 'a_search', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (76, 'a_server', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (77, 'a_styles', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (78, 'a_switchperm', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (79, 'a_uauth', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (80, 'a_user', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (81, 'a_userdel', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (82, 'a_viewauth', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (83, 'a_viewlogs', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (84, 'a_words', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (85, 'u_', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (86, 'u_sendemail', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (87, 'u_readpm', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (88, 'u_sendpm', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (89, 'u_sendim', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (90, 'u_ignoreflood', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (91, 'u_hideonline', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (92, 'u_viewonline', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (93, 'u_viewprofile', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (94, 'u_chgavatar', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (95, 'u_chggrp', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (96, 'u_chgemail', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (97, 'u_chgname', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (98, 'u_chgpasswd', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (99, 'u_chgcensors', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (100, 'u_search', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (101, 'u_savedrafts', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (102, 'u_download', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (103, 'u_attach', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (104, 'u_sig', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (105, 'u_pm_attach', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (106, 'u_pm_bbcode', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (107, 'u_pm_smilies', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (108, 'u_pm_download', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (109, 'u_pm_edit', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (110, 'u_pm_printpm', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (111, 'u_pm_emailpm', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (112, 'u_pm_forward', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (113, 'u_pm_delete', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (114, 'u_pm_img', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (115, 'u_pm_flash', 1, 0, 0);
INSERT INTO `phpbb_acl_options` VALUES (116, 'a_pacman', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_acl_roles`
-- 

CREATE TABLE `phpbb_acl_roles` (
  `role_id` mediumint(8) unsigned NOT NULL auto_increment,
  `role_name` varchar(255) NOT NULL default '',
  `role_description` text,
  `role_type` varchar(10) NOT NULL default '',
  `role_order` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_order` (`role_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_acl_roles`
-- 

INSERT INTO `phpbb_acl_roles` VALUES (1, 'Standard Admin', 'ROLE_DESCRIPTION_ADMIN_STANDARD', 'a_', 1);
INSERT INTO `phpbb_acl_roles` VALUES (2, 'Forum Admin', 'ROLE_DESCRIPTION_ADMIN_FORUM', 'a_', 3);
INSERT INTO `phpbb_acl_roles` VALUES (3, 'User and Groups Admin', 'ROLE_DESCRIPTION_ADMIN_USERGROUP', 'a_', 4);
INSERT INTO `phpbb_acl_roles` VALUES (4, 'Full Admin', 'ROLE_DESCRIPTION_ADMIN_FULL', 'a_', 2);
INSERT INTO `phpbb_acl_roles` VALUES (5, 'All Features', 'ROLE_DESCRIPTION_USER_FULL', 'u_', 3);
INSERT INTO `phpbb_acl_roles` VALUES (6, 'Standard Features', 'ROLE_DESCRIPTION_USER_STANDARD', 'u_', 1);
INSERT INTO `phpbb_acl_roles` VALUES (7, 'Limited Features', 'ROLE_DESCRIPTION_USER_LIMITED', 'u_', 2);
INSERT INTO `phpbb_acl_roles` VALUES (8, 'No Private Messages', 'ROLE_DESCRIPTION_USER_NOPM', 'u_', 4);
INSERT INTO `phpbb_acl_roles` VALUES (9, 'No Avatar', 'ROLE_DESCRIPTION_USER_NOAVATAR', 'u_', 5);
INSERT INTO `phpbb_acl_roles` VALUES (10, 'Full Moderator', 'ROLE_DESCRIPTION_MOD_FULL', 'm_', 3);
INSERT INTO `phpbb_acl_roles` VALUES (11, 'Standard Moderator', 'ROLE_DESCRIPTION_MOD_STANDARD', 'm_', 1);
INSERT INTO `phpbb_acl_roles` VALUES (12, 'Simple Moderator', 'ROLE_DESCRIPTION_MOD_SIMPLE', 'm_', 2);
INSERT INTO `phpbb_acl_roles` VALUES (13, 'Queue Moderator', 'ROLE_DESCRIPTION_MOD_QUEUE', 'm_', 4);
INSERT INTO `phpbb_acl_roles` VALUES (14, 'Full Access', 'ROLE_DESCRIPTION_FORUM_FULL', 'f_', 6);
INSERT INTO `phpbb_acl_roles` VALUES (15, 'Standard Access', 'ROLE_DESCRIPTION_FORUM_STANDARD', 'f_', 4);
INSERT INTO `phpbb_acl_roles` VALUES (16, 'No Access', 'ROLE_DESCRIPTION_FORUM_NOACCESS', 'f_', 1);
INSERT INTO `phpbb_acl_roles` VALUES (17, 'Read Only Access', 'ROLE_DESCRIPTION_FORUM_READONLY', 'f_', 2);
INSERT INTO `phpbb_acl_roles` VALUES (18, 'Limited Access', 'ROLE_DESCRIPTION_FORUM_LIMITED', 'f_', 3);
INSERT INTO `phpbb_acl_roles` VALUES (19, 'Bot Access', 'ROLE_DESCRIPTION_FORUM_BOT', 'f_', 8);
INSERT INTO `phpbb_acl_roles` VALUES (20, 'On Moderation Queue', 'ROLE_DESCRIPTION_FORUM_ONQUEUE', 'f_', 7);
INSERT INTO `phpbb_acl_roles` VALUES (21, 'Standard Access + Polls', 'ROLE_DESCRIPTION_FORUM_POLLS', 'f_', 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_acl_roles_data`
-- 

CREATE TABLE `phpbb_acl_roles_data` (
  `role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`role_id`,`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_acl_roles_data`
-- 

INSERT INTO `phpbb_acl_roles_data` VALUES (1, 44, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 46, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 47, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 48, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 50, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 51, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 52, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 56, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 57, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 58, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 59, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 60, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 61, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 62, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 63, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 66, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 68, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 70, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 71, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 72, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 73, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 79, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 80, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 81, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 82, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 83, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (1, 84, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 44, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 47, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 48, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 56, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 57, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 58, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 59, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 66, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 71, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 79, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 82, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (2, 83, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 44, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 47, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 48, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 50, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 60, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 61, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 62, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 72, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 79, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 80, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 82, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (3, 83, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 44, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 45, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 46, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 47, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 48, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 49, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 50, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 51, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 52, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 53, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 54, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 55, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 56, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 57, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 58, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 59, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 60, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 61, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 62, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 63, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 64, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 65, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 66, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 67, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 68, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 69, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 70, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 71, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 72, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 73, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 74, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 75, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 76, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 77, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 78, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 79, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 80, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 81, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 82, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 83, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 84, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 85, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 86, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 87, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 88, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 89, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 90, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 91, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 92, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 93, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 94, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 95, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 96, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 97, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 98, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 99, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 100, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 101, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 102, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 103, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 104, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 105, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 106, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 107, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 108, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 109, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 110, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 111, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 112, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 113, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 114, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (5, 115, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 85, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 86, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 87, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 88, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 89, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 91, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 92, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 93, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 94, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 96, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 98, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 99, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 100, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 101, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 102, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 103, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 104, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 105, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 106, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 107, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 108, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 109, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 110, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 111, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 113, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (6, 114, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 85, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 87, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 88, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 91, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 92, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 93, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 94, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 96, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 98, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 99, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 102, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 104, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 106, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 107, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 108, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 109, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 110, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 112, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 113, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (7, 114, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 85, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 91, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 92, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 93, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 94, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 96, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 98, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 99, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 102, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 104, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 87, 0);
INSERT INTO `phpbb_acl_roles_data` VALUES (8, 88, 0);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 85, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 87, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 88, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 91, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 92, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 93, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 96, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 98, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 99, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 102, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 104, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 106, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 107, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 108, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 109, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 110, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 112, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 113, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 114, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (9, 94, 0);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 31, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 32, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 43, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 33, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 34, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 35, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 36, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 37, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 38, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 39, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 40, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 41, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (10, 42, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 31, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 35, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 36, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 37, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 38, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 39, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 40, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 41, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (11, 42, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 31, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 32, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 34, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 35, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 36, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 40, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (12, 42, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (13, 31, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (13, 32, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (13, 35, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 2, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 3, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 4, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 5, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 6, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 8, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 9, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 10, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 11, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 12, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 13, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 15, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 17, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 18, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 19, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 16, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 21, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 22, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 24, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 25, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 26, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 28, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 29, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (14, 30, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 3, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 4, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 5, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 8, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 9, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 10, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 11, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 13, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 15, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 18, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 19, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 16, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 21, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 22, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 24, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 25, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 29, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (15, 30, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (16, 1, 0);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (17, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 4, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 8, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 9, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 13, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 15, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 18, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 19, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 16, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 21, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 22, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 24, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 25, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (18, 29, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (19, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (19, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (19, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (19, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 3, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 4, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 8, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 9, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 13, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 18, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 19, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 16, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 21, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 22, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 24, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 25, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 29, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (20, 15, 0);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 1, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 3, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 4, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 5, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 7, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 8, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 9, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 10, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 11, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 13, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 14, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 15, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 17, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 18, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 19, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 16, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 20, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 21, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 22, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 23, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 24, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 25, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 27, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 29, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (21, 30, 1);
INSERT INTO `phpbb_acl_roles_data` VALUES (4, 116, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_acl_users`
-- 

CREATE TABLE `phpbb_acl_users` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_acl_users`
-- 

INSERT INTO `phpbb_acl_users` VALUES (2, 0, 0, 5, 0);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 71, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 59, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 58, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 57, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 76, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 69, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 64, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 52, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 81, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 80, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 72, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 70, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 68, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 62, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 61, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 60, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 50, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 83, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 77, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 75, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 73, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 116, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 67, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 0, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 65, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 55, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 54, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 53, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 49, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 84, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 63, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 51, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 46, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 82, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 79, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 78, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 74, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 66, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 56, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 48, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 47, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 45, 0, 1);
INSERT INTO `phpbb_acl_users` VALUES (8, 0, 44, 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_attachments`
-- 

CREATE TABLE `phpbb_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL auto_increment,
  `post_msg_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `in_message` tinyint(1) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) unsigned NOT NULL default '0',
  `physical_filename` varchar(255) NOT NULL default '',
  `real_filename` varchar(255) NOT NULL default '',
  `download_count` mediumint(8) unsigned NOT NULL default '0',
  `comment` text,
  `extension` varchar(100) default NULL,
  `mimetype` varchar(100) default NULL,
  `filesize` int(20) unsigned NOT NULL default '0',
  `filetime` int(11) unsigned NOT NULL default '0',
  `thumbnail` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `post_msg_id` (`post_msg_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_attachments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_banlist`
-- 

CREATE TABLE `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL auto_increment,
  `ban_userid` mediumint(8) unsigned NOT NULL default '0',
  `ban_ip` varchar(40) NOT NULL default '',
  `ban_email` varchar(100) NOT NULL default '',
  `ban_start` int(11) NOT NULL default '0',
  `ban_end` int(11) NOT NULL default '0',
  `ban_exclude` tinyint(1) NOT NULL default '0',
  `ban_reason` text,
  `ban_give_reason` text,
  PRIMARY KEY  (`ban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_banlist`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_bbcodes`
-- 

CREATE TABLE `phpbb_bbcodes` (
  `bbcode_id` tinyint(3) unsigned NOT NULL default '0',
  `bbcode_tag` varchar(16) NOT NULL default '',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '0',
  `bbcode_match` varchar(255) NOT NULL default '',
  `bbcode_tpl` text,
  `first_pass_match` varchar(255) NOT NULL default '',
  `first_pass_replace` varchar(255) NOT NULL default '',
  `second_pass_match` varchar(255) NOT NULL default '',
  `second_pass_replace` text,
  PRIMARY KEY  (`bbcode_id`),
  KEY `display_in_posting` (`display_on_posting`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_bbcodes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_bookmarks`
-- 

CREATE TABLE `phpbb_bookmarks` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `order_id` (`order_id`),
  KEY `topic_user_id` (`topic_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_bookmarks`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_bots`
-- 

CREATE TABLE `phpbb_bots` (
  `bot_id` tinyint(3) unsigned NOT NULL auto_increment,
  `bot_active` tinyint(1) NOT NULL default '1',
  `bot_name` text,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `bot_agent` varchar(255) NOT NULL default '',
  `bot_ip` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`bot_id`),
  KEY `bot_active` (`bot_active`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_bots`
-- 

INSERT INTO `phpbb_bots` VALUES (1, 1, 'Alexa', 3, 'ia_archiver', '66.28.250.,209.237.238.');
INSERT INTO `phpbb_bots` VALUES (2, 1, 'Fastcrawler', 4, 'FAST MetaWeb Crawler', '66.151.181.');
INSERT INTO `phpbb_bots` VALUES (3, 1, 'Googlebot', 5, 'Googlebot/', '');
INSERT INTO `phpbb_bots` VALUES (4, 1, 'Inktomi', 6, 'Slurp/', '216.35.116.,66.196.');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_config`
-- 

CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default '',
  `is_dynamic` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_config`
-- 

INSERT INTO `phpbb_config` VALUES ('active_sessions', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_attachments', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_autologin', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_avatar_local', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_avatar_upload', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_bbcode', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_bookmarks', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_emailreuse', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_forum_notify', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_mass_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_name_chars', '.*', 0);
INSERT INTO `phpbb_config` VALUES ('allow_namechange', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_nocensors', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_pm_attach', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_privmsg', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig_bbcode', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig_flash', '0', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig_img', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_sig_smilies', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_smilies', '1', 0);
INSERT INTO `phpbb_config` VALUES ('allow_topic_notify', '1', 0);
INSERT INTO `phpbb_config` VALUES ('attachment_quota', '52428800', 0);
INSERT INTO `phpbb_config` VALUES ('auth_bbcode_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('auth_download_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('auth_flash_pm', '0', 0);
INSERT INTO `phpbb_config` VALUES ('auth_img_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('auth_method', 'db', 0);
INSERT INTO `phpbb_config` VALUES ('auth_smilies_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_filesize', '6144', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_gallery_path', 'images/avatars/gallery', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_max_height', '90', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_max_width', '90', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_min_height', '20', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_min_width', '20', 0);
INSERT INTO `phpbb_config` VALUES ('avatar_path', 'images/avatars/upload', 0);
INSERT INTO `phpbb_config` VALUES ('board_contact', 'sr@fg.fg', 0);
INSERT INTO `phpbb_config` VALUES ('board_disable', '0', 0);
INSERT INTO `phpbb_config` VALUES ('board_disable_msg', '', 0);
INSERT INTO `phpbb_config` VALUES ('board_dst', '0', 0);
INSERT INTO `phpbb_config` VALUES ('board_email', 'sr@fg.fg', 0);
INSERT INTO `phpbb_config` VALUES ('board_email_form', '0', 0);
INSERT INTO `phpbb_config` VALUES ('board_email_sig', 'Thanks, The Management', 0);
INSERT INTO `phpbb_config` VALUES ('board_hide_emails', '1', 0);
INSERT INTO `phpbb_config` VALUES ('board_timezone', '0', 0);
INSERT INTO `phpbb_config` VALUES ('browser_check', '0', 0);
INSERT INTO `phpbb_config` VALUES ('bump_interval', '10', 0);
INSERT INTO `phpbb_config` VALUES ('bump_type', 'd', 0);
INSERT INTO `phpbb_config` VALUES ('cache_gc', '7200', 0);
INSERT INTO `phpbb_config` VALUES ('chg_passforce', '0', 0);
INSERT INTO `phpbb_config` VALUES ('cookie_domain', 'localhost', 0);
INSERT INTO `phpbb_config` VALUES ('cookie_name', 'phpbb3', 0);
INSERT INTO `phpbb_config` VALUES ('cookie_path', '/', 0);
INSERT INTO `phpbb_config` VALUES ('cookie_secure', '0', 0);
INSERT INTO `phpbb_config` VALUES ('coppa_enable', '0', 0);
INSERT INTO `phpbb_config` VALUES ('coppa_fax', '', 0);
INSERT INTO `phpbb_config` VALUES ('coppa_hide_groups', '1', 0);
INSERT INTO `phpbb_config` VALUES ('coppa_mail', '', 0);
INSERT INTO `phpbb_config` VALUES ('database_gc', '604800', 0);
INSERT INTO `phpbb_config` VALUES ('default_dateformat', 'D M d, Y g:i a', 0);
INSERT INTO `phpbb_config` VALUES ('default_style', '1', 0);
INSERT INTO `phpbb_config` VALUES ('display_last_edited', '1', 0);
INSERT INTO `phpbb_config` VALUES ('display_order', '0', 0);
INSERT INTO `phpbb_config` VALUES ('edit_time', '0', 0);
INSERT INTO `phpbb_config` VALUES ('email_enable', '1', 0);
INSERT INTO `phpbb_config` VALUES ('email_function_name', 'mail', 0);
INSERT INTO `phpbb_config` VALUES ('email_package_size', '50', 0);
INSERT INTO `phpbb_config` VALUES ('enable_confirm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('enable_pm_icons', '1', 0);
INSERT INTO `phpbb_config` VALUES ('enable_post_confirm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('flood_interval', '15', 0);
INSERT INTO `phpbb_config` VALUES ('force_server_vars', '0', 0);
INSERT INTO `phpbb_config` VALUES ('forward_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('full_folder_action', '2', 0);
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_max_word_len', '254', 0);
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_min_word_len', '4', 0);
INSERT INTO `phpbb_config` VALUES ('fulltext_native_load_upd', '1', 0);
INSERT INTO `phpbb_config` VALUES ('fulltext_native_max_chars', '14', 0);
INSERT INTO `phpbb_config` VALUES ('fulltext_native_min_chars', '3', 0);
INSERT INTO `phpbb_config` VALUES ('gzip_compress', '0', 0);
INSERT INTO `phpbb_config` VALUES ('hot_threshold', '25', 0);
INSERT INTO `phpbb_config` VALUES ('icons_path', 'images/icons', 0);
INSERT INTO `phpbb_config` VALUES ('img_create_thumbnail', '0', 0);
INSERT INTO `phpbb_config` VALUES ('img_display_inlined', '1', 0);
INSERT INTO `phpbb_config` VALUES ('img_imagick', '', 0);
INSERT INTO `phpbb_config` VALUES ('img_link_height', '0', 0);
INSERT INTO `phpbb_config` VALUES ('img_link_width', '0', 0);
INSERT INTO `phpbb_config` VALUES ('img_max_height', '0', 0);
INSERT INTO `phpbb_config` VALUES ('img_max_width', '0', 0);
INSERT INTO `phpbb_config` VALUES ('img_min_thumb_filesize', '12000', 0);
INSERT INTO `phpbb_config` VALUES ('ip_check', '4', 0);
INSERT INTO `phpbb_config` VALUES ('jab_enable', '0', 0);
INSERT INTO `phpbb_config` VALUES ('jab_host', '', 0);
INSERT INTO `phpbb_config` VALUES ('jab_password', '', 0);
INSERT INTO `phpbb_config` VALUES ('jab_package_size', '20', 0);
INSERT INTO `phpbb_config` VALUES ('jab_port', '5222', 0);
INSERT INTO `phpbb_config` VALUES ('jab_resource', '', 0);
INSERT INTO `phpbb_config` VALUES ('jab_username', '', 0);
INSERT INTO `phpbb_config` VALUES ('ldap_base_dn', '', 0);
INSERT INTO `phpbb_config` VALUES ('ldap_server', '', 0);
INSERT INTO `phpbb_config` VALUES ('ldap_uid', '', 0);
INSERT INTO `phpbb_config` VALUES ('limit_load', '0', 0);
INSERT INTO `phpbb_config` VALUES ('limit_search_load', '0', 0);
INSERT INTO `phpbb_config` VALUES ('load_birthdays', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_cpf_memberlist', '0', 0);
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewprofile', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewtopic', '0', 0);
INSERT INTO `phpbb_config` VALUES ('load_db_lastread', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_db_track', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_onlinetrack', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_jumpbox', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_moderators', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_online', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_online_guests', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_online_time', '5', 0);
INSERT INTO `phpbb_config` VALUES ('load_search', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_tplcompile', '1', 0);
INSERT INTO `phpbb_config` VALUES ('load_user_activity', '1', 0);
INSERT INTO `phpbb_config` VALUES ('max_attachments', '3', 0);
INSERT INTO `phpbb_config` VALUES ('max_attachments_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('max_autologin_time', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_filesize', '262144', 0);
INSERT INTO `phpbb_config` VALUES ('max_filesize_pm', '262144', 0);
INSERT INTO `phpbb_config` VALUES ('max_login_attempts', '3', 0);
INSERT INTO `phpbb_config` VALUES ('max_name_chars', '20', 0);
INSERT INTO `phpbb_config` VALUES ('max_pass_chars', '30', 0);
INSERT INTO `phpbb_config` VALUES ('max_poll_options', '10', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_chars', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_font_size', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_img_height', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_img_width', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_smilies', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_post_urls', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_quote_depth', '3', 0);
INSERT INTO `phpbb_config` VALUES ('max_reg_attempts', '5', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_chars', '255', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_font_size', '24', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_img_height', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_img_width', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_smilies', '0', 0);
INSERT INTO `phpbb_config` VALUES ('max_sig_urls', '5', 0);
INSERT INTO `phpbb_config` VALUES ('min_name_chars', '3', 0);
INSERT INTO `phpbb_config` VALUES ('min_pass_chars', '6', 0);
INSERT INTO `phpbb_config` VALUES ('min_search_author_chars', '3', 0);
INSERT INTO `phpbb_config` VALUES ('override_user_style', '0', 0);
INSERT INTO `phpbb_config` VALUES ('pass_complex', '.*', 0);
INSERT INTO `phpbb_config` VALUES ('pm_edit_time', '0', 0);
INSERT INTO `phpbb_config` VALUES ('pm_max_boxes', '4', 0);
INSERT INTO `phpbb_config` VALUES ('pm_max_msgs', '50', 0);
INSERT INTO `phpbb_config` VALUES ('policy_overlap', '0', 0);
INSERT INTO `phpbb_config` VALUES ('policy_overlap_noise_pixel', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_overlap_noise_line', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_entropy', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_entropy_noise_pixel', '2', 0);
INSERT INTO `phpbb_config` VALUES ('policy_entropy_noise_line', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_shape', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_shape_noise_pixel', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_shape_noise_line', '1', 0);
INSERT INTO `phpbb_config` VALUES ('policy_3dbitmap', '0', 0);
INSERT INTO `phpbb_config` VALUES ('policy_cells', '0', 0);
INSERT INTO `phpbb_config` VALUES ('policy_stencil', '0', 0);
INSERT INTO `phpbb_config` VALUES ('policy_composite', '0', 0);
INSERT INTO `phpbb_config` VALUES ('posts_per_page', '10', 0);
INSERT INTO `phpbb_config` VALUES ('print_pm', '1', 0);
INSERT INTO `phpbb_config` VALUES ('queue_interval', '600', 0);
INSERT INTO `phpbb_config` VALUES ('ranks_path', 'images/ranks', 0);
INSERT INTO `phpbb_config` VALUES ('require_activation', '0', 0);
INSERT INTO `phpbb_config` VALUES ('search_block_size', '250', 0);
INSERT INTO `phpbb_config` VALUES ('search_gc', '7200', 0);
INSERT INTO `phpbb_config` VALUES ('search_indexing_state', '', 0);
INSERT INTO `phpbb_config` VALUES ('search_interval', '0', 0);
INSERT INTO `phpbb_config` VALUES ('search_anonymous_interval', '0', 0);
INSERT INTO `phpbb_config` VALUES ('search_type', 'fulltext_native', 0);
INSERT INTO `phpbb_config` VALUES ('search_store_results', '1800', 0);
INSERT INTO `phpbb_config` VALUES ('secure_allow_deny', '1', 0);
INSERT INTO `phpbb_config` VALUES ('secure_allow_empty_referer', '1', 0);
INSERT INTO `phpbb_config` VALUES ('secure_downloads', '0', 0);
INSERT INTO `phpbb_config` VALUES ('send_encoding', '0', 0);
INSERT INTO `phpbb_config` VALUES ('server_name', 'localhost', 0);
INSERT INTO `phpbb_config` VALUES ('server_port', '80', 0);
INSERT INTO `phpbb_config` VALUES ('server_protocol', 'http://', 0);
INSERT INTO `phpbb_config` VALUES ('session_gc', '3600', 0);
INSERT INTO `phpbb_config` VALUES ('session_length', '3600', 0);
INSERT INTO `phpbb_config` VALUES ('site_desc', 'PacMan!', 0);
INSERT INTO `phpbb_config` VALUES ('sitename', 'Area 51', 0);
INSERT INTO `phpbb_config` VALUES ('smilies_path', 'images/smilies', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_auth_method', 'PLAIN', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_delivery', '0', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_host', '', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_password', '', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_port', '25', 0);
INSERT INTO `phpbb_config` VALUES ('smtp_username', '', 0);
INSERT INTO `phpbb_config` VALUES ('topics_per_page', '25', 0);
INSERT INTO `phpbb_config` VALUES ('tpl_allow_php', '0', 0);
INSERT INTO `phpbb_config` VALUES ('upload_icons_path', 'images/upload_icons', 0);
INSERT INTO `phpbb_config` VALUES ('upload_path', 'files', 0);
INSERT INTO `phpbb_config` VALUES ('version', '3.0.B1', 0);
INSERT INTO `phpbb_config` VALUES ('warnings_expire_days', '90', 0);
INSERT INTO `phpbb_config` VALUES ('warnings_gc', '14400', 0);
INSERT INTO `phpbb_config` VALUES ('cache_last_gc', '1156973798', 1);
INSERT INTO `phpbb_config` VALUES ('database_last_gc', '1156621924', 1);
INSERT INTO `phpbb_config` VALUES ('last_queue_run', '0', 1);
INSERT INTO `phpbb_config` VALUES ('newest_user_id', '8', 1);
INSERT INTO `phpbb_config` VALUES ('newest_username', 'Test', 1);
INSERT INTO `phpbb_config` VALUES ('num_files', '0', 1);
INSERT INTO `phpbb_config` VALUES ('num_posts', '1', 1);
INSERT INTO `phpbb_config` VALUES ('num_topics', '1', 1);
INSERT INTO `phpbb_config` VALUES ('num_users', '2', 1);
INSERT INTO `phpbb_config` VALUES ('rand_seed', '0d408ea3767d2160a929a79f2e1aa722', 1);
INSERT INTO `phpbb_config` VALUES ('record_online_date', '1156634135', 1);
INSERT INTO `phpbb_config` VALUES ('record_online_users', '7', 1);
INSERT INTO `phpbb_config` VALUES ('search_last_gc', '1156671203', 1);
INSERT INTO `phpbb_config` VALUES ('session_last_gc', '1156634128', 1);
INSERT INTO `phpbb_config` VALUES ('upload_dir_size', '0', 1);
INSERT INTO `phpbb_config` VALUES ('warnings_last_gc', '1156671197', 1);
INSERT INTO `phpbb_config` VALUES ('board_startdate', '1150830232', 0);
INSERT INTO `phpbb_config` VALUES ('default_lang', 'en', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_confirm`
-- 

CREATE TABLE `phpbb_confirm` (
  `confirm_id` varchar(32) NOT NULL default '',
  `session_id` varchar(32) NOT NULL default '',
  `confirm_type` tinyint(3) NOT NULL default '0',
  `code` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`session_id`,`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_confirm`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_disallow`
-- 

CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL auto_increment,
  `disallow_username` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`disallow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_disallow`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_drafts`
-- 

CREATE TABLE `phpbb_drafts` (
  `draft_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `save_time` int(11) unsigned NOT NULL default '0',
  `draft_subject` text,
  `draft_message` mediumtext,
  PRIMARY KEY  (`draft_id`),
  KEY `save_time` (`save_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_drafts`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_extension_groups`
-- 

CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL default '',
  `cat_id` tinyint(2) NOT NULL default '0',
  `allow_group` tinyint(1) NOT NULL default '0',
  `download_mode` tinyint(1) unsigned NOT NULL default '1',
  `upload_icon` varchar(255) NOT NULL default '',
  `max_filesize` int(20) NOT NULL default '0',
  `allowed_forums` text,
  `allow_in_pm` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_extension_groups`
-- 

INSERT INTO `phpbb_extension_groups` VALUES (1, 'Images', 1, 1, 1, '', 0, '', 0);
INSERT INTO `phpbb_extension_groups` VALUES (2, 'Archives', 0, 1, 1, '', 0, '', 0);
INSERT INTO `phpbb_extension_groups` VALUES (3, 'Plain Text', 0, 0, 1, '', 0, '', 0);
INSERT INTO `phpbb_extension_groups` VALUES (4, 'Documents', 0, 0, 1, '', 0, '', 0);
INSERT INTO `phpbb_extension_groups` VALUES (5, 'Real Media', 3, 0, 2, '', 0, '', 0);
INSERT INTO `phpbb_extension_groups` VALUES (6, 'Windows Media', 2, 0, 1, '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_extensions`
-- 

CREATE TABLE `phpbb_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `extension` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_extensions`
-- 

INSERT INTO `phpbb_extensions` VALUES (1, 1, 'gif');
INSERT INTO `phpbb_extensions` VALUES (2, 1, 'png');
INSERT INTO `phpbb_extensions` VALUES (3, 1, 'jpeg');
INSERT INTO `phpbb_extensions` VALUES (4, 1, 'jpg');
INSERT INTO `phpbb_extensions` VALUES (5, 1, 'tif');
INSERT INTO `phpbb_extensions` VALUES (6, 1, 'tga');
INSERT INTO `phpbb_extensions` VALUES (7, 2, 'gtar');
INSERT INTO `phpbb_extensions` VALUES (8, 2, 'gz');
INSERT INTO `phpbb_extensions` VALUES (9, 2, 'tar');
INSERT INTO `phpbb_extensions` VALUES (10, 2, 'zip');
INSERT INTO `phpbb_extensions` VALUES (11, 2, 'rar');
INSERT INTO `phpbb_extensions` VALUES (12, 2, 'ace');
INSERT INTO `phpbb_extensions` VALUES (13, 3, 'txt');
INSERT INTO `phpbb_extensions` VALUES (14, 3, 'c');
INSERT INTO `phpbb_extensions` VALUES (15, 3, 'h');
INSERT INTO `phpbb_extensions` VALUES (16, 3, 'cpp');
INSERT INTO `phpbb_extensions` VALUES (17, 3, 'hpp');
INSERT INTO `phpbb_extensions` VALUES (18, 3, 'diz');
INSERT INTO `phpbb_extensions` VALUES (19, 4, 'xls');
INSERT INTO `phpbb_extensions` VALUES (20, 4, 'doc');
INSERT INTO `phpbb_extensions` VALUES (21, 4, 'dot');
INSERT INTO `phpbb_extensions` VALUES (22, 4, 'pdf');
INSERT INTO `phpbb_extensions` VALUES (23, 4, 'ai');
INSERT INTO `phpbb_extensions` VALUES (24, 4, 'ps');
INSERT INTO `phpbb_extensions` VALUES (25, 4, 'ppt');
INSERT INTO `phpbb_extensions` VALUES (26, 5, 'rm');
INSERT INTO `phpbb_extensions` VALUES (27, 6, 'wma');
INSERT INTO `phpbb_extensions` VALUES (28, 6, 'wmv');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_forums`
-- 

CREATE TABLE `phpbb_forums` (
  `forum_id` smallint(5) unsigned NOT NULL auto_increment,
  `parent_id` smallint(5) unsigned NOT NULL default '0',
  `left_id` smallint(5) unsigned NOT NULL default '0',
  `right_id` smallint(5) unsigned NOT NULL default '0',
  `forum_parents` text,
  `forum_name` text,
  `forum_desc` text,
  `forum_desc_bitfield` int(11) unsigned NOT NULL default '0',
  `forum_desc_uid` varchar(5) NOT NULL default '',
  `forum_link` varchar(255) NOT NULL default '',
  `forum_password` varchar(40) NOT NULL default '',
  `forum_style` tinyint(4) unsigned default NULL,
  `forum_image` varchar(255) NOT NULL default '',
  `forum_rules` text,
  `forum_rules_link` varchar(255) NOT NULL default '',
  `forum_rules_bitfield` int(11) unsigned NOT NULL default '0',
  `forum_rules_uid` varchar(5) NOT NULL default '',
  `forum_topics_per_page` tinyint(4) unsigned NOT NULL default '0',
  `forum_type` tinyint(4) NOT NULL default '0',
  `forum_status` tinyint(4) NOT NULL default '0',
  `forum_posts` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics_real` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_poster_id` mediumint(8) NOT NULL default '0',
  `forum_last_post_time` int(11) NOT NULL default '0',
  `forum_last_poster_name` varchar(255) default NULL,
  `forum_flags` tinyint(4) NOT NULL default '0',
  `display_on_index` tinyint(1) NOT NULL default '1',
  `enable_indexing` tinyint(1) NOT NULL default '1',
  `enable_icons` tinyint(1) NOT NULL default '1',
  `enable_prune` tinyint(1) NOT NULL default '0',
  `prune_next` int(11) unsigned default NULL,
  `prune_days` tinyint(4) unsigned NOT NULL default '0',
  `prune_viewed` tinyint(4) unsigned NOT NULL default '0',
  `prune_freq` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_forums`
-- 

INSERT INTO `phpbb_forums` VALUES (1, 0, 5, 8, NULL, 'My first Category', '', 0, '', '', '', NULL, '', '', '', 0, '', 0, 0, 0, 1, 1, 1, 1, 2, 1150830232, 'bkettle', 0, 1, 1, 1, 0, NULL, 0, 0, 0);
INSERT INTO `phpbb_forums` VALUES (2, 1, 6, 7, NULL, 'Test Forum 1', 'This is just a test forum.', 0, '', '', '', NULL, '', '', '', 0, '', 0, 1, 0, 1, 1, 1, 1, 2, 1150830232, 'bkettle', 0, 1, 1, 1, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_forums_access`
-- 

CREATE TABLE `phpbb_forums_access` (
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `session_id` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`forum_id`,`user_id`,`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_forums_access`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_forums_track`
-- 

CREATE TABLE `phpbb_forums_track` (
  `user_id` mediumint(9) unsigned NOT NULL default '0',
  `forum_id` mediumint(9) unsigned NOT NULL default '0',
  `mark_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_forums_track`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_forums_watch`
-- 

CREATE TABLE `phpbb_forums_watch` (
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_forums_watch`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_groups`
-- 

CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_type` tinyint(4) NOT NULL default '1',
  `group_name` varchar(255) NOT NULL default '',
  `group_desc` text,
  `group_desc_bitfield` int(11) unsigned NOT NULL default '0',
  `group_desc_uid` varchar(5) NOT NULL default '',
  `group_display` tinyint(1) NOT NULL default '0',
  `group_avatar` varchar(255) NOT NULL default '',
  `group_avatar_type` tinyint(4) NOT NULL default '0',
  `group_avatar_width` tinyint(4) unsigned NOT NULL default '0',
  `group_avatar_height` tinyint(4) unsigned NOT NULL default '0',
  `group_rank` smallint(5) NOT NULL default '-1',
  `group_colour` varchar(6) NOT NULL default '',
  `group_sig_chars` mediumint(8) unsigned NOT NULL default '0',
  `group_receive_pm` tinyint(1) NOT NULL default '0',
  `group_message_limit` mediumint(8) unsigned NOT NULL default '0',
  `group_chgpass` smallint(6) NOT NULL default '0',
  `group_legend` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`),
  KEY `group_legend` (`group_legend`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_groups`
-- 

INSERT INTO `phpbb_groups` VALUES (1, 3, 'GUESTS', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0);
INSERT INTO `phpbb_groups` VALUES (2, 3, 'INACTIVE', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0);
INSERT INTO `phpbb_groups` VALUES (3, 3, 'INACTIVE_COPPA', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0);
INSERT INTO `phpbb_groups` VALUES (4, 3, 'REGISTERED', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0);
INSERT INTO `phpbb_groups` VALUES (5, 3, 'REGISTERED_COPPA', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0);
INSERT INTO `phpbb_groups` VALUES (6, 3, 'GLOBAL_MODERATORS', '', 0, '', 0, '', 0, 0, 0, -1, '00AA00', 0, 0, 0, 0, 1);
INSERT INTO `phpbb_groups` VALUES (7, 3, 'ADMINISTRATORS', '', 0, '', 0, '', 0, 0, 0, -1, 'AA0000', 0, 0, 0, 0, 1);
INSERT INTO `phpbb_groups` VALUES (8, 3, 'BOTS', '', 0, '', 0, '', 0, 0, 0, -1, '9E8DA7', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_icons`
-- 

CREATE TABLE `phpbb_icons` (
  `icons_id` tinyint(4) unsigned NOT NULL auto_increment,
  `icons_url` varchar(255) default NULL,
  `icons_width` tinyint(4) unsigned NOT NULL default '0',
  `icons_height` tinyint(4) unsigned NOT NULL default '0',
  `icons_order` tinyint(4) unsigned NOT NULL default '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`icons_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_icons`
-- 

INSERT INTO `phpbb_icons` VALUES (1, 'misc/arrow_bold_rgt.gif', 19, 19, 1, 1);
INSERT INTO `phpbb_icons` VALUES (2, 'smile/redface_anim.gif', 19, 19, 9, 1);
INSERT INTO `phpbb_icons` VALUES (3, 'smile/mr_green.gif', 19, 19, 10, 1);
INSERT INTO `phpbb_icons` VALUES (4, 'misc/musical.gif', 19, 19, 4, 1);
INSERT INTO `phpbb_icons` VALUES (5, 'misc/asterix.gif', 19, 19, 2, 1);
INSERT INTO `phpbb_icons` VALUES (6, 'misc/square.gif', 19, 19, 3, 1);
INSERT INTO `phpbb_icons` VALUES (7, 'smile/alien_grn.gif', 19, 19, 5, 1);
INSERT INTO `phpbb_icons` VALUES (8, 'smile/idea.gif', 19, 19, 8, 1);
INSERT INTO `phpbb_icons` VALUES (9, 'smile/question.gif', 19, 19, 6, 1);
INSERT INTO `phpbb_icons` VALUES (10, 'smile/exclaim.gif', 19, 19, 7, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_lang`
-- 

CREATE TABLE `phpbb_lang` (
  `lang_id` tinyint(4) unsigned NOT NULL auto_increment,
  `lang_iso` varchar(5) NOT NULL default '',
  `lang_dir` varchar(30) NOT NULL default '',
  `lang_english_name` varchar(100) default NULL,
  `lang_local_name` varchar(255) default NULL,
  `lang_author` varchar(255) default NULL,
  PRIMARY KEY  (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_lang`
-- 

INSERT INTO `phpbb_lang` VALUES (1, 'en', 'en', 'English [ UK ]', 'English [ UK ]', 'phpBB Group');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_log`
-- 

CREATE TABLE `phpbb_log` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `log_type` tinyint(4) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `reportee_id` mediumint(8) unsigned NOT NULL default '0',
  `log_ip` varchar(40) NOT NULL default '',
  `log_time` int(11) NOT NULL default '0',
  `log_operation` text,
  `log_data` text,
  PRIMARY KEY  (`log_id`),
  KEY `log_type` (`log_type`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `reportee_id` (`reportee_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_log`
-- 

INSERT INTO `phpbb_log` VALUES (1, 2, 2, 0, 0, 0, '127.0.0.1', 1150830235, 'LOG_ERROR_EMAIL', 'a:1:{i:0;s:112:"<u>EMAIL ERROR</u> [ PHP ]<br /><br /><br /><br /><u>CALLING PAGE</u><br /><br />/phpBB3/install/index.php<br />";}');
INSERT INTO `phpbb_log` VALUES (2, 0, 2, 0, 0, 0, '127.0.0.1', 1150830235, 'LOG_INSTALL_INSTALLED', 'a:1:{i:0;s:6:"3.0.B1";}');
INSERT INTO `phpbb_log` VALUES (3, 0, 2, 0, 0, 0, '127.0.0.1', 1150833486, 'LOG_MODULE_ADD', 'a:1:{i:0;s:15:"Package Manager";}');
INSERT INTO `phpbb_log` VALUES (4, 0, 2, 0, 0, 0, '127.0.0.1', 1150833494, 'LOG_MODULE_MOVE_UP', 'a:1:{i:0;s:5:".Mods";}');
INSERT INTO `phpbb_log` VALUES (5, 0, 2, 0, 0, 0, '127.0.0.1', 1150833552, 'LOG_MODULE_ADD', 'a:1:{i:0;s:15:"Package Manager";}');
INSERT INTO `phpbb_log` VALUES (6, 0, 2, 0, 0, 0, '127.0.0.1', 1150833586, 'LOG_MODULE_ADD', 'a:1:{i:0;s:6:"Manage";}');
INSERT INTO `phpbb_log` VALUES (7, 0, 2, 0, 0, 0, '127.0.0.1', 1150833618, 'LOG_MODULE_ADD', 'a:1:{i:0;s:6:"Browse";}');
INSERT INTO `phpbb_log` VALUES (8, 0, 2, 0, 0, 0, '127.0.0.1', 1150833644, 'LOG_MODULE_ADD', 'a:1:{i:0;s:6:"Manual";}');
INSERT INTO `phpbb_log` VALUES (9, 0, 2, 0, 0, 0, '127.0.0.1', 1150834016, 'LOG_MODULE_MOVE_UP', 'a:1:{i:0;s:6:"System";}');
INSERT INTO `phpbb_log` VALUES (10, 0, 2, 0, 0, 0, '127.0.0.1', 1150834252, 'LOG_MODULE_ADD', 'a:1:{i:0;s:7:"Install";}');
INSERT INTO `phpbb_log` VALUES (11, 0, 2, 0, 0, 0, '127.0.0.1', 1150834257, 'LOG_MODULE_ENABLE', '');
INSERT INTO `phpbb_log` VALUES (12, 0, 2, 0, 0, 0, '127.0.0.1', 1150834301, 'LOG_MODULE_ADD', 'a:1:{i:0;s:7:"General";}');
INSERT INTO `phpbb_log` VALUES (13, 0, 2, 0, 0, 0, '127.0.0.1', 1150834318, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:6:"Browse";}');
INSERT INTO `phpbb_log` VALUES (14, 0, 2, 0, 0, 0, '127.0.0.1', 1150834331, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:6:"Manual";}');
INSERT INTO `phpbb_log` VALUES (15, 0, 2, 0, 0, 0, '127.0.0.1', 1150834341, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:15:"Package Manager";}');
INSERT INTO `phpbb_log` VALUES (16, 0, 2, 0, 0, 0, '127.0.0.1', 1150834346, 'LOG_MODULE_MOVE_UP', 'a:1:{i:0;s:7:"Install";}');
INSERT INTO `phpbb_log` VALUES (17, 0, 2, 0, 0, 0, '127.0.0.1', 1150834355, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:6:"Manage";}');
INSERT INTO `phpbb_log` VALUES (18, 0, 2, 0, 0, 0, '127.0.0.1', 1150844406, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (19, 0, 2, 0, 0, 0, '127.0.0.1', 1150844470, 'LOG_CONFIG_SETTINGS', '');
INSERT INTO `phpbb_log` VALUES (20, 0, 2, 0, 0, 0, '127.0.0.1', 1150845187, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:5:"Local";}');
INSERT INTO `phpbb_log` VALUES (21, 0, 2, 0, 0, 0, '127.0.0.1', 1150850049, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:6:"Upload";}');
INSERT INTO `phpbb_log` VALUES (22, 0, 2, 0, 0, 0, '127.0.0.1', 1150906501, 'LOG_WORD_ADD', 'a:1:{i:0;s:3:"boo";}');
INSERT INTO `phpbb_log` VALUES (24, 0, 2, 0, 0, 0, '127.0.0.1', 1151598192, 'LOG_CLEAR_ADMIN', '');
INSERT INTO `phpbb_log` VALUES (25, 0, 2, 0, 0, 0, '127.0.0.1', 1151598227, 'LOG_BOT_ADDED', 'a:1:{i:0;s:1:"8";}');
INSERT INTO `phpbb_log` VALUES (26, 0, 2, 0, 0, 0, '127.0.0.1', 1151957840, 'LOG_MODULE_ADD', 'a:1:{i:0;s:7:"Install";}');
INSERT INTO `phpbb_log` VALUES (27, 0, 2, 0, 0, 0, '127.0.0.1', 1152573757, 'LOG_MODULE_REMOVED', 'a:1:{i:0;s:7:"Install";}');
INSERT INTO `phpbb_log` VALUES (28, 0, 2, 0, 0, 0, '127.0.0.1', 1153521378, 'LOG_BOT_DELETE', 'a:1:{i:0;s:1:"8";}');
INSERT INTO `phpbb_log` VALUES (29, 0, 2, 0, 0, 0, '127.0.0.1', 1153521451, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:6:"Manage";}');
INSERT INTO `phpbb_log` VALUES (30, 0, 2, 0, 0, 0, '127.0.0.1', 1153521471, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:24:"ACP_PACMAN_INSTALLATIONS";}');
INSERT INTO `phpbb_log` VALUES (31, 0, 2, 0, 0, 0, '127.0.0.1', 1153521776, 'LOG_MODULE_EDIT', 'a:1:{i:0;s:8:"Packages";}');
INSERT INTO `phpbb_log` VALUES (32, 0, 2, 0, 0, 0, '127.0.0.1', 1153521794, 'LOG_MODULE_MOVE_UP', 'a:1:{i:0;s:6:"Upload";}');
INSERT INTO `phpbb_log` VALUES (33, 0, 2, 0, 0, 0, '127.0.0.1', 1153521797, 'LOG_MODULE_MOVE_UP', 'a:1:{i:0;s:6:"Browse";}');
INSERT INTO `phpbb_log` VALUES (34, 2, 1, 0, 0, 0, '86.144.89.108', 1156621972, 'LOG_ERROR_EMAIL', 'a:1:{i:0;s:102:"<u>EMAIL ERROR</u> [ PHP ]<br /><br /><br /><br /><u>CALLING PAGE</u><br /><br />/phpBB3/ucp.php<br />";}');
INSERT INTO `phpbb_log` VALUES (35, 0, 2, 0, 0, 0, '86.144.89.108', 1156622118, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (36, 0, 2, 0, 0, 0, '86.144.89.108', 1156622186, 'LOG_ACL_ADD_USER_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (37, 0, 2, 0, 0, 0, '86.144.89.108', 1156622267, 'LOG_ACL_ADD_USER_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (38, 0, 2, 0, 0, 0, '86.144.89.108', 1156622306, 'LOG_ACL_ADD_USER_GLOBAL_U_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (39, 0, 8, 0, 0, 0, '86.144.89.108', 1156622370, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (40, 0, 8, 0, 0, 0, '86.144.89.108', 1156622531, 'LOG_ACL_ADD_ADMIN_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (41, 0, 8, 0, 0, 0, '86.144.89.108', 1156622540, 'LOG_ACL_DEL_ADMIN_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (42, 0, 2, 0, 0, 0, '86.144.89.108', 1156622559, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (43, 0, 2, 0, 0, 0, '86.144.89.108', 1156622595, 'LOG_ACL_ADD_USER_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (44, 0, 2, 0, 0, 0, '86.144.89.108', 1156622853, 'LOG_ACL_ADD_ADMIN_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (45, 0, 2, 0, 0, 0, '86.144.89.108', 1156623093, 'LOG_ACL_ADD_ADMIN_GLOBAL_A_', 'a:1:{i:0;s:4:"Test";}');
INSERT INTO `phpbb_log` VALUES (46, 0, 8, 0, 0, 0, '86.144.89.108', 1156623134, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (47, 0, 8, 0, 0, 0, '209.180.90.179', 1156634195, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (48, 0, 8, 0, 0, 0, '87.243.193.183', 1156634206, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (49, 0, 8, 0, 0, 0, '70.112.115.176', 1156634208, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (50, 0, 2, 0, 0, 0, '86.144.89.108', 1156634277, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (51, 0, 8, 0, 0, 0, '219.84.30.172', 1156634300, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (52, 0, 8, 0, 0, 0, '87.160.242.154', 1156634312, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (53, 0, 8, 0, 0, 0, '82.34.240.141', 1156645001, 'LOG_ADMIN_AUTH_SUCCESS', '');
INSERT INTO `phpbb_log` VALUES (54, 0, 8, 0, 0, 0, '80.139.105.25', 1156671213, 'LOG_ADMIN_AUTH_SUCCESS', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_moderator_cache`
-- 

CREATE TABLE `phpbb_moderator_cache` (
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `group_name` varchar(255) NOT NULL default '',
  `display_on_index` tinyint(1) unsigned NOT NULL default '1',
  KEY `display_on_index` (`display_on_index`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_moderator_cache`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_modification_authors`
-- 

CREATE TABLE `phpbb_modification_authors` (
  `mod_id` int(8) NOT NULL default '0',
  `author_id` int(8) NOT NULL auto_increment,
  `author_name` varchar(255) NOT NULL default '',
  `author_email` varchar(255) NOT NULL default '',
  `author_realname` varchar(255) NOT NULL default '',
  `author_website` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`author_id`),
  KEY `mod_id` (`mod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_modification_authors`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_modules`
-- 

CREATE TABLE `phpbb_modules` (
  `module_id` mediumint(8) unsigned NOT NULL auto_increment,
  `module_enabled` tinyint(1) unsigned NOT NULL default '1',
  `module_display` tinyint(1) unsigned NOT NULL default '1',
  `module_name` varchar(255) NOT NULL default '',
  `module_class` varchar(10) NOT NULL default '',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `left_id` mediumint(8) unsigned NOT NULL default '0',
  `right_id` mediumint(8) unsigned NOT NULL default '0',
  `module_langname` varchar(255) NOT NULL default '',
  `module_mode` varchar(255) NOT NULL default '',
  `module_auth` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`module_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `module_enabled` (`module_enabled`),
  KEY `class_left_id` (`module_class`,`left_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_modules`
-- 

INSERT INTO `phpbb_modules` VALUES (1, 1, 1, '', 'acp', 0, 275, 332, 'ACP_CAT_GENERAL', '', '');
INSERT INTO `phpbb_modules` VALUES (2, 1, 1, '', 'acp', 1, 278, 291, 'ACP_QUICK_ACCESS', '', '');
INSERT INTO `phpbb_modules` VALUES (3, 1, 1, '', 'acp', 1, 292, 311, 'ACP_BOARD_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES (4, 1, 1, '', 'acp', 1, 312, 319, 'ACP_CLIENT_COMMUNICATION', '', '');
INSERT INTO `phpbb_modules` VALUES (5, 1, 1, '', 'acp', 1, 320, 331, 'ACP_SERVER_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES (6, 1, 1, '', 'acp', 0, 333, 350, 'ACP_CAT_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES (7, 1, 1, '', 'acp', 6, 334, 339, 'ACP_MANAGE_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES (8, 1, 1, '', 'acp', 6, 340, 349, 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES (9, 1, 1, '', 'acp', 0, 351, 374, 'ACP_CAT_POSTING', '', '');
INSERT INTO `phpbb_modules` VALUES (10, 1, 1, '', 'acp', 9, 352, 363, 'ACP_MESSAGES', '', '');
INSERT INTO `phpbb_modules` VALUES (11, 1, 1, '', 'acp', 9, 364, 373, 'ACP_ATTACHMENTS', '', '');
INSERT INTO `phpbb_modules` VALUES (12, 1, 1, '', 'acp', 0, 375, 426, 'ACP_CAT_USERGROUP', '', '');
INSERT INTO `phpbb_modules` VALUES (13, 1, 1, '', 'acp', 12, 376, 405, 'ACP_CAT_USERS', '', '');
INSERT INTO `phpbb_modules` VALUES (14, 1, 1, '', 'acp', 12, 406, 413, 'ACP_GROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES (15, 1, 1, '', 'acp', 12, 414, 425, 'ACP_USER_SECURITY', '', '');
INSERT INTO `phpbb_modules` VALUES (16, 1, 1, '', 'acp', 0, 427, 474, 'ACP_CAT_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES (17, 1, 1, '', 'acp', 16, 430, 439, 'ACP_GLOBAL_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES (18, 1, 1, '', 'acp', 16, 440, 449, 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES (19, 1, 1, '', 'acp', 16, 450, 459, 'ACP_PERMISSION_ROLES', '', '');
INSERT INTO `phpbb_modules` VALUES (20, 1, 1, '', 'acp', 16, 460, 473, 'ACP_PERMISSION_MASKS', '', '');
INSERT INTO `phpbb_modules` VALUES (21, 1, 1, '', 'acp', 0, 475, 488, 'ACP_CAT_STYLES', '', '');
INSERT INTO `phpbb_modules` VALUES (22, 1, 1, '', 'acp', 21, 476, 479, 'ACP_STYLE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES (23, 1, 1, '', 'acp', 21, 480, 487, 'ACP_STYLE_COMPONENTS', '', '');
INSERT INTO `phpbb_modules` VALUES (24, 1, 1, '', 'acp', 0, 489, 508, 'ACP_CAT_MAINTENANCE', '', '');
INSERT INTO `phpbb_modules` VALUES (25, 1, 1, '', 'acp', 24, 490, 499, 'ACP_FORUM_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES (26, 1, 1, '', 'acp', 24, 500, 507, 'ACP_CAT_DATABASE', '', '');
INSERT INTO `phpbb_modules` VALUES (27, 1, 1, '', 'acp', 0, 523, 546, 'ACP_CAT_SYSTEM', '', '');
INSERT INTO `phpbb_modules` VALUES (28, 1, 1, '', 'acp', 27, 524, 525, 'ACP_AUTOMATION', '', '');
INSERT INTO `phpbb_modules` VALUES (29, 1, 1, '', 'acp', 27, 526, 537, 'ACP_GENERAL_TASKS', '', '');
INSERT INTO `phpbb_modules` VALUES (30, 1, 1, '', 'acp', 27, 538, 545, 'ACP_MODULE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES (31, 1, 1, '', 'acp', 0, 547, 548, 'ACP_CAT_DOT_MODS', '', '');
INSERT INTO `phpbb_modules` VALUES (32, 1, 1, 'attachments', 'acp', 3, 293, 294, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES (33, 1, 1, 'attachments', 'acp', 11, 365, 366, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES (34, 1, 1, 'attachments', 'acp', 11, 367, 368, 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES (35, 1, 1, 'attachments', 'acp', 11, 369, 370, 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES (36, 1, 1, 'attachments', 'acp', 11, 371, 372, 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES (37, 1, 1, 'ban', 'acp', 15, 415, 416, 'ACP_BAN_EMAILS', 'email', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES (38, 1, 1, 'ban', 'acp', 15, 417, 418, 'ACP_BAN_IPS', 'ip', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES (39, 1, 1, 'ban', 'acp', 15, 419, 420, 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES (40, 1, 1, 'bbcodes', 'acp', 10, 353, 354, 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode');
INSERT INTO `phpbb_modules` VALUES (41, 1, 1, 'board', 'acp', 3, 295, 296, 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (42, 1, 1, 'board', 'acp', 3, 297, 298, 'ACP_BOARD_FEATURES', 'features', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (43, 1, 1, 'board', 'acp', 3, 299, 300, 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (44, 1, 1, 'board', 'acp', 3, 301, 302, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (45, 1, 1, 'board', 'acp', 10, 355, 356, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (46, 1, 1, 'board', 'acp', 3, 303, 304, 'ACP_POST_SETTINGS', 'post', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (47, 1, 1, 'board', 'acp', 3, 305, 306, 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (48, 1, 1, 'board', 'acp', 3, 307, 308, 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (49, 1, 1, 'board', 'acp', 3, 309, 310, 'ACP_VC_SETTINGS', 'visual', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES (50, 1, 1, 'board', 'acp', 4, 313, 314, 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (51, 1, 1, 'board', 'acp', 4, 315, 316, 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (52, 1, 1, 'board', 'acp', 5, 321, 322, 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (53, 1, 1, 'board', 'acp', 5, 323, 324, 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (54, 1, 1, 'board', 'acp', 5, 325, 326, 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (55, 1, 1, 'board', 'acp', 5, 327, 328, 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES (56, 1, 1, 'bots', 'acp', 29, 527, 528, 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES (57, 1, 1, 'database', 'acp', 26, 501, 502, 'ACP_BACKUP', 'backup', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES (58, 1, 1, 'database', 'acp', 26, 503, 504, 'ACP_RESTORE', 'restore', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES (59, 1, 1, 'disallow', 'acp', 15, 421, 422, 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names');
INSERT INTO `phpbb_modules` VALUES (60, 1, 1, 'email', 'acp', 29, 529, 530, 'ACP_MASS_EMAIL', 'email', 'acl_a_email');
INSERT INTO `phpbb_modules` VALUES (61, 1, 1, 'forums', 'acp', 7, 335, 336, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES (62, 1, 1, 'groups', 'acp', 14, 407, 408, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES (63, 1, 1, 'icons', 'acp', 10, 357, 358, 'ACP_ICONS', 'icons', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES (64, 1, 1, 'icons', 'acp', 10, 359, 360, 'ACP_SMILIES', 'smilies', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES (65, 1, 1, 'jabber', 'acp', 4, 317, 318, 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber');
INSERT INTO `phpbb_modules` VALUES (66, 1, 1, 'language', 'acp', 29, 531, 532, 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language');
INSERT INTO `phpbb_modules` VALUES (67, 1, 1, 'logs', 'acp', 25, 491, 492, 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES (68, 1, 1, 'logs', 'acp', 25, 493, 494, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES (69, 1, 1, 'logs', 'acp', 25, 495, 496, 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES (70, 1, 1, 'logs', 'acp', 25, 497, 498, 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES (71, 1, 1, 'main', 'acp', 1, 276, 277, 'ACP_INDEX', 'main', '');
INSERT INTO `phpbb_modules` VALUES (72, 1, 1, 'modules', 'acp', 30, 539, 540, 'ACP', 'acp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES (73, 1, 1, 'modules', 'acp', 30, 541, 542, 'UCP', 'ucp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES (74, 1, 1, 'modules', 'acp', 30, 543, 544, 'MCP', 'mcp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES (75, 1, 1, 'permission_roles', 'acp', 19, 451, 452, 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles');
INSERT INTO `phpbb_modules` VALUES (76, 1, 1, 'permission_roles', 'acp', 19, 453, 454, 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles');
INSERT INTO `phpbb_modules` VALUES (77, 1, 1, 'permission_roles', 'acp', 19, 455, 456, 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles');
INSERT INTO `phpbb_modules` VALUES (78, 1, 1, 'permission_roles', 'acp', 19, 457, 458, 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles');
INSERT INTO `phpbb_modules` VALUES (79, 1, 1, 'permissions', 'acp', 16, 428, 429, 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (80, 1, 0, 'permissions', 'acp', 20, 461, 462, 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (81, 1, 1, 'permissions', 'acp', 18, 441, 442, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (82, 1, 1, 'permissions', 'acp', 18, 443, 444, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (83, 1, 1, 'permissions', 'acp', 17, 431, 432, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES (84, 1, 1, 'permissions', 'acp', 13, 377, 378, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES (85, 1, 1, 'permissions', 'acp', 18, 445, 446, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (86, 1, 1, 'permissions', 'acp', 13, 379, 380, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (87, 1, 1, 'permissions', 'acp', 17, 433, 434, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES (88, 1, 1, 'permissions', 'acp', 14, 409, 410, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES (89, 1, 1, 'permissions', 'acp', 18, 447, 448, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (90, 1, 1, 'permissions', 'acp', 14, 411, 412, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (91, 1, 1, 'permissions', 'acp', 17, 435, 436, 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (92, 1, 1, 'permissions', 'acp', 17, 437, 438, 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (93, 1, 1, 'permissions', 'acp', 20, 463, 464, 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (94, 1, 1, 'permissions', 'acp', 20, 465, 466, 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (95, 1, 1, 'permissions', 'acp', 20, 467, 468, 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (96, 1, 1, 'permissions', 'acp', 20, 469, 470, 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (97, 1, 1, 'permissions', 'acp', 20, 471, 472, 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (98, 1, 1, 'php_info', 'acp', 29, 533, 534, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES (99, 1, 1, 'profile', 'acp', 13, 381, 382, 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile');
INSERT INTO `phpbb_modules` VALUES (100, 1, 1, 'prune', 'acp', 7, 337, 338, 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune');
INSERT INTO `phpbb_modules` VALUES (101, 1, 1, 'prune', 'acp', 15, 423, 424, 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel');
INSERT INTO `phpbb_modules` VALUES (102, 1, 1, 'ranks', 'acp', 13, 383, 384, 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks');
INSERT INTO `phpbb_modules` VALUES (103, 1, 1, 'reasons', 'acp', 29, 535, 536, 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons');
INSERT INTO `phpbb_modules` VALUES (104, 1, 1, 'search', 'acp', 5, 329, 330, 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES (105, 1, 1, 'search', 'acp', 26, 505, 506, 'ACP_SEARCH_INDEX', 'index', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES (106, 1, 1, 'styles', 'acp', 22, 477, 478, 'ACP_STYLES', 'style', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES (107, 1, 1, 'styles', 'acp', 23, 481, 482, 'ACP_TEMPLATES', 'template', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES (108, 1, 1, 'styles', 'acp', 23, 483, 484, 'ACP_THEMES', 'theme', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES (109, 1, 1, 'styles', 'acp', 23, 485, 486, 'ACP_IMAGESETS', 'imageset', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES (110, 1, 1, 'users', 'acp', 13, 385, 386, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (111, 1, 0, 'users', 'acp', 13, 387, 388, 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (112, 1, 0, 'users', 'acp', 13, 389, 390, 'ACP_USER_PROFILE', 'profile', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (113, 1, 0, 'users', 'acp', 13, 391, 392, 'ACP_USER_PREFS', 'prefs', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (114, 1, 0, 'users', 'acp', 13, 393, 394, 'ACP_USER_AVATAR', 'avatar', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (115, 1, 0, 'users', 'acp', 13, 395, 396, 'ACP_USER_RANK', 'rank', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (116, 1, 0, 'users', 'acp', 13, 397, 398, 'ACP_USER_SIG', 'sig', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (117, 1, 0, 'users', 'acp', 13, 399, 400, 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group');
INSERT INTO `phpbb_modules` VALUES (118, 1, 0, 'users', 'acp', 13, 401, 402, 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES (119, 1, 0, 'users', 'acp', 13, 403, 404, 'ACP_USER_ATTACH', 'attach', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (120, 1, 1, 'words', 'acp', 10, 361, 362, 'ACP_WORDS', 'words', 'acl_a_words');
INSERT INTO `phpbb_modules` VALUES (121, 1, 1, 'users', 'acp', 2, 279, 280, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES (122, 1, 1, 'groups', 'acp', 2, 281, 282, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES (123, 1, 1, 'forums', 'acp', 2, 283, 284, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES (124, 1, 1, 'logs', 'acp', 2, 285, 286, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES (125, 1, 1, 'bots', 'acp', 2, 287, 288, 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES (126, 1, 1, 'php_info', 'acp', 2, 289, 290, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES (127, 1, 1, 'permissions', 'acp', 8, 341, 342, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (128, 1, 1, 'permissions', 'acp', 8, 343, 344, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES (129, 1, 1, 'permissions', 'acp', 8, 345, 346, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (130, 1, 1, 'permissions', 'acp', 8, 347, 348, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES (131, 1, 1, '', 'mcp', 0, 59, 68, 'MCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES (132, 1, 1, '', 'mcp', 0, 69, 76, 'MCP_QUEUE', '', '');
INSERT INTO `phpbb_modules` VALUES (133, 1, 1, '', 'mcp', 0, 77, 84, 'MCP_REPORTS', '', '');
INSERT INTO `phpbb_modules` VALUES (134, 1, 1, '', 'mcp', 0, 85, 90, 'MCP_NOTES', '', '');
INSERT INTO `phpbb_modules` VALUES (135, 1, 1, '', 'mcp', 0, 91, 100, 'MCP_WARN', '', '');
INSERT INTO `phpbb_modules` VALUES (136, 1, 1, '', 'mcp', 0, 101, 108, 'MCP_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES (137, 1, 1, '', 'mcp', 0, 109, 116, 'MCP_BAN', '', '');
INSERT INTO `phpbb_modules` VALUES (138, 1, 1, 'ban', 'mcp', 137, 110, 111, 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES (139, 1, 1, 'ban', 'mcp', 137, 112, 113, 'MCP_BAN_IPS', 'ip', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES (140, 1, 1, 'ban', 'mcp', 137, 114, 115, 'MCP_BAN_EMAILS', 'email', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES (141, 1, 1, 'logs', 'mcp', 136, 102, 103, 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_');
INSERT INTO `phpbb_modules` VALUES (142, 1, 1, 'logs', 'mcp', 136, 104, 105, 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES (143, 1, 1, 'logs', 'mcp', 136, 106, 107, 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES (144, 1, 1, 'main', 'mcp', 131, 60, 61, 'MCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES (145, 1, 1, 'main', 'mcp', 131, 62, 63, 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES (146, 1, 1, 'main', 'mcp', 131, 64, 65, 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES (147, 1, 1, 'main', 'mcp', 131, 66, 67, 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_,$id || (!$id && aclf_m_)');
INSERT INTO `phpbb_modules` VALUES (148, 1, 1, 'notes', 'mcp', 134, 86, 87, 'MCP_NOTES_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES (149, 1, 1, 'notes', 'mcp', 134, 88, 89, 'MCP_NOTES_USER', 'user_notes', '');
INSERT INTO `phpbb_modules` VALUES (150, 1, 1, 'queue', 'mcp', 132, 70, 71, 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES (151, 1, 1, 'queue', 'mcp', 132, 72, 73, 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES (152, 1, 1, 'queue', 'mcp', 132, 74, 75, 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve,$id || (!$id && aclf_m_approve)');
INSERT INTO `phpbb_modules` VALUES (153, 1, 1, 'reports', 'mcp', 133, 78, 79, 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES (154, 1, 1, 'reports', 'mcp', 133, 80, 81, 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES (155, 1, 1, 'reports', 'mcp', 133, 82, 83, 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report,$id || (!$id && aclf_m_report)');
INSERT INTO `phpbb_modules` VALUES (156, 1, 1, 'warn', 'mcp', 135, 92, 93, 'MCP_WARN_FRONT', 'front', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES (157, 1, 1, 'warn', 'mcp', 135, 94, 95, 'MCP_WARN_LIST', 'list', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES (158, 1, 1, 'warn', 'mcp', 135, 96, 97, 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES (159, 1, 1, 'warn', 'mcp', 135, 98, 99, 'MCP_WARN_POST', 'warn_post', 'acl_m_warn,$id || (!$id && aclf_m_warn)');
INSERT INTO `phpbb_modules` VALUES (160, 1, 1, '', 'ucp', 0, 57, 66, 'UCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES (161, 1, 1, '', 'ucp', 0, 67, 76, 'UCP_PROFILE', '', '');
INSERT INTO `phpbb_modules` VALUES (162, 1, 1, '', 'ucp', 0, 77, 84, 'UCP_PREFS', '', '');
INSERT INTO `phpbb_modules` VALUES (163, 1, 1, '', 'ucp', 0, 85, 96, 'UCP_PM', '', '');
INSERT INTO `phpbb_modules` VALUES (164, 1, 1, '', 'ucp', 0, 97, 102, 'UCP_USERGROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES (165, 1, 1, '', 'ucp', 0, 103, 106, 'UCP_ATTACHMENTS', '', '');
INSERT INTO `phpbb_modules` VALUES (166, 1, 1, '', 'ucp', 0, 107, 112, 'UCP_ZEBRA', '', '');
INSERT INTO `phpbb_modules` VALUES (167, 1, 1, 'attachments', 'ucp', 165, 104, 105, 'UCP_ATTACHMENTS', 'attachments', 'acl_u_attach');
INSERT INTO `phpbb_modules` VALUES (168, 1, 1, 'groups', 'ucp', 164, 98, 99, 'UCP_USERGROUPS_MEMBER', 'membership', '');
INSERT INTO `phpbb_modules` VALUES (169, 1, 1, 'groups', 'ucp', 164, 100, 101, 'UCP_USERGROUPS_MANAGE', 'manage', '');
INSERT INTO `phpbb_modules` VALUES (170, 1, 1, 'main', 'ucp', 160, 58, 59, 'UCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES (171, 1, 1, 'main', 'ucp', 160, 60, 61, 'UCP_MAIN_SUBSCRIBED', 'subscribed', '');
INSERT INTO `phpbb_modules` VALUES (172, 1, 1, 'main', 'ucp', 160, 62, 63, 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks');
INSERT INTO `phpbb_modules` VALUES (173, 1, 1, 'main', 'ucp', 160, 64, 65, 'UCP_MAIN_DRAFTS', 'drafts', '');
INSERT INTO `phpbb_modules` VALUES (174, 1, 0, 'pm', 'ucp', 163, 86, 87, 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES (175, 1, 1, 'pm', 'ucp', 163, 88, 89, 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES (176, 1, 1, 'pm', 'ucp', 163, 90, 91, 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES (177, 1, 1, 'pm', 'ucp', 163, 92, 93, 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES (178, 1, 0, 'pm', 'ucp', 163, 94, 95, 'UCP_PM_POPUP_TITLE', 'popup', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES (179, 1, 1, 'prefs', 'ucp', 162, 78, 79, 'UCP_PREFS_PERSONAL', 'personal', '');
INSERT INTO `phpbb_modules` VALUES (180, 1, 1, 'prefs', 'ucp', 162, 80, 81, 'UCP_PREFS_VIEW', 'view', '');
INSERT INTO `phpbb_modules` VALUES (181, 1, 1, 'prefs', 'ucp', 162, 82, 83, 'UCP_PREFS_POST', 'post', '');
INSERT INTO `phpbb_modules` VALUES (182, 1, 1, 'profile', 'ucp', 161, 68, 69, 'UCP_PROFILE_REG_DETAILS', 'reg_details', '');
INSERT INTO `phpbb_modules` VALUES (183, 1, 1, 'profile', 'ucp', 161, 70, 71, 'UCP_PROFILE_PROFILE_INFO', 'profile_info', '');
INSERT INTO `phpbb_modules` VALUES (184, 1, 1, 'profile', 'ucp', 161, 72, 73, 'UCP_PROFILE_SIGNATURE', 'signature', '');
INSERT INTO `phpbb_modules` VALUES (185, 1, 1, 'profile', 'ucp', 161, 74, 75, 'UCP_PROFILE_AVATAR', 'avatar', '');
INSERT INTO `phpbb_modules` VALUES (186, 1, 1, 'zebra', 'ucp', 166, 108, 109, 'UCP_ZEBRA_FRIENDS', 'friends', '');
INSERT INTO `phpbb_modules` VALUES (187, 1, 1, 'zebra', 'ucp', 166, 110, 111, 'UCP_ZEBRA_FOES', 'foes', '');
INSERT INTO `phpbb_modules` VALUES (188, 1, 1, '', 'acp', 0, 509, 522, 'ACP_PACMAN', '', '');
INSERT INTO `phpbb_modules` VALUES (189, 1, 1, 'pacman', 'acp', 194, 511, 512, 'ACP_PACMAN', 'intro', 'acl_a_pacman');
INSERT INTO `phpbb_modules` VALUES (190, 1, 1, 'pacman', 'acp', 193, 515, 516, 'ACP_PACMAN_MANAGE', 'manage', 'acl_a_pacman');
INSERT INTO `phpbb_modules` VALUES (191, 1, 1, 'pacman', 'acp', 193, 517, 518, 'ACP_PACMAN_BROWSE', 'browse', 'acl_a_pacman');
INSERT INTO `phpbb_modules` VALUES (192, 1, 1, 'pacman', 'acp', 193, 519, 520, 'ACP_PACMAN_UPLOAD', 'upload', 'acl_a_pacman');
INSERT INTO `phpbb_modules` VALUES (193, 1, 1, '', 'acp', 188, 514, 521, 'ACP_PACMAN_PACKAGES', '', '');
INSERT INTO `phpbb_modules` VALUES (194, 1, 1, '', 'acp', 188, 510, 513, 'ACP_PACMAN_GENERAL', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_packages`
-- 

CREATE TABLE `phpbb_packages` (
  `package_id` int(8) NOT NULL auto_increment,
  `package_name` varchar(255) NOT NULL default '',
  `package_desc` text NOT NULL,
  `package_version` varchar(100) NOT NULL default '',
  `package_path` varchar(255) NOT NULL default '',
  `package_store` varchar(255) NOT NULL default '',
  `package_author_name` varchar(255) NOT NULL default '',
  `package_author_email` varchar(255) NOT NULL default '',
  `package_author_url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_packages`
-- 

INSERT INTO `phpbb_packages` VALUES (1, 'Dummy1', 'A Dummy package installation', '0.0.0.0.0.1', 'Dummy', '', 'Kettle', 'dfg@df.dfg', 'http://web.site');
INSERT INTO `phpbb_packages` VALUES (2, 'Dummy2', 'Another Dummy package, for kicks', '57 million', 'Dummy_2', '', 'Bummer', 'sfdG@fdg.dfg.', '');
INSERT INTO `phpbb_packages` VALUES (25, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'uber_mod/my.uber_mod_install.mod', 'my.uber_mod_install.mod_1156635237', 'The good', 'N/A', 'http://theugly.com');
INSERT INTO `phpbb_packages` VALUES (24, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'uber_mod/my.uber_mod_install.mod', 'my.uber_mod_install.mod_1156635217', 'The good', 'N/A', 'http://theugly.com');
INSERT INTO `phpbb_packages` VALUES (23, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'uber_mod/my.uber_mod_install.mod', 'my.uber_mod_install.mod_1156634702', 'The good', 'N/A', 'http://theugly.com');
INSERT INTO `phpbb_packages` VALUES (19, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'my.uber_mod_install.mod', 'my.uber_mod_install.mod_1155339338', 'The good', 'N/A', 'http://theugly.com');
INSERT INTO `phpbb_packages` VALUES (20, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'my.uber_mod_install.mod', 'my.uber_mod_install.mod_1155339372', 'The good', 'N/A', 'http://theugly.com');
INSERT INTO `phpbb_packages` VALUES (22, 'My UBER'' MOD!!', 'My uber mod is just like omgwtf the lol best mod ever', '1.7.0a', 'uber_mod/my.uber_mod_install.mod', 'my.uber_mod_install.mod_1155739238', 'The good', 'N/A', 'http://theugly.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_poll_options`
-- 

CREATE TABLE `phpbb_poll_options` (
  `poll_option_id` tinyint(4) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `poll_option_text` text,
  `poll_option_total` mediumint(8) unsigned NOT NULL default '0',
  KEY `poll_option_id` (`poll_option_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_poll_options`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_poll_votes`
-- 

CREATE TABLE `phpbb_poll_votes` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `poll_option_id` tinyint(4) unsigned NOT NULL default '0',
  `vote_user_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_user_ip` varchar(40) NOT NULL default '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_poll_votes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_posts`
-- 

CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '0',
  `poster_ip` varchar(40) NOT NULL default '',
  `post_time` int(11) NOT NULL default '0',
  `post_approved` tinyint(1) NOT NULL default '1',
  `post_reported` tinyint(1) NOT NULL default '0',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_magic_url` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `post_username` varchar(255) default NULL,
  `post_subject` text NOT NULL,
  `post_text` mediumtext NOT NULL,
  `post_checksum` varchar(32) NOT NULL default '',
  `post_encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `post_attachment` tinyint(1) NOT NULL default '0',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(5) NOT NULL default '',
  `post_edit_time` int(11) unsigned default '0',
  `post_edit_reason` text,
  `post_edit_user` mediumint(8) unsigned default '0',
  `post_edit_count` smallint(5) unsigned default '0',
  `post_edit_locked` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `post_approved` (`post_approved`),
  KEY `post_time` (`post_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_posts`
-- 

INSERT INTO `phpbb_posts` VALUES (1, 1, 2, 2, 1, '127.0.0.1', 1150830232, 1, 0, 1, 1, 1, 1, NULL, 'Welcome to phpBB 3', 'This is an example post in your phpBB 3.0 installation. You may delete this post, this topic and even this forum if you like since everything seems to be working!', '5dd683b17f641daf84c040bfefc58ce9', 'iso-8859-1', 0, 0, '', 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_privmsgs`
-- 

CREATE TABLE `phpbb_privmsgs` (
  `msg_id` mediumint(8) unsigned NOT NULL auto_increment,
  `root_level` mediumint(8) unsigned NOT NULL default '0',
  `author_id` mediumint(8) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '0',
  `author_ip` varchar(40) NOT NULL default '',
  `message_time` int(11) NOT NULL default '0',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_magic_url` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `message_subject` text NOT NULL,
  `message_text` mediumtext NOT NULL,
  `message_edit_reason` text,
  `message_edit_user` mediumint(8) unsigned default '0',
  `message_encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `message_attachment` tinyint(1) NOT NULL default '0',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(5) NOT NULL default '',
  `message_edit_time` int(11) unsigned default '0',
  `message_edit_count` smallint(5) unsigned default '0',
  `to_address` text NOT NULL,
  `bcc_address` text NOT NULL,
  PRIMARY KEY  (`msg_id`),
  KEY `author_ip` (`author_ip`),
  KEY `message_time` (`message_time`),
  KEY `author_id` (`author_id`),
  KEY `root_level` (`root_level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_privmsgs`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_privmsgs_folder`
-- 

CREATE TABLE `phpbb_privmsgs_folder` (
  `folder_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `folder_name` varchar(255) NOT NULL default '',
  `pm_count` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`folder_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_privmsgs_folder`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_privmsgs_rules`
-- 

CREATE TABLE `phpbb_privmsgs_rules` (
  `rule_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_check` mediumint(4) unsigned NOT NULL default '0',
  `rule_connection` mediumint(4) unsigned NOT NULL default '0',
  `rule_string` varchar(255) NOT NULL default '',
  `rule_user_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_group_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_action` mediumint(4) unsigned NOT NULL default '0',
  `rule_folder_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_privmsgs_rules`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_privmsgs_to`
-- 

CREATE TABLE `phpbb_privmsgs_to` (
  `msg_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `author_id` mediumint(8) unsigned NOT NULL default '0',
  `deleted` tinyint(1) unsigned NOT NULL default '0',
  `new` tinyint(1) unsigned NOT NULL default '1',
  `unread` tinyint(1) unsigned NOT NULL default '1',
  `replied` tinyint(1) unsigned NOT NULL default '0',
  `marked` tinyint(1) unsigned NOT NULL default '0',
  `forwarded` tinyint(1) unsigned NOT NULL default '0',
  `folder_id` int(10) NOT NULL default '0',
  KEY `msg_id` (`msg_id`),
  KEY `user_id` (`user_id`,`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_privmsgs_to`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_profile_fields`
-- 

CREATE TABLE `phpbb_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_name` varchar(255) NOT NULL default '',
  `field_type` mediumint(8) unsigned NOT NULL default '0',
  `field_ident` varchar(20) NOT NULL default '',
  `field_length` varchar(20) NOT NULL default '',
  `field_minlen` varchar(255) NOT NULL default '',
  `field_maxlen` varchar(255) NOT NULL default '',
  `field_novalue` varchar(255) NOT NULL default '',
  `field_default_value` varchar(255) NOT NULL default '0',
  `field_validation` varchar(20) NOT NULL default '',
  `field_required` tinyint(1) unsigned NOT NULL default '0',
  `field_show_on_reg` tinyint(1) unsigned NOT NULL default '0',
  `field_hide` tinyint(1) unsigned NOT NULL default '0',
  `field_no_view` tinyint(1) unsigned NOT NULL default '0',
  `field_active` tinyint(1) unsigned NOT NULL default '0',
  `field_order` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`field_id`),
  KEY `field_type` (`field_type`),
  KEY `field_order` (`field_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_profile_fields`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_profile_fields_data`
-- 

CREATE TABLE `phpbb_profile_fields_data` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_profile_fields_data`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_profile_fields_lang`
-- 

CREATE TABLE `phpbb_profile_fields_lang` (
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_id` mediumint(8) unsigned NOT NULL default '0',
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `field_type` tinyint(4) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`field_id`,`lang_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_profile_fields_lang`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_profile_lang`
-- 

CREATE TABLE `phpbb_profile_lang` (
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_id` tinyint(4) unsigned NOT NULL default '0',
  `lang_name` varchar(255) NOT NULL default '',
  `lang_explain` text,
  `lang_default_value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`field_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_profile_lang`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_ranks`
-- 

CREATE TABLE `phpbb_ranks` (
  `rank_id` smallint(5) unsigned NOT NULL auto_increment,
  `rank_title` varchar(255) NOT NULL default '',
  `rank_min` mediumint(8) NOT NULL default '0',
  `rank_special` tinyint(1) default '0',
  `rank_image` varchar(255) default NULL,
  PRIMARY KEY  (`rank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_ranks`
-- 

INSERT INTO `phpbb_ranks` VALUES (1, 'Site Admin', -1, 1, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_reports`
-- 

CREATE TABLE `phpbb_reports` (
  `report_id` smallint(5) unsigned NOT NULL auto_increment,
  `reason_id` smallint(5) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `user_notify` tinyint(1) NOT NULL default '0',
  `report_closed` tinyint(1) NOT NULL default '0',
  `report_time` int(11) unsigned NOT NULL default '0',
  `report_text` mediumtext,
  PRIMARY KEY  (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_reports`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_reports_reasons`
-- 

CREATE TABLE `phpbb_reports_reasons` (
  `reason_id` smallint(6) NOT NULL auto_increment,
  `reason_title` varchar(255) NOT NULL default '',
  `reason_description` text,
  `reason_order` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`reason_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_reports_reasons`
-- 

INSERT INTO `phpbb_reports_reasons` VALUES (1, 'warez', 'The reported post contains links to pirated or illegal software', 1);
INSERT INTO `phpbb_reports_reasons` VALUES (2, 'spam', 'The reported post has for only purpose to advertise for a website or another product', 2);
INSERT INTO `phpbb_reports_reasons` VALUES (3, 'off_topic', 'The reported post is off topic', 3);
INSERT INTO `phpbb_reports_reasons` VALUES (4, 'other', 'The reported post does not fit into any other category (please use the description field)', 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_search_results`
-- 

CREATE TABLE `phpbb_search_results` (
  `search_key` varchar(32) NOT NULL default '',
  `search_time` int(11) NOT NULL default '0',
  `search_keywords` mediumtext,
  `search_authors` mediumtext,
  PRIMARY KEY  (`search_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_search_results`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_search_wordlist`
-- 

CREATE TABLE `phpbb_search_wordlist` (
  `word_text` varchar(252) character set latin1 collate latin1_bin NOT NULL default '',
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word_common` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_search_wordlist`
-- 

INSERT INTO `phpbb_search_wordlist` VALUES (0x6578616d706c65, 1, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x706f7374, 2, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x7068706262, 3, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x696e7374616c6c6174696f6e, 4, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x64656c657465, 5, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x746f706963, 6, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x666f72756d, 7, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x73696e6365, 8, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x65766572797468696e67, 9, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x7365656d73, 10, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x776f726b696e67, 11, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x77656c636f6d65, 12, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_search_wordmatch`
-- 

CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `title_match` tinyint(1) NOT NULL default '0',
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_search_wordmatch`
-- 

INSERT INTO `phpbb_search_wordmatch` VALUES (1, 1, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 2, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 3, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 4, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 5, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 6, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 7, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 8, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 9, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 10, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 11, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 12, 1);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 3, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_sessions`
-- 

CREATE TABLE `phpbb_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `session_user_id` mediumint(8) unsigned NOT NULL default '0',
  `session_last_visit` int(11) NOT NULL default '0',
  `session_start` int(11) NOT NULL default '0',
  `session_time` int(11) NOT NULL default '0',
  `session_ip` varchar(40) NOT NULL default '0',
  `session_browser` varchar(150) NOT NULL default '',
  `session_page` varchar(200) NOT NULL default '',
  `session_viewonline` tinyint(1) NOT NULL default '1',
  `session_autologin` tinyint(1) NOT NULL default '0',
  `session_admin` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `session_time` (`session_time`),
  KEY `session_user_id` (`session_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_sessions`
-- 

INSERT INTO `phpbb_sessions` VALUES ('2b3c586530e2131f177eb93d71bd894f', 2, 1150844406, 1150844406, 1156974037, '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.0.4) Gecko/20060508 Firefox/1.5.0.4', 'adm/index.php?i=188', 1, 1, 1);
INSERT INTO `phpbb_sessions` VALUES ('177795d1634d9530cb8f49c7cf69b3b5', 8, 1156622515, 1156634311, 1156634679, '87.160.242.154', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=191&mode=browse&action=info&package_path=./../packages/pseudo_wysiwyg_bbcode_editor_1.7.0a/pseudo_wysiwyg_bbcode_editor_1.7.0a/install_pseudo_wysiwg.mod', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('ac3203d0086f04f5895f2f7e1b7dae17', 2, 1156623110, 1156634277, 1156635249, '86.144.89.108', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=pacman&mode=intro', 1, 1, 1);
INSERT INTO `phpbb_sessions` VALUES ('22af67da21369384c3ed59845b57b586', 8, 1156622515, 1156634205, 1156634419, '87.243.193.183', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=190&mode=manage&action=info&package_id=22', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('ef64a565058fe80335937ef97501f95f', 8, 1156622515, 1156634208, 1156634652, '70.112.115.176', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=pacman&mode=browse', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('461e10da3e611c4c6fc0f39d1facc21f', 8, 1156622515, 1156634195, 1156634786, '209.180.90.179', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.0.6) Gecko/20060728 SUSE/1.5.0.6-1.4 Firefox/1.5.0.6', 'adm/index.php?i=191&mode=browse&action=install&package_path=./../packages/pseudo_wysiwyg_bbcode_editor_1.7.0a/pseudo_wysiwyg_bbcode_editor_1.7.0a/install_pseudo_wysiwg.mod', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('6b0145f59ffbaa4334ea8508857a70b9', 8, 1156622515, 1156634300, 1156634727, '219.84.30.172', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-TW; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=191&mode=browse&action=check_install&package_path=./../packages/uber_mod/my.uber_mod_install.mod', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('b924a70e4b6bde63ed60d97585f5730b', 8, 1156622515, 1156645001, 1156645069, '82.34.240.141', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9a1) Gecko/20060822 Minefield/3.0a1', 'adm/index.php?i=pacman&mode=browse', 1, 0, 1);
INSERT INTO `phpbb_sessions` VALUES ('ae9c7e8f7de1918bc94bb7cce0d6de26', 8, 1156622515, 1156671213, 1156671324, '80.139.105.25', 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.8.0.6) Gecko/20060728 Firefox/1.5.0.6', 'adm/index.php?i=pacman&mode=browse', 1, 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_sessions_keys`
-- 

CREATE TABLE `phpbb_sessions_keys` (
  `key_id` varchar(32) NOT NULL default '',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `last_ip` varchar(40) NOT NULL default '',
  `last_login` int(11) NOT NULL default '0',
  PRIMARY KEY  (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_sessions_keys`
-- 

INSERT INTO `phpbb_sessions_keys` VALUES ('98b11d538614ef33dc161cba2f2405aa', 2, '127.0.0.1', 1150844406);
INSERT INTO `phpbb_sessions_keys` VALUES ('333201fe0a377842b9bacb5efff16f56', 2, '86.144.89.108', 1156634277);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_sitelist`
-- 

CREATE TABLE `phpbb_sitelist` (
  `site_id` mediumint(8) unsigned NOT NULL auto_increment,
  `site_ip` varchar(40) NOT NULL default '',
  `site_hostname` varchar(255) NOT NULL default '',
  `ip_exclude` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_sitelist`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_smilies`
-- 

CREATE TABLE `phpbb_smilies` (
  `smiley_id` tinyint(4) unsigned NOT NULL auto_increment,
  `code` varchar(50) default NULL,
  `emotion` varchar(50) default NULL,
  `smiley_url` varchar(50) default NULL,
  `smiley_width` tinyint(4) unsigned NOT NULL default '0',
  `smiley_height` tinyint(4) unsigned NOT NULL default '0',
  `smiley_order` tinyint(4) unsigned NOT NULL default '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`smiley_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_smilies`
-- 

INSERT INTO `phpbb_smilies` VALUES (1, ':D', 'Very Happy', 'icon_biggrin.gif', 15, 15, 1, 1);
INSERT INTO `phpbb_smilies` VALUES (2, ':)', 'Smile', 'icon_smile.gif', 15, 15, 2, 1);
INSERT INTO `phpbb_smilies` VALUES (3, ':(', 'Sad', 'icon_sad.gif', 15, 15, 3, 1);
INSERT INTO `phpbb_smilies` VALUES (4, ':o', 'Surprised', 'icon_surprised.gif', 15, 15, 4, 1);
INSERT INTO `phpbb_smilies` VALUES (5, ':eek:', 'Surprised', 'icon_surprised.gif', 15, 15, 5, 1);
INSERT INTO `phpbb_smilies` VALUES (6, '8O', 'Shocked', 'icon_eek.gif', 15, 15, 6, 1);
INSERT INTO `phpbb_smilies` VALUES (7, ':?', 'Confused', 'icon_confused.gif', 15, 15, 7, 1);
INSERT INTO `phpbb_smilies` VALUES (8, '8)', 'Cool', 'icon_cool.gif', 15, 15, 8, 1);
INSERT INTO `phpbb_smilies` VALUES (9, ':lol:', 'Laughing', 'icon_lol.gif', 15, 15, 9, 1);
INSERT INTO `phpbb_smilies` VALUES (10, ':x', 'Mad', 'icon_mad.gif', 15, 15, 10, 1);
INSERT INTO `phpbb_smilies` VALUES (11, ':P', 'Razz', 'icon_razz.gif', 15, 15, 11, 1);
INSERT INTO `phpbb_smilies` VALUES (12, ':oops:', 'Embarassed', 'icon_redface.gif', 15, 15, 12, 1);
INSERT INTO `phpbb_smilies` VALUES (13, ':cry:', 'Crying or Very sad', 'icon_cry.gif', 15, 15, 13, 1);
INSERT INTO `phpbb_smilies` VALUES (14, ':evil:', 'Evil or Very Mad', 'icon_evil.gif', 15, 15, 14, 1);
INSERT INTO `phpbb_smilies` VALUES (15, ':twisted:', 'Twisted Evil', 'icon_twisted.gif', 15, 15, 15, 1);
INSERT INTO `phpbb_smilies` VALUES (16, ':roll:', 'Rolling Eyes', 'icon_rolleyes.gif', 15, 15, 16, 1);
INSERT INTO `phpbb_smilies` VALUES (17, ';)', 'Wink', 'icon_wink.gif', 15, 15, 17, 1);
INSERT INTO `phpbb_smilies` VALUES (18, ':!:', 'Exclamation', 'icon_exclaim.gif', 15, 15, 18, 1);
INSERT INTO `phpbb_smilies` VALUES (19, ':?:', 'Question', 'icon_question.gif', 15, 15, 19, 1);
INSERT INTO `phpbb_smilies` VALUES (20, ':idea:', 'Idea', 'icon_idea.gif', 15, 15, 20, 1);
INSERT INTO `phpbb_smilies` VALUES (21, ':arrow:', 'Arrow', 'icon_arrow.gif', 15, 15, 21, 1);
INSERT INTO `phpbb_smilies` VALUES (22, ':|', 'Neutral', 'icon_neutral.gif', 15, 15, 22, 1);
INSERT INTO `phpbb_smilies` VALUES (23, ':mrgreen:', 'Mr. Green', 'icon_mrgreen.gif', 15, 15, 23, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_styles`
-- 

CREATE TABLE `phpbb_styles` (
  `style_id` tinyint(4) unsigned NOT NULL auto_increment,
  `style_name` varchar(255) NOT NULL default '',
  `style_copyright` varchar(255) NOT NULL default '',
  `style_active` tinyint(1) NOT NULL default '1',
  `template_id` tinyint(4) unsigned NOT NULL default '0',
  `theme_id` tinyint(4) unsigned NOT NULL default '0',
  `imageset_id` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`style_id`),
  UNIQUE KEY `style_name` (`style_name`),
  KEY `template_id` (`template_id`),
  KEY `theme_id` (`theme_id`),
  KEY `imageset_id` (`imageset_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_styles`
-- 

INSERT INTO `phpbb_styles` VALUES (1, 'subSilver', '&copy; phpBB Group', 1, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_styles_imageset`
-- 

CREATE TABLE `phpbb_styles_imageset` (
  `imageset_id` tinyint(4) unsigned NOT NULL auto_increment,
  `imageset_name` varchar(255) NOT NULL default '',
  `imageset_copyright` varchar(255) NOT NULL default '',
  `imageset_path` varchar(100) NOT NULL default '',
  `site_logo` varchar(200) NOT NULL default '',
  `btn_post` varchar(200) NOT NULL default '',
  `btn_post_pm` varchar(200) NOT NULL default '',
  `btn_reply` varchar(200) NOT NULL default '',
  `btn_reply_pm` varchar(200) NOT NULL default '',
  `btn_locked` varchar(200) NOT NULL default '',
  `btn_profile` varchar(200) NOT NULL default '',
  `btn_pm` varchar(200) NOT NULL default '',
  `btn_delete` varchar(200) NOT NULL default '',
  `btn_info` varchar(200) NOT NULL default '',
  `btn_quote` varchar(200) NOT NULL default '',
  `btn_search` varchar(200) NOT NULL default '',
  `btn_edit` varchar(200) NOT NULL default '',
  `btn_report` varchar(200) NOT NULL default '',
  `btn_email` varchar(200) NOT NULL default '',
  `btn_www` varchar(200) NOT NULL default '',
  `btn_icq` varchar(200) NOT NULL default '',
  `btn_aim` varchar(200) NOT NULL default '',
  `btn_yim` varchar(200) NOT NULL default '',
  `btn_msnm` varchar(200) NOT NULL default '',
  `btn_jabber` varchar(200) NOT NULL default '',
  `btn_online` varchar(200) NOT NULL default '',
  `btn_offline` varchar(200) NOT NULL default '',
  `btn_friend` varchar(200) NOT NULL default '',
  `btn_foe` varchar(200) NOT NULL default '',
  `icon_unapproved` varchar(200) NOT NULL default '',
  `icon_reported` varchar(200) NOT NULL default '',
  `icon_attach` varchar(200) NOT NULL default '',
  `icon_post` varchar(200) NOT NULL default '',
  `icon_post_new` varchar(200) NOT NULL default '',
  `icon_post_latest` varchar(200) NOT NULL default '',
  `icon_post_newest` varchar(200) NOT NULL default '',
  `forum` varchar(200) NOT NULL default '',
  `forum_new` varchar(200) NOT NULL default '',
  `forum_locked` varchar(200) NOT NULL default '',
  `forum_link` varchar(200) NOT NULL default '',
  `sub_forum` varchar(200) NOT NULL default '',
  `sub_forum_new` varchar(200) NOT NULL default '',
  `folder` varchar(200) NOT NULL default '',
  `folder_moved` varchar(200) NOT NULL default '',
  `folder_posted` varchar(200) NOT NULL default '',
  `folder_new` varchar(200) NOT NULL default '',
  `folder_new_posted` varchar(200) NOT NULL default '',
  `folder_hot` varchar(200) NOT NULL default '',
  `folder_hot_posted` varchar(200) NOT NULL default '',
  `folder_hot_new` varchar(200) NOT NULL default '',
  `folder_hot_new_posted` varchar(200) NOT NULL default '',
  `folder_locked` varchar(200) NOT NULL default '',
  `folder_locked_posted` varchar(200) NOT NULL default '',
  `folder_locked_new` varchar(200) NOT NULL default '',
  `folder_locked_new_posted` varchar(200) NOT NULL default '',
  `folder_sticky` varchar(200) NOT NULL default '',
  `folder_sticky_posted` varchar(200) NOT NULL default '',
  `folder_sticky_new` varchar(200) NOT NULL default '',
  `folder_sticky_new_posted` varchar(200) NOT NULL default '',
  `folder_announce` varchar(200) NOT NULL default '',
  `folder_announce_posted` varchar(200) NOT NULL default '',
  `folder_announce_new` varchar(200) NOT NULL default '',
  `folder_announce_new_posted` varchar(200) NOT NULL default '',
  `folder_global` varchar(200) NOT NULL default '',
  `folder_global_posted` varchar(200) NOT NULL default '',
  `folder_global_new` varchar(200) NOT NULL default '',
  `folder_global_new_posted` varchar(200) NOT NULL default '',
  `poll_left` varchar(200) NOT NULL default '',
  `poll_center` varchar(200) NOT NULL default '',
  `poll_right` varchar(200) NOT NULL default '',
  `attach_progress_bar` varchar(200) NOT NULL default '',
  `user_icon1` varchar(200) NOT NULL default '',
  `user_icon2` varchar(200) NOT NULL default '',
  `user_icon3` varchar(200) NOT NULL default '',
  `user_icon4` varchar(200) NOT NULL default '',
  `user_icon5` varchar(200) NOT NULL default '',
  `user_icon6` varchar(200) NOT NULL default '',
  `user_icon7` varchar(200) NOT NULL default '',
  `user_icon8` varchar(200) NOT NULL default '',
  `user_icon9` varchar(200) NOT NULL default '',
  `user_icon10` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`imageset_id`),
  UNIQUE KEY `imageset_name` (`imageset_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_styles_imageset`
-- 

INSERT INTO `phpbb_styles_imageset` VALUES (1, 'subSilver', '&copy; phpBB Group', 'subSilver', 'sitelogo.gif*94*170', '{LANG}/btn_post.gif*27*97', '{LANG}/btn_post_pm.gif*27*97', '{LANG}/btn_reply.gif*27*97', '{LANG}/btn_reply_pm.gif*20*90', '{LANG}/btn_locked.gif*27*97', '{LANG}/btn_profile.gif*20*72', '{LANG}/btn_pm.gif*20*72', '{LANG}/btn_delete.gif*20*20', '{LANG}/btn_info.gif*20*20', '{LANG}/btn_quote.gif*20*90', '{LANG}/btn_search.gif*20*72', '{LANG}/btn_edit.gif*20*90', '{LANG}/btn_report.gif*20*20', '{LANG}/btn_email.gif*20*72', '{LANG}/btn_www.gif*20*72', '{LANG}/btn_icq.gif*20*72', '{LANG}/btn_aim.gif*20*72', '{LANG}/btn_yim.gif*20*72', '{LANG}/btn_msnm.gif*20*72', '{LANG}/btn_jabber.gif*20*72', '{LANG}/btn_online.gif*20*72', '{LANG}/btn_offline.gif*20*72', '', '', 'icon_unapproved.gif*18*19', 'icon_reported.gif*18*19', 'icon_attach.gif*18*14', 'icon_minipost.gif*9*12', 'icon_minipost_new.gif*9*12', 'icon_latest_reply.gif*9*18', 'icon_newest_reply.gif*9*18', 'folder_big.gif*25*46', 'folder_new_big.gif*25*46', 'folder_locked_big.gif*25*46', 'folder_link_big.gif*25*46', 'subfolder_big.gif*25*46', 'subfolder_new_big.gif*25*46', 'folder.gif*18*19', 'folder_moved.gif*18*19', 'folder_posted.gif*18*19', 'folder_new.gif*18*19', 'folder_new_posted.gif*18*19', 'folder_hot.gif*18*19', 'folder_hot_posted.gif*18*19', 'folder_new_hot.gif*18*19', 'folder_new_hot_posted.gif*18*19', 'folder_lock.gif*18*19', 'folder_lock_posted.gif*18*19', 'folder_lock_new.gif*18*19', 'folder_lock_new_posted.gif*18*19', 'folder_sticky.gif*18*19', 'folder_sticky_posted.gif*18*19', 'folder_sticky_new.gif*18*19', 'folder_sticky_new_posted.gif*18*19', 'folder_announce.gif*18*19', 'folder_announce_posted.gif*18*19', 'folder_announce_new.gif*18*19', 'folder_announce_new_posted.gif*18*19', '', '', '', '', 'vote_lcap.gif*12*4', 'voting_bar.gif*12', 'vote_rcap.gif*12*4', 'progress_bar.gif*16*280', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_styles_template`
-- 

CREATE TABLE `phpbb_styles_template` (
  `template_id` tinyint(4) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL default '',
  `template_copyright` varchar(255) NOT NULL default '',
  `template_path` varchar(100) NOT NULL default '',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '6921',
  `template_storedb` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`template_id`),
  UNIQUE KEY `template_name` (`template_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_styles_template`
-- 

INSERT INTO `phpbb_styles_template` VALUES (1, 'subSilver', '&copy; phpBB Group', 'subSilver', 6921, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_styles_template_data`
-- 

CREATE TABLE `phpbb_styles_template_data` (
  `template_id` tinyint(4) unsigned NOT NULL default '0',
  `template_filename` varchar(100) NOT NULL default '',
  `template_included` text,
  `template_mtime` int(11) NOT NULL default '0',
  `template_data` mediumtext,
  KEY `template_id` (`template_id`),
  KEY `template_filename` (`template_filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_styles_template_data`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_styles_theme`
-- 

CREATE TABLE `phpbb_styles_theme` (
  `theme_id` tinyint(4) unsigned NOT NULL auto_increment,
  `theme_name` varchar(255) NOT NULL default '',
  `theme_copyright` varchar(255) NOT NULL default '',
  `theme_path` varchar(100) NOT NULL default '',
  `theme_storedb` tinyint(1) NOT NULL default '0',
  `theme_mtime` int(11) NOT NULL default '0',
  `theme_data` mediumtext,
  PRIMARY KEY  (`theme_id`),
  UNIQUE KEY `theme_name` (`theme_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_styles_theme`
-- 

INSERT INTO `phpbb_styles_theme` VALUES (1, 'subSilver', '&copy; phpBB Group', 'subSilver', 0, 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_topics`
-- 

CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '1',
  `topic_attachment` tinyint(1) NOT NULL default '0',
  `topic_approved` tinyint(1) unsigned NOT NULL default '1',
  `topic_reported` tinyint(1) unsigned NOT NULL default '0',
  `topic_title` text,
  `topic_poster` mediumint(8) unsigned NOT NULL default '0',
  `topic_time` int(11) NOT NULL default '0',
  `topic_time_limit` int(11) NOT NULL default '0',
  `topic_views` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies_real` mediumint(8) unsigned NOT NULL default '0',
  `topic_status` tinyint(3) NOT NULL default '0',
  `topic_type` tinyint(3) NOT NULL default '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_first_poster_name` varchar(255) default NULL,
  `topic_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_poster_name` varchar(255) default NULL,
  `topic_last_post_time` int(11) unsigned NOT NULL default '0',
  `topic_last_view_time` int(11) unsigned NOT NULL default '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL default '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL default '0',
  `poll_title` text,
  `poll_start` int(11) default '0',
  `poll_length` int(11) default '0',
  `poll_max_options` tinyint(4) unsigned NOT NULL default '1',
  `poll_last_vote` int(11) unsigned default '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `topic_last_post_time` (`topic_last_post_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_topics`
-- 

INSERT INTO `phpbb_topics` VALUES (1, 2, 1, 0, 1, 0, 'Welcome to phpBB 3', 2, 1150830232, 0, 0, 0, 0, 0, 0, 1, 'bkettle', 1, 2, 'bkettle', 1150830232, 972086460, 0, 0, 0, '', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_topics_posted`
-- 

CREATE TABLE `phpbb_topics_posted` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_posted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_topics_posted`
-- 

INSERT INTO `phpbb_topics_posted` VALUES (2, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_topics_track`
-- 

CREATE TABLE `phpbb_topics_track` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `mark_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_topics_track`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_topics_watch`
-- 

CREATE TABLE `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_topics_watch`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_user_group`
-- 

CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `group_leader` tinyint(1) NOT NULL default '0',
  `user_pending` tinyint(1) default NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_user_group`
-- 

INSERT INTO `phpbb_user_group` VALUES (1, 1, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (4, 2, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (7, 2, 1, 0);
INSERT INTO `phpbb_user_group` VALUES (8, 3, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (8, 4, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (8, 5, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (8, 6, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (4, 8, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_users`
-- 

CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_type` tinyint(1) NOT NULL default '0',
  `group_id` mediumint(8) NOT NULL default '3',
  `user_permissions` text,
  `user_perm_from` mediumint(8) default '0',
  `user_ip` varchar(40) NOT NULL default '',
  `user_regdate` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `user_password` varchar(40) NOT NULL default '',
  `user_passchg` int(11) default '0',
  `user_email` varchar(100) NOT NULL default '',
  `user_email_hash` bigint(20) NOT NULL default '0',
  `user_birthday` varchar(10) default '',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_lastmark` int(11) NOT NULL default '0',
  `user_lastpost_time` int(11) NOT NULL default '0',
  `user_lastpage` varchar(200) NOT NULL default '',
  `user_last_confirm_key` varchar(10) default '',
  `user_last_search` int(11) default '0',
  `user_warnings` tinyint(4) default '0',
  `user_last_warning` int(11) default '0',
  `user_login_attempts` smallint(4) default '0',
  `user_posts` mediumint(8) unsigned NOT NULL default '0',
  `user_lang` varchar(30) NOT NULL default '',
  `user_timezone` decimal(5,2) NOT NULL default '0.00',
  `user_dst` tinyint(1) NOT NULL default '0',
  `user_dateformat` varchar(30) NOT NULL default 'd M Y H:i',
  `user_style` tinyint(4) NOT NULL default '0',
  `user_rank` int(11) default '0',
  `user_colour` varchar(6) NOT NULL default '',
  `user_new_privmsg` tinyint(4) unsigned NOT NULL default '0',
  `user_unread_privmsg` tinyint(4) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL default '0',
  `user_full_folder` int(11) NOT NULL default '-3',
  `user_emailtime` int(11) NOT NULL default '0',
  `user_topic_show_days` smallint(4) NOT NULL default '0',
  `user_topic_sortby_type` char(1) NOT NULL default 't',
  `user_topic_sortby_dir` char(1) NOT NULL default 'd',
  `user_post_show_days` smallint(4) NOT NULL default '0',
  `user_post_sortby_type` char(1) NOT NULL default 't',
  `user_post_sortby_dir` char(1) NOT NULL default 'a',
  `user_notify` tinyint(1) NOT NULL default '0',
  `user_notify_pm` tinyint(1) NOT NULL default '1',
  `user_notify_type` tinyint(4) NOT NULL default '0',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_email` tinyint(1) NOT NULL default '1',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_allow_viewemail` tinyint(1) NOT NULL default '1',
  `user_allow_massemail` tinyint(1) NOT NULL default '1',
  `user_options` int(11) NOT NULL default '893',
  `user_avatar` varchar(255) NOT NULL default '',
  `user_avatar_type` tinyint(2) NOT NULL default '0',
  `user_avatar_width` tinyint(4) unsigned NOT NULL default '0',
  `user_avatar_height` tinyint(4) unsigned NOT NULL default '0',
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(5) default '',
  `user_sig_bbcode_bitfield` int(11) default '0',
  `user_from` varchar(100) default '',
  `user_icq` varchar(15) default '',
  `user_aim` varchar(255) default '',
  `user_yim` varchar(255) default '',
  `user_msnm` varchar(255) default '',
  `user_jabber` varchar(255) default '',
  `user_website` varchar(200) default '',
  `user_occ` varchar(255) default '',
  `user_interests` varchar(255) default '',
  `user_actkey` varchar(32) NOT NULL default '',
  `user_newpasswd` varchar(32) default '',
  PRIMARY KEY  (`user_id`),
  KEY `user_birthday` (`user_birthday`(6)),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `user_type` (`user_type`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_users`
-- 

INSERT INTO `phpbb_users` VALUES (1, 2, 1, '\ni1cgsw000000\ni1cgsw000000', 0, '', 1150830232, 'Anonymous', '', 0, '', 0, '', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, '', '', 0, '', '', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (2, 3, 7, '005m9rzik0zjzik0w0\ni1cgsw000000\nzik0zjzhxjwg', 0, '', 1150830232, 'bkettle', 'a10b9d22cd0dd90bbb5f076be86e3db8', 0, 'sr@fg.fg', 0, '', 1156623110, 0, 0, '', '', 0, 0, 0, 0, 1, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 1, 'AA0000', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (3, 2, 8, '', 0, '', 1150830234, 'Alexa', '', 0, '', 0, '', 0, 1150830234, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (4, 2, 8, '', 0, '', 1150830234, 'Fastcrawler', '', 0, '', 0, '', 0, 1150830234, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (5, 2, 8, '', 0, '', 1150830234, 'Googlebot', '', 0, '', 0, '', 0, 1150830234, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (6, 2, 8, '', 0, '', 1150830234, 'Inktomi', '', 0, '', 0, '', 0, 1150830234, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `phpbb_users` VALUES (8, 0, 4, '005m9rzik0zftys3gg\ni1cgsw000000\nq2m8ra000000', 0, '86.144.89.108', 1156621970, 'Test', 'ae2b1fca515949e5d54fb22b8ed95575', 0, 'test@test.test', 130107393914, '', 1156622515, 1156621970, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'D M d, Y g:i a', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_warnings`
-- 

CREATE TABLE `phpbb_warnings` (
  `warning_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `log_id` mediumint(8) unsigned NOT NULL default '0',
  `warning_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`warning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_warnings`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_words`
-- 

CREATE TABLE `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` varchar(255) NOT NULL default '',
  `replacement` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_words`
-- 

INSERT INTO `phpbb_words` VALUES (1, 'boo', 'monkey');

-- --------------------------------------------------------

-- 
-- Table structure for table `phpbb_zebra`
-- 

CREATE TABLE `phpbb_zebra` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `zebra_id` mediumint(8) unsigned NOT NULL default '0',
  `friend` tinyint(1) NOT NULL default '0',
  `foe` tinyint(1) NOT NULL default '0',
  KEY `user_id` (`user_id`),
  KEY `zebra_id` (`zebra_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phpbb_zebra`
-- 

        