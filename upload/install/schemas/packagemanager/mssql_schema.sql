/*

 $Id$

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_mods'
*/
CREATE TABLE [phpbb_mods] (
	[mod_id] [int] IDENTITY (1, 1) NOT NULL ,
	[mod_active] [int] DEFAULT (1) NOT NULL ,
	[mod_time] [int] DEFAULT (0) NOT NULL ,
	[mod_dependencies] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[mod_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_description] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[mod_version] [varchar] (100) DEFAULT ('') NOT NULL ,
	[mod_author_notes] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[mod_author_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_author_email] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_author_url] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_actions] [text] DEFAULT ('') NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO



COMMIT
GO

