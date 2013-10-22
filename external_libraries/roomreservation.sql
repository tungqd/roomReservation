DROP DATABASE IF EXISTS RoomReservation;
CREATE DATABASE RoomReservation;
USE RoomReservation;

DROP TABLE IF EXISTS Room;
CREATE TABLE Room
(ID INT not null,
name VARCHAR(30),
location VARCHAR(30),
capacity INT not null,
status VARCHAR(30),
PRIMARY KEY(ID)
);

DROP TABLE IF EXISTS User;
CREATE TABLE User
(ID INT not null,
name VARCHAR(30),
position VARCHAR(30),
PRIMARY KEY(ID, name)
);

DROP TABLE IF EXISTS Booking;
CREATE TABLE Booking
(ID INT not null AUTO_INCREMENT,
title VARCHAR(30),
starttime TIME,
endtime TIME,
date DATE,
rID INT,
uID INT,
attendees INT,
status VARCHAR(30),
updatedAt DATE,
PRIMARY KEY(ID),
FOREIGN KEY (rID) REFERENCES Room(ID),
FOREIGN KEY (uID) REFERENCES User(ID)
ON DELETE SET NULL
ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Schedule;
CREATE TABLE Schedule
(rID INT not null,
bookingID INT not null,
PRIMARY KEY(rID, bookingID),
FOREIGN KEY(rID) REFERENCES Room(ID),
FOREIGN KEY(bookingID) REFERENCES Booking(ID)
ON UPDATE CASCADE
);

DROP TABLE IF EXISTS UserMeeting;
CREATE TABLE UserMeeting
(uID INT not null,
bookingID INT not null,
PRIMARY KEY(uID, bookingID),
FOREIGN KEY(uID) REFERENCES User(ID),
FOREIGN KEY(bookingID) REFERENCES Booking(ID)
ON UPDATE CASCADE
);

LOAD DATA LOCAL INFILE '/Applications/XAMPP/xamppfiles/htdocs/roomReservation/external_libraries/users.txt' INTO TABLE User;
LOAD DATA LOCAL INFILE '/Applications/XAMPP/xamppfiles/htdocs/roomReservation/external_libraries/rooms.txt' INTO TABLE Room;

