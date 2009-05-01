/*

 $Id$

*/

/*
	Table: 'phpbb_mods'
*/
CREATE TABLE phpbb_mods (
	mod_id number(8) NOT NULL,
	mod_active number(1) DEFAULT '0' NOT NULL,
	mod_time number(11) DEFAULT '0' NOT NULL,
	mod_dependencies clob DEFAULT '' ,
	mod_name varchar2(300) DEFAULT '' ,
	mod_description clob DEFAULT '' ,
	mod_version varchar2(25) DEFAULT '' ,
	mod_author_notes clob DEFAULT '' ,
	mod_author_name varchar2(300) DEFAULT '' ,
	mod_author_email varchar2(300) DEFAULT '' ,
	mod_author_url varchar2(300) DEFAULT '' ,
	mod_actions clob DEFAULT '' ,
	mod_languages varchar2(765) DEFAULT '' ,
	mod_template varchar2(765) DEFAULT '' ,
	mod_path varchar2(765) DEFAULT '' ,
	CONSTRAINT pk_phpbb_mods PRIMARY KEY (mod_id)
)
/


CREATE SEQUENCE phpbb_mods_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_mods
BEFORE INSERT ON phpbb_mods
FOR EACH ROW WHEN (
	new.mod_id IS NULL OR new.mod_id = 0
)
BEGIN
	SELECT phpbb_mods_seq.nextval
	INTO :new.mod_id
	FROM dual;
END;
/


