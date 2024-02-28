CREATE TABLE `cars` (
 `car_id` INT(10) NOT NULL PRIMARY AUTO_INCREMENT,
 `make` VARCHAR(255) NOT NULL,
 `model` VARCHAR(255) NOT NULL,
 `price` DECIMAL(10, 2) NOT NULL,
 `yom` INT(10) NOT NULL,
 PRIMARY KEY (`car_id`)
);

INSERT INTO `cars` (`make`, `model`, `price`, `yom`) 
VALUES ('Holden', 'Astra', 14000.00, 2005),
('BMW', 'X3', 35000.00, 2004),
('Ford', 'Falcon', 39000.00, 2011),
('Toyota', 'Corolla', 20000.00, 2012),
('Holden', 'Commodore', 13500.00, 2005),
('Holden', 'Astra', 8000.00, 2001),
('Holden', 'Commodore', 28000.00, 2009),
('Ford', 'Falcon', 14000.00, 2007),
('Ford', 'Falcon', 7000.00, 2003),
('Ford', 'Laser', 10000.00, 2010),
('Mazda', 'RX-7', 26000.00, 2000),
('Toyota', 'Corolla', 12000.00, 2001),
('Mazda', '3', 14500.00, 2009);

SELECT * FROM cars;

SELECT make, model, price FROM cars ORDER BY make, model;

SELECT make, model FROM cars WHERE price >= 20000.00;

SELECT make, model FROM cars WHERE price < 15000.00;

SELECT make, model FROM cars WHERE price < 15000.00;

