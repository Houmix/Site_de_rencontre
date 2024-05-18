CREATE TABLE subscription (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    description TEXT NOT NULL,
    name TEXT NOT NULL,
    price FLOAT NOT NULL,
    duration INTEGER NOT NULL UNIQUE,
    limited_like INTEGER NOT NULL DEFAULT 1,
    number_like INTEGER
);
