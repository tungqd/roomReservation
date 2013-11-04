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