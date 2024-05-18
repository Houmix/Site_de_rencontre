CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gender TEXT NOT NULL,
    firstname TEXT NOT NULL,
    lastname TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    phone TEXT NOT NULL,
    city TEXT NOT NULL,
    birthday TEXT NOT NULL,
    orientation TEXT NOT NULL,
    bio TEXT,
    is_admin INTEGER NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    subscription TEXT
);
