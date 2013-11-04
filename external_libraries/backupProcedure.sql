DROP PROCEDURE IF EXISTS Backup;
delimiter //
CREATE PROCEDURE Backup(IN cutoffDATE DATE)
BEGIN
	INSERT INTO Archive(ID, title, starttime, endtime, date, rID, uID, attendees, status)
	(SELECT ID, title, starttime, endtime, date, rID, uID ,attendees, status
	FROM Booking WHERE updatedAt <= cutoffDate);
END;
// delimiter ;
