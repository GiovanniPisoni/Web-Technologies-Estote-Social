-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan 19 15:46:17 2024 
-- * LUN file: C:\Users\rinch\Desktop\Web-Technologies-Estote-Social\src\db\Social.lun 
-- * Schema: EstateSocialLogico/1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database db-estatesocial;
use db-estatesocial;


-- Tables Section
-- _____________ 

create table COMMENTI (
     Username char(25) not null,
     IDPost bigint not null,
     IDCommento bigint not null,
     IDNotifica int not null,
     Data date not null,
     Testo char(250) not null,
     constraint IDCOMMENTI primary key (IDCommento, IDPost, Username),
     constraint FKinviare2_ID unique (IDNotifica));

create table HASHTAG (
     NomeTipo char(100) not null,
     constraint IDHASHTAG primary key (NomeTipo));

create table MIPIACE (
     Username char(25) not null,
     IDPost bigint not null,
     IDNotifica int not null,
     constraint IDLIKE primary key (Username, IDPost),
     constraint FKinviare_ID unique (IDNotifica));

create table LOGINATTEMPT (
     Username char(25) not null,
     DataOra date not null,
     constraint IDLOGIN primary key (Username, DataOra));

create table NOTIFICA (
     IDNotifica int not null,
     Letta char not null,
     Testo char(100) not null,
     Username char(25) not null,
     constraint IDNOTIFICA_ID primary key (IDNotifica));

create table POST (
     IDPost bigint not null,
     Testo char(250) not null,
     Immagine char(100),
     Data date not null,
     Username char(25) not null,
     constraint IDPOST primary key (IDPost));

create table appartenere (
     NomeTipo char(100) not null,
     IDPost bigint not null,
     constraint IDappartenere primary key (IDPost, NomeTipo));

create table seguire (
     IDNotifica int not null,
     Username_follower char(25) not null,
     Username_seguito char(25) not null,
     constraint FKseg_NOT_ID primary key (IDNotifica));

create table UTENTE (
     Nome char(20),
     Cognome char(20),
     DataDiNascita date,
     CodiceCensimento char(10),
     ImmagineProfilo char(200) not null,
     GruppoAppartenenza char(15),
     Mail char(30) not null,
     Username char(25) not null,
     Password char(40) not null,
     Scout char not null,
     Salt char(1) not null,
     Bio char(250) not null,
     Fazzolettone char(200),
     Specialita char(200),
     Totem char(200),
     constraint IDUTENTE primary key (Username));


-- Constraints Section
-- ___________________ 

alter table COMMENTI add constraint FKavere
     foreign key (IDPost)
     references POST (IDPost);

alter table COMMENTI add constraint FKcommentare
     foreign key (Username)
     references UTENTE (Username);

alter table COMMENTI add constraint FKinviare2_FK
     foreign key (IDNotifica)
     references NOTIFICA (IDNotifica);

alter table MIPIACE add constraint FKinviare_FK
     foreign key (IDNotifica)
     references NOTIFICA (IDNotifica);

alter table MIPIACE add constraint FKappartenere2
     foreign key (IDPost)
     references POST (IDPost);

alter table MIPIACE add constraint FKlasciare
     foreign key (Username)
     references UTENTE (Username);

alter table LOGINATTEMPT add constraint FKaccesso
     foreign key (Username)
     references UTENTE (Username);

-- Not implemented
-- alter table NOTIFICA add constraint IDNOTIFICA_CHK
--     check(exists(select * from COMMENTI
--                  where COMMENTI.IDNotifica = IDNotifica)); 

-- Not implemented
-- alter table NOTIFICA add constraint IDNOTIFICA_CHK
--     check(exists(select * from seguire
--                  where seguire.IDNotifica = IDNotifica)); 

-- Not implemented
-- alter table NOTIFICA add constraint IDNOTIFICA_CHK
--     check(exists(select * from MIPIACE
--                  where MIPIACE.IDNotifica = IDNotifica)); 

alter table NOTIFICA add constraint FKricevere
     foreign key (Username)
     references UTENTE (Username);

alter table POST add constraint FKpostare
     foreign key (Username)
     references UTENTE (Username);

alter table appartenere add constraint FKapp_POS
     foreign key (IDPost)
     references POST (IDPost);

alter table appartenere add constraint FKapp_HAS
     foreign key (NomeTipo)
     references HASHTAG (NomeTipo);

alter table seguire add constraint FKfollower
     foreign key (Username_follower)
     references UTENTE (Username);

alter table seguire add constraint FKutente_seguito
     foreign key (Username_seguito)
     references UTENTE (Username);

alter table seguire add constraint FKseg_NOT_FK
     foreign key (IDNotifica)
     references NOTIFICA (IDNotifica);


-- Index Section
-- _____________ 

