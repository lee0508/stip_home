CREATE TABLE contact_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    country VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
