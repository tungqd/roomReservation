Use RoomReservation;
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