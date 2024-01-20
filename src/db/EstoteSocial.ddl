-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Sat Jan 20 18:19:01 2024 
-- * LUN file: C:\Users\rinch\Desktop\Web-Technologies-Estote-Social\src\db\EstoteSocial.lun 
-- * Schema: EstoteSocialLogico/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database db_estotesocial;
use db_estotesocial;


-- Tables Section
-- _____________ 

create table COMMENTI (
     Username char(25) not null,
     IDPost bigint not null,
     IDCommento bigint not null auto-increment,
     Testo char(250) not null,
     Data date not null,
     constraint IDCOMMENTI primary key (IDCommento, IDPost, Username));

create table LIKE (
     IDPost bigint not null,
     Username char(25) not null,
     constraint IDLIKE primary key (Username, IDPost));

create table LOGINATTEMPT (
     Username char(25) not null,
     DataOra char(1) not null,
     constraint IDLOGINATTEMPT primary key (Username, DataOra));

create table NOTIFICA (
     IDNotifica int not null auto-increment,
     Tipo char(30) not null,
     Letta char not null,
     Username_receiver char(25) not null,
     Username_sender char(25) not null,
     constraint IDNOTIFICA primary key (IDNotifica));

create table POST (
     IDPost bigint not null auto-increment,
     Testo char(250) not null,
     Immagine char(100),
     Data date not null,
     Hashtag1 char(50),
     Hashtag2 char(50),
     Hashtag3 char(50),
     Username char(25) not null,
     constraint IDPOST primary key (IDPost));

create table seguire (
     Username_follower char(25) not null,
     Username_seguito char(25) not null,
     constraint IDseguire primary key (Username_seguito, Username_follower));

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

alter table COMMENTI add constraint FKavere
     foreign key (IDPost)
     references POST (IDPost) on delete cascade;

alter table COMMENTI add constraint FKcommentare
     foreign key (Username)
     references UTENTE (Username) on delete cascade;

alter table LIKE add constraint FKlasciare
     foreign key (Username)
     references UTENTE (Username) on delete cascade;

alter table LIKE add constraint FKappartenere2
     foreign key (IDPost)
     references POST (IDPost) on delete cascade;

alter table LOGINATTEMPT add constraint FKaccesso
     foreign key (Username)
     references UTENTE (Username) on delete cascade;

alter table NOTIFICA add constraint FKricevere
     foreign key (Username_receiver)
     references UTENTE (Username) on delete cascade;

alter table NOTIFICA add constraint FKinviare
     foreign key (Username_sender)
     references UTENTE (Username) on delete cascade;

alter table POST add constraint FKpostare
     foreign key (Username)
     references UTENTE (Username) on delete cascade;

alter table seguire add constraint FKUTENTE_1
     foreign key (Username_seguito)
     references UTENTE (Username) on delete cascade;

alter table seguire add constraint FKseg_UTE
     foreign key (Username_follower)
     references UTENTE (Username) on delete cascade;


-- Index Section
-- _____________ 

