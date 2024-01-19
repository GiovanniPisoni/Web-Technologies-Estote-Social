-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan 19 21:14:18 2024 
-- * LUN file: C:\Users\rinch\AppData\Local\Microsoft\Windows\INetCache\IE\65Z7HL1F\EstoteSocial[1].lun 
-- * Schema: EstoteSocial2/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database EstoteSocial2;
use EstoteSocial2;


-- Tables Section
-- _____________ 

create table COMMENTI (
     IDCommento bigint not null,
     Testo char(250) not null,
     Data date not null,
     constraint IDCOMMENTI primary key (IDCommento, , ));

create table HASHTAG (
     NomeTipo char(30) not null,
     constraint IDHASHTAG primary key (NomeTipo));

create table LIKE (
,
     constraint IDLIKE primary key (, ));

create table LOGINATTEMPT (
     DataOra char(1) not null,
     constraint IDLOGINATTEMPT primary key (, DataOra));

create table NOTIFICA (
     IDNotifica int not null,
     Tipo char(30) not null,
     Letta char not null,
     constraint IDNOTIFICA primary key (IDNotifica));

create table POST (
     IDPost bigint not null,
     Testo char(250) not null,
     Immagine char(100),
     Data date not null,
     constraint IDPOST primary key (IDPost));

create table UTENTE (
     Nome char(20),
     Cognome char(20),
     DataDiNascita date,
     ImmagineProfilo char(200) not null,
     GruppoAppartenenza char(15),
     Mail char(30) not null,
     Username char(25) not null,
     Password char(250) not null,
     Salt char(250) not null,
     Bio char(250) not null,
     Fazzolettone char(200),
     Specialita char(200),
     Totem char(200),
     constraint IDUTENTE primary key (Username));


-- Constraints Section
-- ___________________ 


-- Index Section
-- _____________ 

