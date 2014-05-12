CREATE TABLE Users(uid INTEGER PRIMARY KEY, name TEXT, password TEXT, isAdmin INT, email TEXT, adress TEXT, zip INT);

CREATE TABLE Products(pid INTEGER PRIMARY KEY, name TEXT, price INT, sellDate TEXT, payDate TEXT);

CREATE TABLE Orders( uid INTEGER, pid INTEGER, quantity INT, FOREIGN KEY(uid) REFERENCES Users(uid), FOREIGN KEY(pid) REFERENCES Products(pid));

INSERT INTO Users(name, password, isAdmin, email, adress, zip) VALUES ('Fire Hydrant', 'Ravishing', 1, 'e@mail.com', 'Some Road 4', 2200);

INSERT INTO Products(name, price, sellDate, payDate) values ('groentsagspose', 10000, '2014-6-12', '2014-6-1');
