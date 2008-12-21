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
	[mod_active] [int] DEFAULT (0) NOT NULL ,
	[mod_time] [int] DEFAULT (0) NOT NULL ,
	[mod_dependencies] [text] DEFAULT ('') NOT NULL ,
	[mod_name] [varchar] (100) DEFAULT ('') NOT NULL ,
	[mod_description] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[mod_version] [varchar] (25) DEFAULT ('') NOT NULL ,
	[mod_author_notes] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[mod_author_name] [varchar] (100) DEFAULT ('') NOT NULL ,
	[mod_author_email] [varchar] (100) DEFAULT ('') NOT NULL ,
	[mod_author_url] [varchar] (100) DEFAULT ('') NOT NULL ,
	[mod_actions] [text] DEFAULT ('') NOT NULL ,
	[mod_languages] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_template] [varchar] (255) DEFAULT ('') NOT NULL ,
	[mod_path] [varchar] (255) DEFAULT ('') NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_mods] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_mods] PRIMARY KEY  CLUSTERED 
	(
		[mod_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

