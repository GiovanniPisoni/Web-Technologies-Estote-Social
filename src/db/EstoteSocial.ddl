-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Jan 17 15:37:33 2024 
-- * LUN file: C:\Users\rinch\Desktop\Web-Technologies-Estote-Social\src\db\Social.lun 
-- * Schema: EstoteSocialLogico/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

create database EstoteSocialLogico;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table appartenere (
     NomeTipo char(30) not null,
     IDPost numeric(20) not null,
     constraint ID_appartenere_ID primary key (IDPost, NomeTipo));

create table COMMENTI (
     IDPost numeric(20) not null,
     Username char(25) not null,
     IDCommento numeric(20) not null,
     IDNotifica numeric(1) not null,
     Testo char(300) not null,
     constraint ID_COMMENTI_ID primary key (IDCommento, IDPost, Username),
     constraint SID_COMME_NOTIF_ID unique (IDNotifica));

create table HASHTAG (
     NomeTipo char(30) not null,
     constraint ID_HASHTAG_ID primary key (NomeTipo));

create table MIPIACE (
     IDPost numeric(20) not null,
     Username char(25) not null,
     IDNotifica numeric(1) not null,
     constraint ID_LIKE_ID primary key (Username, IDPost),
     constraint SID_LIKE_NOTIF_ID unique (IDNotifica));

create table NOTIFICA (
     IDNotifica numeric(1) not null,
     Letta char not null,
     Testo char(100) not null,
     Username char(25) not null,
     constraint ID_NOTIFICA_ID primary key (IDNotifica));

create table POST (
     IDPost numeric(20) not null,
     Testo char(300) not null,
     Immagine char(100),
     Username char(25) not null,
     Data date not null,
     constraint ID_POST_ID primary key (IDPost));

create table seguire (
     IDNotifica numeric(1) not null,
     Username char(25) not null,
     Username_seguito char(25) not null,
     constraint ID_segui_NOTIF_ID primary key (IDNotifica));

create table UTENTE (
     Nome char(20) not null,
     Cognome char(20) not null,
     DataDiNascita date not null,
     CodiceCensimento char(10),
     ImmagineProfilo char(200) not null,
     GruppoAppartenenza char(15),
     Mail char(30) not null,
     Username char(25) not null,
     Password char(40) not null,
     Scout char not null,
     Bio char(300) not null,
     Fazzolettone char(200),
     Specialita char(200),
     Totem char(200),
     constraint ID_UTENTE_ID primary key (Username));


-- Constraints Section
-- ___________________ 

alter table appartenere add constraint REF_appar_POST
     foreign key (IDPost)
     references POST;

alter table appartenere add constraint REF_appar_HASHT_FK
     foreign key (NomeTipo)
     references HASHTAG;

alter table COMMENTI add constraint SID_COMME_NOTIF_FK
     foreign key (IDNotifica)
     references NOTIFICA;

alter table COMMENTI add constraint REF_COMME_UTENT_FK
     foreign key (Username)
     references UTENTE;

alter table COMMENTI add constraint REF_COMME_POST_FK
     foreign key (IDPost)
     references POST;

alter table MIPIACE add constraint REF_LIKE_UTENT
     foreign key (Username)
     references UTENTE;

alter table MIPIACE add constraint SID_LIKE_NOTIF_FK
     foreign key (IDNotifica)
     references NOTIFICA;

alter table MIPIACE add constraint REF_LIKE_POST_FK
     foreign key (IDPost)
     references POST;

alter table NOTIFICA add constraint ID_NOTIFICA_CHK
     check(exists(select * from MIPIACE
                  where MIPIACE.IDNotifica = IDNotifica)); 

alter table NOTIFICA add constraint ID_NOTIFICA_CHK
     check(exists(select * from COMMENTI
                  where COMMENTI.IDNotifica = IDNotifica)); 

alter table NOTIFICA add constraint ID_NOTIFICA_CHK
     check(exists(select * from seguire
                  where seguire.IDNotifica = IDNotifica)); 

alter table NOTIFICA add constraint REF_NOTIF_UTENT_FK
     foreign key (Username)
     references UTENTE;

alter table POST add constraint REF_POST_UTENT_FK
     foreign key (Username)
     references UTENTE;

alter table seguire add constraint REF_segui_UTENT_1_FK
     foreign key (Username)
     references UTENTE;

alter table seguire add constraint REF_segui_UTENT_FK
     foreign key (Username_seguito)
     references UTENTE;

alter table seguire add constraint ID_segui_NOTIF_FK
     foreign key (IDNotifica)
     references NOTIFICA;


-- Index Section
-- _____________ 

create unique index ID_appartenere_IND
     on appartenere (IDPost, NomeTipo);

create index REF_appar_HASHT_IND
     on appartenere (NomeTipo);

create unique index ID_COMMENTI_IND
     on COMMENTI (IDCommento, IDPost, Username);

create unique index SID_COMME_NOTIF_IND
     on COMMENTI (IDNotifica);

create index REF_COMME_UTENT_IND
     on COMMENTI (Username);

create index REF_COMME_POST_IND
     on COMMENTI (IDPost);

create unique index ID_HASHTAG_IND
     on HASHTAG (NomeTipo);

create unique index ID_LIKE_IND
     on MIPIACE (Username, IDPost);

create unique index SID_LIKE_NOTIF_IND
     on MIPIACE (IDNotifica);

create index REF_LIKE_POST_IND
     on MIPIACE (IDPost);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (IDNotifica);

create index REF_NOTIF_UTENT_IND
     on NOTIFICA (Username);

create unique index ID_POST_IND
     on POST (IDPost);

create index REF_POST_UTENT_IND
     on POST (Username);

create index REF_segui_UTENT_1_IND
     on seguire (Username);

create index REF_segui_UTENT_IND
     on seguire (Username_seguito);

create unique index ID_segui_NOTIF_IND
     on seguire (IDNotifica);

create unique index ID_UTENTE_IND
     on UTENTE (Username);

