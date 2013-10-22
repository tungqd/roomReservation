DROP VIEW IF EXISTS BookingUsers;
CREATE VIEW BookingUsers as
SELECT Booking.ID, title, starttime, endtime, date, rID, User.name, attendees, status 
FROM User, Booking
WHERE User.ID = Booking.uID;