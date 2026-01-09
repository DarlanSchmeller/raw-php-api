DROP TABLE IF EXISTS customers;  
CREATE TABLE customers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    status ENUM('active', 'inactive', 'blocked') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO customers (first_name, last_name, email, phone, status) VALUES
('John', 'Doe', 'john.doe@email.com', '+1-202-555-0142', 'active'),
('Jane', 'Smith', 'jane.smith@email.com', '+1-202-555-0187', 'active'),
('Michael', 'Brown', 'michael.brown@email.com', '+1-202-555-0119', 'inactive'),
('Emily', 'Johnson', 'emily.johnson@email.com', '+1-202-555-0194', 'active'),
('Carlos', 'Mendez', 'carlos.mendez@email.com', '+55-11-99876-5432', 'blocked'),
('Ana', 'Silva', 'ana.silva@email.com', '+55-21-98765-4321', 'active'),
('Robert', 'Wilson', 'robert.wilson@email.com', '+1-415-555-0173', 'inactive'),
('Laura', 'Garcia', 'laura.garcia@email.com', '+34-600-123-456', 'active');
