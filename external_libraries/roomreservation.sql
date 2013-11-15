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
UNIQUE KEY(starttime, endtime, date, rID),
FOREIGN KEY (rID) REFERENCES Room(ID)
ON DELETE SET NULL
ON UPDATE CASCADE,
FOREIGN KEY (uID) REFERENCES User(ID)
ON DELETE SET NULL
ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Schedule;
CREATE TABLE Schedule
(rID INT not null,
bookingID INT not null,
PRIMARY KEY(rID, bookingID),
FOREIGN KEY(rID) REFERENCES Room(ID)
ON UPDATE CASCADE,
FOREIGN KEY(bookingID) REFERENCES Booking(ID)
ON UPDATE CASCADE
);

DROP TABLE IF EXISTS UserMeeting;
CREATE TABLE UserMeeting
(uID INT not null,
bookingID INT not null,
PRIMARY KEY(uID, bookingID),
FOREIGN KEY(uID) REFERENCES User(ID)
ON UPDATE CASCADE,
FOREIGN KEY(bookingID) REFERENCES Booking(ID)
ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Archive;
CREATE TABLE Archive
(ID INT not null,
title VARCHAR(30),
starttime TIME,
endtime TIME,
date DATE,
rID INT,
uID INT,
attendees INT,
status VARCHAR(30),
PRIMARY KEY(ID)
);


LOAD DATA LOCAL INFILE '/Applications/XAMPP/xamppfiles/htdocs/roomReservation/external_libraries/users.txt' INTO TABLE User;
LOAD DATA LOCAL INFILE '/Applications/XAMPP/xamppfiles/htdocs/roomReservation/external_libraries/rooms.txt' INTO TABLE Room;

DROP TRIGGER IF EXISTS addBooking;
delimiter //
CREATE TRIGGER addBooking AFTER INSERT ON Booking
  FOR EACH ROW
  BEGIN
	IF New.status = "confirmed" THEN INSERT INTO Schedule(rID,bookingID) VALUES (New.rID, New.ID);
	END IF;
    INSERT INTO UserMeeting(uID, bookingID) VALUES (New.uID, New.ID);
  END;
//
delimiter ;

DROP TRIGGER IF EXISTS cancelMeeting;
delimiter //
CREATE TRIGGER cancelMeeting AFTER DELETE ON Booking
  FOR EACH ROW
  BEGIN
	IF Old.status = "confirmed" THEN DELETE FROM Schedule WHERE rID = OLD.rID and bookingID = Old.ID;
	END IF;
    	DELETE FROM UserMeeting WHERE uID = Old.uID and bookingID = Old.ID;
  END;
//
delimiter ;

DROP TRIGGER IF EXISTS updateMeeting;
delimiter //
CREATE TRIGGER updateMeeting AFTER UPDATE ON Booking
  FOR EACH ROW
  BEGIN
	IF Old.status = "confirmed" THEN UPDATE Schedule SET rID = New.rID;
	END IF;
  END;
// delimiter ;


DROP PROCEDURE IF EXISTS Backup;
delimiter //
CREATE PROCEDURE Backup(IN cutoffDATE DATE)
BEGIN
	INSERT INTO Archive(ID, title, starttime, endtime, date, rID, uID, attendees, status)
	(SELECT ID, title, starttime, endtime, date, rID, uID ,attendees, status
	FROM Booking WHERE updatedAt <= cutoffDate);
END;
// delimiter ;

DROP PROCEDURE IF EXISTS checkSchedule;
delimiter //
CREATE PROCEDURE checkSchedule(IN startt TIME, IN endt TIME, IN mdate DATE, IN room INT)
BEGIN
	SELECT count(*) AS overlap FROM Schedule JOIN Booking ON (Schedule.bookingID = Booking.ID) WHERE
	date = $mdate and Booking.rID = Schedule.rID and Schedule.rID = room
	and (($startt between starttime and endtime) or ($endt between starttime and endtime)
	or ($startt < starttime and $endt > endtime));
END;
// delimiter ;

DROP VIEW IF EXISTS BookingUsers;
CREATE VIEW BookingUsers as
SELECT Booking.ID, title, starttime, endtime, date, rID, User.name, attendees, status 
FROM User, Booking
WHERE User.ID = Booking.uID;

