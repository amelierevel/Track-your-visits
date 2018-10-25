#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: F396V_userType
#------------------------------------------------------------

CREATE TABLE F396V_userType(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_userType_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_users
#------------------------------------------------------------

CREATE TABLE F396V_users(
        id                Int  Auto_increment  NOT NULL ,
        firstname         Varchar (40) NOT NULL ,
        lastname          Varchar (40) NOT NULL ,
        birthDate         Date NOT NULL ,
        mail              Varchar (100) NOT NULL ,
        username          Varchar (40) NOT NULL ,
        password          Varchar (255) NOT NULL ,
        createDate        Datetime NOT NULL ,
        idUserType Int NOT NULL
	,CONSTRAINT F396V_users_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_users_F396V_userType_FK FOREIGN KEY (idUserType) REFERENCES F396V_userType(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_category
#------------------------------------------------------------

CREATE TABLE F396V_category(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_category_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_timetableType
#------------------------------------------------------------

CREATE TABLE F396V_timetableType(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (15) NOT NULL
	,CONSTRAINT F396V_timetableType_PK PRIMARY KEY (id)
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
# Table: F396V_priceType
#------------------------------------------------------------

CREATE TABLE F396V_priceType(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT F396V_priceType_PK PRIMARY KEY (id)
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
        id                Int  Auto_increment  NOT NULL ,
        name              Varchar (100) NOT NULL ,
        description       Varchar (255) NOT NULL ,
        address           Varchar (255) NOT NULL ,
        phone             Varchar (10) NOT NULL ,
        mail              Varchar (100) NOT NULL ,
        website           Varchar (100) NOT NULL ,
        idCategory Int NOT NULL ,
        idCities   Int NOT NULL
	,CONSTRAINT F396V_places_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_places_F396V_category_FK FOREIGN KEY (idCategory) REFERENCES F396V_category(id)
	,CONSTRAINT F396V_places_F396V_cities0_FK FOREIGN KEY (idCities) REFERENCES F396V_cities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_comments
#------------------------------------------------------------

CREATE TABLE F396V_comments(
        id              Int  Auto_increment  NOT NULL ,
        content         Varchar (255) NOT NULL ,
        postDate        Datetime NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_comments_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_comments_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_comments_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_notation
#------------------------------------------------------------

CREATE TABLE F396V_notation(
        id              Int  Auto_increment  NOT NULL ,
        note            Int NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_notation_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_notation_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_notation_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_prices
#------------------------------------------------------------

CREATE TABLE F396V_prices(
        id                 Int  Auto_increment  NOT NULL ,
        price              Int NOT NULL ,
        name               Varchar (50) NOT NULL ,
        idPlaces    Int NOT NULL ,
        idPriceType Int NOT NULL
	,CONSTRAINT F396V_prices_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_prices_F396V_places_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
	,CONSTRAINT F396V_prices_F396V_priceType0_FK FOREIGN KEY (idPriceType) REFERENCES F396V_priceType(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_favorite
#------------------------------------------------------------

CREATE TABLE F396V_favorite(
        id              Int  Auto_increment  NOT NULL ,
        idUsers  Int NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_favorite_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_favorite_F396V_users_FK FOREIGN KEY (idUsers) REFERENCES F396V_users(id)
	,CONSTRAINT F396V_favorite_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
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
# Table: F396V_timetable
#------------------------------------------------------------

CREATE TABLE F396V_timetable(
        id                     Int  Auto_increment  NOT NULL ,
        opening                Int NOT NULL ,
        closing                Int NOT NULL ,
        idDays          Int NOT NULL ,
        idPlaces        Int NOT NULL ,
        idTimetableType Int NOT NULL
	,CONSTRAINT F396V_timetable_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_timetable_F396V_days_FK FOREIGN KEY (idDays) REFERENCES F396V_days(id)
	,CONSTRAINT F396V_timetable_F396V_places0_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
	,CONSTRAINT F396V_timetable_F396V_timetableType1_FK FOREIGN KEY (idTimetableType) REFERENCES F396V_timetableType(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: F396V_acceptedPayment
#------------------------------------------------------------

CREATE TABLE F396V_acceptedPayment(
        id              Int  Auto_increment  NOT NULL ,
        name            Varchar (50) NOT NULL ,
        idPlaces Int NOT NULL
	,CONSTRAINT F396V_acceptedPayment_PK PRIMARY KEY (id)

	,CONSTRAINT F396V_acceptedPayment_F396V_places_FK FOREIGN KEY (idPlaces) REFERENCES F396V_places(id)
)ENGINE=InnoDB;
