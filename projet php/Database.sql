CREATE DATABASE compfundation;

CREATE TABLE organisme(
	org_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	org_nom VARCHAR(20) NOT NULL,
	org_email VARCHAR(50) NOT NULL,
	org_telephone CHAR(10) NOT NULL,
	org_codepostal CHAR(5) NOT NULL,
	org_ville VARCHAR(25) NOT NULL,
	org_statutcotisation INT NOT NULL
);
CREATE TABLE contact(
	ctc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	ctc_nom VARCHAR(20) NOT NULL,
	ctc_prenom VARCHAR(20) NOT NULL,
	ctc_email VARCHAR(50) NOT NULL,
	ctc_telephone CHAR(10) NOT NULL,
	ctc_idorganisme INT NOT NULL
);
CREATE TABLE recherche(
	rec_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	rec_date DATE NOT NULL,
	rec_heure TIME NOT NULL,
	rec_codepostal CHAR(5) NOT NULL,
	rec_ville VARCHAR(25) NOT NULL,
	rec_description LONGTEXT NOT NULL,
	rec_archive INT NOT NULL,
	rec_datelimiteintervention DATETIME NOT NULL,
	rec_nombrejoursintervention INT(4) NOT NULL,
	rec_idorganisme INT NOT NULL,
	rec_idctcorigine INT NOT NULL
);
CREATE TABLE abonnement(
	abo_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	abo_libelle VARCHAR(50) NOT NULL,
	abo_duremini INT(4) NOT NULL,
	abo_duremaxi INT(4) NOT NULL,
	abo_description LONGTEXT NOT NULL
);
CREATE TABLE posseder(
	poss_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	poss_idintervenant INT NOT NULL,
	poss_idorganisme INT NOT NULL,
	poss_idabonnement INT NOT NULL,
	poss_datedebut DATE NOT NULL,
	poss_datefin DATE NOT NULL
);
CREATE TABLE appliquer(
	app_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	app_idtarif INT NOT NULL,
	app_idabonnement INT NOT NULL,
	app_datedebut DATE NOT NULL
);
CREATE TABLE tarif(
	tar_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tar_montanthtannuel INT NOT NULL
);
CREATE TABLE intervenant(
	int_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	int_nom VARCHAR(20) NOT NULL,
	int_prenom VARCHAR(20) NOT NULL,
	int_email VARCHAR(50) NOT NULL,
	int_telephone CHAR(10) NOT NULL,
	int_fax CHAR(10) NOT NULL,
	int_statuscotisation INT NOT NULL
);
CREATE TABLE domaine(
	dom_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	dom_libelle VARCHAR(50) NOT NULL,
	dom_iddomaineparent INT NOT NULL
);
CREATE TABLE niveau(
	niv_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	niv_libelle VARCHAR(50) NOT NULL
);
CREATE TABLE concerne(
	conc_iddomaine INT NOT NULL,
	conc_idrecherche INT NOT NULL,
	PRIMARY KEY(conc_iddomaine, conc_idrecherche),
	CONSTRAINT iddomaine FOREIGN KEY (conc_iddomaine) REFERENCES domaine(dom_id),
	CONSTRAINT idrecherche FOREIGN KEY (conc_idrecherche) REFERENCES recherche(rec_id)
);
CREATE TABLE estcompetent(
	comp_iddomaine INT NOT NULL,
	comp_idniveau INT NOT NULL,
	comp_idintervenant INT NOT NULL,
	PRIMARY KEY(comp_iddomaine, comp_idniveau, comp_idintervenant),
	CONSTRAINT iddomaine2 FOREIGN KEY (comp_iddomaine) REFERENCES domaine(dom_id),
	CONSTRAINT idniveau FOREIGN KEY (comp_idniveau) REFERENCES niveau(niv_id),   
	CONSTRAINT idintervenant FOREIGN KEY (comp_idintervenant) REFERENCES intervenant(int_id)
);

ALTER TABLE contact
	ADD CONSTRAINT idorganisme FOREIGN KEY (ctc_idorganisme)REFERENCES organisme(org_id);
	
ALTER TABLE recherche
	ADD CONSTRAINT idorganisme2 FOREIGN KEY (rec_idorganisme) REFERENCES organisme(org_id),
	ADD CONSTRAINT idcontact FOREIGN KEY (rec_idctcorigine) REFERENCES contact(ctc_id);

ALTER TABLE posseder
	ADD CONSTRAINT idorganisme3 FOREIGN KEY (poss_idorganisme) REFERENCES organisme(org_id),
	ADD CONSTRAINT idabonnement FOREIGN KEY (poss_idabonnement) REFERENCES abonnement(abo_id),
	ADD CONSTRAINT idintervenant2 FOREIGN KEY (poss_idintervenant) REFERENCES intervenant(int_id);
	
ALTER TABLE appliquer
	ADD CONSTRAINT idtarif FOREIGN KEY (app_idtarif) REFERENCES tarif(tar_id),
	ADD CONSTRAINT idabonnement2 FOREIGN KEY (app_idabonnement) REFERENCES abonnement(abo_id);
	
ALTER TABLE domaine
	ADD CONSTRAINT iddom FOREIGN KEY (dom_iddomaineparent) REFERENCES domaine(dom_id);