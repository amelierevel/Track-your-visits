#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: F396V_userTypes
#------------------------------------------------------------

CREATE TABLE F396V_userTypes(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_userTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_users
#------------------------------------------------------------

CREATE TABLE F396V_users(
        id                 Int  Auto_increment  NOT NULL ,
        firstname          Varchar (255) NOT NULL ,
        lastname           Varchar (255) NOT NULL ,
        birthDate          Date NOT NULL ,
        mail               Varchar (100) NOT NULL ,
        username           Varchar (25) NOT NULL ,
        password           Varchar (255) NOT NULL ,
        createDate         Datetime NOT NULL ,
        idUserTypes Int NOT NULL
	,CONSTRAINT F396V_users_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_users_F396V_userTypes_FK FOREIGN KEY (idUserTypes) REFERENCES F396V_userTypes(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_categories
#------------------------------------------------------------

CREATE TABLE F396V_categories(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_categories_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_timetableTypes
#------------------------------------------------------------

CREATE TABLE F396V_timetableTypes(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_timetableTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_days
#------------------------------------------------------------

CREATE TABLE F396V_days(
        id  Int  Auto_increment  NOT NULL ,
        day Varchar (10) NOT NULL
	,CONSTRAINT F396V_days_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_regions
#------------------------------------------------------------

CREATE TABLE F396V_regions(
        id     Int  Auto_increment  NOT NULL ,
        region Varchar (100) NOT NULL
	,CONSTRAINT F396V_regions_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_departments
#------------------------------------------------------------

CREATE TABLE F396V_departments(
        id               Int  Auto_increment  NOT NULL ,
        department       Varchar (100) NOT NULL ,
        idRegions Int NOT NULL
	,CONSTRAINT F396V_departments_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_departments_F396V_regions_FK FOREIGN KEY (idRegions) REFERENCES F396V_regions(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_priceTypes
#------------------------------------------------------------

CREATE TABLE F396V_priceTypes(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_priceTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_cities
#------------------------------------------------------------

CREATE TABLE F396V_cities(
        id                   Int  Auto_increment  NOT NULL ,
        city                 Varchar (100) NOT NULL ,
        idDepartments Int NOT NULL
	,CONSTRAINT F396V_cities_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_cities_F396V_departments_FK FOREIGN KEY (idDepartments) REFERENCES F396V_departments(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_places
#------------------------------------------------------------

CREATE TABLE F396V_places(
        id                  Int  Auto_increment  NOT NULL ,
        name                Varchar (100) NOT NULL ,
        description         Varchar (255) NOT NULL ,
        address             Varchar (255) NOT NULL ,
        phone               Varchar (10) NOT NULL ,
        mail                Varchar (100) NOT NULL ,
        website             Varchar (100) NOT NULL ,
        idCategories Int NOT NULL ,
        idCities     Int NOT NULL
	,CONSTRAINT F396V_places_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_places_F396V_categories_FK FOREIGN KEY (idCategories) REFERENCES F396V_categories(id)
	,CONSTRAINT F396V_places_F396V_cities0_FK FOREIGN KEY (idCities) REFERENCES F396V_cities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_comments
#------------------------------------------------------------

CREATE TABLE F396V_comments(
        id              Int  Auto_increment  NOT NULL ,
        content         Text NOT NULL ,
        postDate        Datetime NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_comments_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_comments_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_comments_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_notations
#------------------------------------------------------------

CREATE TABLE F396V_notations(
        id              Int  Auto_increment  NOT NULL ,
        note            Int NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_notations_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_notations_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_notations_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_prices
#------------------------------------------------------------

CREATE TABLE F396V_prices(
        id                  Int  Auto_increment  NOT NULL ,
        price               Int NOT NULL ,
        name                Varchar (50) NOT NULL ,
        idPlaces     Int NOT NULL ,
        idPriceTypes Int NOT NULL
	,CONSTRAINT F396V_prices_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_prices_F396V_places_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
	,CONSTRAINT F396V_prices_F396V_priceTypes0_FK FOREIGN KEY (idPriceTypes) REFERENCES F396V_priceTypes(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_favorites
#------------------------------------------------------------

CREATE TABLE F396V_favorites(
        id              Int  Auto_increment  NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_favorites_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_favorites_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_favorites_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_pictures
#------------------------------------------------------------

CREATE TABLE F396V_pictures(
        id              Int  Auto_increment  NOT NULL ,
        picture         Varchar (255) NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_pictures_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_pictures_F396V_places_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_timetables
#------------------------------------------------------------

CREATE TABLE F396V_timetables(
        id                      Int  Auto_increment  NOT NULL ,
        opening                 Int NOT NULL ,
        closing                 Int NOT NULL ,
        idDays           Int NOT NULL ,
        idPlaces         Int NOT NULL ,
        idTimetableTypes Int NOT NULL
	,CONSTRAINT F396V_timetables_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_timetables_F396V_days_FK FOREIGN KEY (idDays) REFERENCES F396V_days(id)
	,CONSTRAINT F396V_timetables_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
	,CONSTRAINT F396V_timetables_F396V_timetableTypes1_FK FOREIGN KEY (idTimetableTypes) REFERENCES F396V_timetableTypes(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_paymentTypes
#------------------------------------------------------------

CREATE TABLE F396V_paymentTypes(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (100) NOT NULL
	,CONSTRAINT F396V_paymentTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_acceptedPayments
#------------------------------------------------------------

CREATE TABLE F396V_acceptedPayments(
        id                    Int  Auto_increment  NOT NULL ,
        idPlaces       Int NOT NULL ,
        idPaymentTypes Int NOT NULL
	,CONSTRAINT F396V_acceptedPayments_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_acceptedPayments_F396V_places_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
	,CONSTRAINT F396V_acceptedPayments_F396V_paymentTypes0_FK FOREIGN KEY (idPaymentTypes) REFERENCES F396V_paymentTypes(id)
)ENGINE=InnoDB;

