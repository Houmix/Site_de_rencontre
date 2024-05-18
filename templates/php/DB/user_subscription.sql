CREATE TABLE user_subscription (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    subscription TEXT NOT NULL,
    remaining_like INTEGER,
    start TEXT NOT NULL,
    end TEXT NOT NULL
);