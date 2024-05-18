CREATE TABLE user_subscription (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    subscription TEXT NOT NULL,
    change_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    start DATE NOT NULL,
    end DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);