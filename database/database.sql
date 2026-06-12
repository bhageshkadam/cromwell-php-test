CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    forenames VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    title VARCHAR(20),
    dob DATE,
    mobile_phone VARCHAR(20),
    other_phone VARCHAR(20),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);