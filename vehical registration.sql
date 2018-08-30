CREATE TABLE VehicleRegistration (
	PersonID int,
	NameOfEmployee varchar(255),
	VehicleMake varchar(255),
	VehicleModel varchar(255),
	StartDate varchar(255),
	EndDate varchar(255),
);

SELECT *
FROM VehicleRegistration;

INSERT INTO VehicleRegistration (NameOfEmployee, VehicleMake, VehicleModel, StartDate, EndDate)
VALUES ('Rhiannon Olschansky','Toyota','4Runner', 'July 9, 2018','January 1, 2019');

SELECT *
FROM VehicleRegistration