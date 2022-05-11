CREATE TABLE IF NOT EXISTS Products(
    id int AUTO_INCREMENT PRIMARY  KEY,
    name varchar(60) UNIQUE, -- alternatively you'd have a SKU that's unique
    description text,
    stock int DEFAULT  0,
    cost int DEFAULT  99999,
    visibility int DEFAULT 1,
    image text, -- this col type can't have a default value
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
) 