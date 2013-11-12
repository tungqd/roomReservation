USE RoomReservation;
DROP PROCEDURE IF EXISTS checkSchedule;
delimiter //
CREATE PROCEDURE checkSchedule(IN startt TIME, IN endt TIME, IN mdate DATE)
BEGIN
	SELECT count(*) FROM Schedule JOIN Booking ON (Schedule.bookingID = Booking.ID) WHERE
	date = mdate 
	and ((startt between starttime and endtime) or (endt between starttime and endtime)
	or (startt < starttime and endt > endtime)); 
END;
// delimiter ;


CALL checkSchedule(120000,140000,20131104);