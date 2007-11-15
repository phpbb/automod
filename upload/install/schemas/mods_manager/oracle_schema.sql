/*

 $Id$

*/

/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora'
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB"
	PROFILE "DEFAULT"
	IDENTIFIED BY "phpbb_password"
	DEFAULT TABLESPACE "PHPBB"
	QUOTA UNLIMITED ON "PHPBB"
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
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
	mod_templates varchar2(765) DEFAULT '' ,
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


