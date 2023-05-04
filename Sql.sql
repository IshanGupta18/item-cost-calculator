CREATE database project;
USE project;

CREATE TABLE items (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO items (name, quantity, price) VALUES
  ('Item 1', 30, 100),
  ('Item 2', 20, 50),
  ('Item 3', 10, 200),
  ('Item 4', 5, 300),
  ('Item 5', 15, 150);


select * from items;

