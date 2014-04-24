CREATE TABLE Users(uid INTEGER PRIMARY KEY, username TEXT, password TEXT, isAdmin INT);

CREATE TABLE Products(pid INTEGER PRIMARY KEY, name TEXT, price INT);

CREATE TABLE Orders( uid INTEGER, pid INTEGER, quantity INT, FOREIGN KEY(uid) REFERENCES Users(uid), FOREIGN KEY(pid) REFERENCES Products(pid));

INSERT INTO Users(username, password, isAdmin) VALUES ('Fire Hydrant', 'Ravishing', 1);

INSERT INTO Products(name, price) values ('groentsagspose', 10000);
