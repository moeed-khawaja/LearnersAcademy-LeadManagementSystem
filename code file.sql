CREATE TABLE User_Type_Entity (
    User_Type_ID 	INT AUTO_INCREMENT PRIMARY KEY,
    User_Type_Name 	VARCHAR(50)
);

CREATE TABLE User_Entity (
    User_ID 	 INT AUTO_INCREMENT PRIMARY KEY,
    First_Name 	 VARCHAR(50),
    Last_Name 	 VARCHAR(50),
    Role 		 VARCHAR(50),
    Email 	 VARCHAR(100),
    Password 	 VARCHAR(100),
    Created_Date DATE,
    Updated_Date DATE,
    User_Type_ID INT,
    FOREIGN KEY (User_Type_ID) REFERENCES User_Type_Entity(User_Type_ID)
);

CREATE TABLE Lead_Category_Entity (
    Category_ID 		INT  AUTO_INCREMENT PRIMARY KEY,
    Category_Name 	VARCHAR(20) CHECK (Category_Name IN ('hot', 'medium', 'cold'))
);

CREATE TABLE Lead_Src_Entity (
    Src_ID 	INT  AUTO_INCREMENT PRIMARY KEY,
    Src_Name 	VARCHAR(50)
);

CREATE TABLE Interaction_Type_Entity (
    Interaction_Type_ID 		INT AUTO_INCREMENT PRIMARY KEY,
    Interaction_Type_Name 	VARCHAR(50)
);

CREATE TABLE Lead_Entity (
    Lead_id			INT AUTO_INCREMENT PRIMARY KEY,
    First_Name			VARCHAR(50),
    Last_Name 			VARCHAR(50),
    Email 			VARCHAR(100),
    Phone 			VARCHAR(30),
    Standard			VARCHAR(10) CHECK (Standard IN ('Olevels', 'Alevels')),
    Mode				VARCHAR(10) CHECK (Mode IN ('Online', 'Physical')),
    Subject 			VARCHAR(20),
    Status 			VARCHAR(20) CHECK (Status IN ('Active', 'Inactive')),
    Created_Date 		DATE,
    Updated_Date 		DATE,
    Notes 			TEXT,
    User_ID 			INT,
    Category_ID 			INT,
    FOREIGN KEY (User_ID) REFERENCES User_Entity(User_ID),
    FOREIGN KEY (Category_ID) REFERENCES Lead_Category_Entity(Category_ID)
);

CREATE TABLE Interaction_Entity (
    Interaction_ID 		INT  AUTO_INCREMENT PRIMARY KEY,
    Interaction_Date 		DATE,
    Notes 			TEXT,
    Lead_ID 			INT,
    User_ID 			INT,
    Interaction_Type_ID INT,
    FOREIGN KEY (Lead_ID) REFERENCES Lead_Entity(Lead_ID),
    FOREIGN KEY (User_ID) REFERENCES User_Entity(User_ID),
    FOREIGN KEY (Interaction_Type_ID) REFERENCES Interaction_Type_Entity(Interaction_Type_ID)
);

CREATE TABLE Document_Entity (
    Document_ID	INT AUTO_INCREMENT PRIMARY KEY,
    Document_Name 	VARCHAR(100),
    Filepath		VARCHAR(255),
    Upload_Date 	DATE,
    Lead_ID 		INT,
    FOREIGN KEY (Lead_ID) REFERENCES Lead_Entity(Lead_ID)
);

CREATE TABLE Commission_Entity (
    Commission_ID 		INT  AUTO_INCREMENT PRIMARY KEY,
    Amount 			NUMERIC(10,2),
    Date 				DATE,
    Lead_ID INT,
    User_ID INT,
    FOREIGN KEY (Lead_ID) REFERENCES Lead_Entity(Lead_ID),
    FOREIGN KEY (User_ID) REFERENCES User_Entity(User_ID)
);

CREATE TABLE Lead_Origin_Entity (
    Lead_ID 		INT,
    Src_ID 		INT,
    FOREIGN KEY (Lead_ID) REFERENCES Lead_Entity(Lead_ID),
    FOREIGN KEY (Src_ID) REFERENCES Lead_Src_Entity(Src_ID)
);


INSERT INTO User_Type_Entity ( user_type_name) VALUES ('Admin');
INSERT INTO User_Type_Entity ( user_type_name) VALUES ('Student');
INSERT INTO User_Type_Entity ( user_type_name) VALUES ('Teacher');
INSERT INTO User_Type_Entity ( user_type_name) VALUES ('Other');


INSERT INTO User_Entity (First_Name,	Last_Name,	Role,	Email,	Password,	Created_Date,	Updated_Date,	User_Type_ID)
VALUES ('Ayesha', 'Sajjad', 'Admin', 'ayesha.sajjad@learnersacademy.pk', 'ayeshasajjad@learners', '2023-01-01', NULL, 
        (SELECT user_type_id from User_Type_Entity WHERE user_type_name = 'Admin'));


INSERT INTO User_Entity ( First_Name,	Last_Name,	Role,	Email,	Password,	Created_Date,	Updated_Date,	User_Type_ID)
VALUES ( 'Nouman', 'Ahmed', 'CEO', 'noumanahmed1989@gmail.com', 'noumanahmed1989@learners', NULL, NULL, 
        (SELECT user_type_id from User_Type_Entity WHERE user_type_name = 'Other'));




INSERT INTO Interaction_Type_Entity (Interaction_Type_Name) VALUES ('Call');
INSERT INTO Interaction_Type_Entity (Interaction_Type_Name) VALUES ('Email');
INSERT INTO Interaction_Type_Entity (Interaction_Type_Name) VALUES ('Face to face');
INSERT INTO Interaction_Type_Entity (Interaction_Type_Name) VALUES ('Whats App');
INSERT INTO Interaction_Type_Entity (Interaction_Type_Name) VALUES ('Other');


INSERT INTO Lead_Category_Entity (Category_Name) VALUES ('hot');
INSERT INTO Lead_Category_Entity (Category_Name) VALUES ('medium');
INSERT INTO Lead_Category_Entity (Category_Name) VALUES ('cold');


