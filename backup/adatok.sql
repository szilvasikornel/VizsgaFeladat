CREATE TABLE Players (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Password VARCHAR(100)
);

CREATE TABLE Game (
    ID INT PRIMARY KEY,
    Player_ID INT,
    Saves VARCHAR(255),
    Maps VARCHAR(255),
    Damage INT,
    Weapons VARCHAR(255),
    `Character` INT, 
    Difficulty VARCHAR(50),
    Enemies VARCHAR(255),
    Armor INT,
    FOREIGN KEY (Player_ID) REFERENCES Players(ID)
);
