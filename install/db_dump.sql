
-- --------------------------------------------------------

INSERT INTO `phpbb_acl_options` VALUES (116, 'a_pacman', 1, 0, 0);

-- --------------------------------------------------------

INSERT INTO `phpbb_acl_roles_data` VALUES (4, 116, 1);

-- --------------------------------------------------------

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



        