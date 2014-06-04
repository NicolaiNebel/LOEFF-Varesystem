CREATE TABLE Users(
    uid         INTEGER PRIMARY KEY,
    name        TEXT,
    password    TEXT,
    isAdmin     INT,
    email       TEXT,
    adress      TEXT,
    zip         INT
);

--All dates must be in format 'YYYY-mm-dd'

CREATE TABLE recurringProducts(
    pid                 INTEGER PRIMARY KEY,
    name                TEXT,
    price               INT,
    description         TEXT,
    payWindow           INT,
    weekly_or_monthly   CHAR,
    timeBetween         INT,
    startDate           TEXT
);

CREATE TABLE Products(
    pid         INTEGER PRIMARY KEY,
    name        TEXT,
    price       INT,
    delivDate   TEXT,
    payDate     TEXT,
    description TEXT
);

CREATE TABLE Orders(
    uid         INTEGER,
    pid         INTEGER,
    quantity    INT,
    FOREIGN KEY(uid) REFERENCES Users(uid)
                                        ON UPDATE cascade
                                        ON DELETE cascade,
    FOREIGN KEY(pid) REFERENCES Products(pid)
                                        ON UPDATE cascade
                                        ON DELETE cascade
);

INSERT INTO Products(name, price, delivDate, payDate, description)
VALUES ("Bananas", 100, '2014-06-05', '2014-06-03', ''),
       ("Platypi", 200, '2014-06-05', '2014-06-03', '');
