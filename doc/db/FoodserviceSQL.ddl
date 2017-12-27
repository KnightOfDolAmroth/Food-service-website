-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.1              
-- * Generator date: Jan 10 2017              
-- * Generation date: Wed Dec 27 18:11:00 2017 
-- * LUN file:  
-- * Schema: REL_SCHEMA/SQL1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database REL_SCHEMA;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table aggiunta_ordine (
     id_dettaglio char(5) not null,
     id_ingrediente char(5) not null,
     constraint ID_aggiunta_ordine_ID primary key (id_dettaglio, id_ingrediente));

create table DETTAGLIO_ORDINE (
     id_dettaglio char(5) not null,
     qta numeric(5) not null,
     id_impasto char(5) not null,
     codice_ordine char(10) not null,
     id_pietanza char(5) not null,
     constraint ID_DETTAGLIO_ORDINE_ID primary key (id_dettaglio));

create table IMPASTO (
     id_impasto char(5) not null,
     nome_impasto char(20) not null,
     prezzo char(1) not null,
     constraint ID_IMPASTO_ID primary key (id_impasto));

create table INGREDIENTE (
     id_ingrediente char(5) not null,
     nome_ingrediente char(30) not null,
     note_ingrediente char(60) not null,
     prezzo_aggiunta float(2) not null,
     vegetariano char not null,
     vegano char not null,
     halal char not null,
     gluten_free char not null,
     constraint ID_INGREDIENTE_ID primary key (id_ingrediente));

create table ingredienti_impasti (
     id_ingrediente char(5) not null,
     id_impasto char(5) not null,
     constraint ID_ingredienti_impasti_ID primary key (id_impasto, id_ingrediente));

create table ingredienti_pietanza (
     id_pietanza char(5) not null,
     id_ingrediente char(5) not null,
     constraint ID_ingredienti_pietanza_ID primary key (id_ingrediente, id_pietanza));

create table ORDINE (
     codice_ordine char(10) not null,
     data date not null,
     indirizzo_recapito char(1) not null,
     username char(20) not null,
     constraint ID_ORDINE_ID primary key (codice_ordine));

create table PIETANZA (
     id_pietanza char(5) not null,
     nome_pietanza char(30) not null,
     prezzo_base char(1) not null,
     constraint ID_PIETANZA_ID primary key (id_pietanza));

create table UTENTE (
     username char(20) not null,
     password char(30) not null,
     email char(40) not null,
     nome char(20) not null,
     cognome char(20) not null,
     telefono char(10) not null,
     constraint ID_UTENTE_ID primary key (username),
     constraint SID_UTENTE_ID unique (email));


-- Constraints Section
-- ___________________ 

alter table aggiunta_ordine add constraint REF_aggiu_INGRE_FK
     foreign key (id_ingrediente)
     references INGREDIENTE;

alter table aggiunta_ordine add constraint REF_aggiu_DETTA
     foreign key (id_dettaglio)
     references DETTAGLIO_ORDINE;

alter table DETTAGLIO_ORDINE add constraint REF_DETTA_IMPAS_FK
     foreign key (id_impasto)
     references IMPASTO;

alter table DETTAGLIO_ORDINE add constraint EQU_DETTA_ORDIN_FK
     foreign key (codice_ordine)
     references ORDINE;

alter table DETTAGLIO_ORDINE add constraint REF_DETTA_PIETA_FK
     foreign key (id_pietanza)
     references PIETANZA;

alter table ingredienti_impasti add constraint REF_ingre_IMPAS
     foreign key (id_impasto)
     references IMPASTO;

alter table ingredienti_impasti add constraint REF_ingre_INGRE_1_FK
     foreign key (id_ingrediente)
     references INGREDIENTE;

alter table ingredienti_pietanza add constraint REF_ingre_INGRE
     foreign key (id_ingrediente)
     references INGREDIENTE;

alter table ingredienti_pietanza add constraint REF_ingre_PIETA_FK
     foreign key (id_pietanza)
     references PIETANZA;

alter table ORDINE add constraint ID_ORDINE_CHK
     check(exists(select * from DETTAGLIO_ORDINE
                  where DETTAGLIO_ORDINE.codice_ordine = codice_ordine)); 

alter table ORDINE add constraint REF_ORDIN_UTENT_FK
     foreign key (username)
     references UTENTE;


-- Index Section
-- _____________ 

create unique index ID_aggiunta_ordine_IND
     on aggiunta_ordine (id_dettaglio, id_ingrediente);

create index REF_aggiu_INGRE_IND
     on aggiunta_ordine (id_ingrediente);

create unique index ID_DETTAGLIO_ORDINE_IND
     on DETTAGLIO_ORDINE (id_dettaglio);

create index REF_DETTA_IMPAS_IND
     on DETTAGLIO_ORDINE (id_impasto);

create index EQU_DETTA_ORDIN_IND
     on DETTAGLIO_ORDINE (codice_ordine);

create index REF_DETTA_PIETA_IND
     on DETTAGLIO_ORDINE (id_pietanza);

create unique index ID_IMPASTO_IND
     on IMPASTO (id_impasto);

create unique index ID_INGREDIENTE_IND
     on INGREDIENTE (id_ingrediente);

create unique index ID_ingredienti_impasti_IND
     on ingredienti_impasti (id_impasto, id_ingrediente);

create index REF_ingre_INGRE_1_IND
     on ingredienti_impasti (id_ingrediente);

create unique index ID_ingredienti_pietanza_IND
     on ingredienti_pietanza (id_ingrediente, id_pietanza);

create index REF_ingre_PIETA_IND
     on ingredienti_pietanza (id_pietanza);

create unique index ID_ORDINE_IND
     on ORDINE (codice_ordine);

create index REF_ORDIN_UTENT_IND
     on ORDINE (username);

create unique index ID_PIETANZA_IND
     on PIETANZA (id_pietanza);

create unique index ID_UTENTE_IND
     on UTENTE (username);

create unique index SID_UTENTE_IND
     on UTENTE (email);

