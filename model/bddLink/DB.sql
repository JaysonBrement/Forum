CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    registration_date DATETIME NOT NULL,
    profile_bio TEXT,
    profile_picture TEXT
)ENGINE=InnoDB;

CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE Threads (
    thread_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    view_nb INT NOT NULL,
    thread_date DATETIME NOT NULL,
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
)ENGINE=InnoDB;

CREATE TABLE Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    post_date DATETIME NOT NULL,
    FOREIGN KEY (thread_id) REFERENCES Threads(thread_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
)ENGINE=InnoDB;


CREATE TABLE Private_Messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    content TEXT NOT NULL,
    deleted TINYINT(1) NOT NULL,
    timestamp DATETIME NOT NULL,
    FOREIGN KEY (sender_id) REFERENCES Users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES Users(user_id)
)ENGINE=InnoDB;

ALTER TABLE Users 
MODIFY registration_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE Posts 
MODIFY post_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE Threads 
MODIFY thread_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE Private_Messages 
MODIFY timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE Private_Messages
MODIFY COLUMN deleted TINYINT(1) NOT NULL DEFAULT 0;

-- -- Create Moderation Log Table
-- CREATE TABLE Moderation_Log (
--     log_id INT AUTO_INCREMENT PRIMARY KEY,
--     moderator_id INT NOT NULL,
--     action TEXT NOT NULL,
--     affected_id INT,
--     timestamp DATETIME NOT NULL,
--     FOREIGN KEY (moderator_id) REFERENCES Users(user_id)
-- )ENGINE=InnoDB;

---- user insertion scheme

-- user insertion
INSERT INTO Users (username, password_hash,email,profile_bio,profile_picture)VALUES 
('example_username', 'example_hash', 'example_email','example_bio','example_lien_image');


--thread insertion
INSERT INTO Threads (title, user_id, category_id, view_nb, description) VALUES 
('testthread', 2, 5 ,13 ,'je suis une description de thread');

-- post insertion
INSERT INTO Posts (thread_id, user_id, content) VALUES
(1, 1, 'testpost1'),
(1, 1, 'testpost2'),
(1, 1, 'testpost3'),
(1, 1, 'testpost4'),
(1, 1, 'testpost5');

-- private messages insertion
INSERT INTO Private_Messages (sender_id, receiver_id, content) VALUES
(2, 1, 'Salut user 1'),
(1, 2, 'Salut user 2');

-- view incrementation
UPDATE Threads
SET view_nb = view_nb + 1
WHERE thread_id = 1;


-- insertion des catégories
INSERT INTO Categories (category_name) VALUES
('general-discussion'),
('technology'),
('entertainment'),
('health'),
('travel'),
('sports'),
('food'),
('arts'),
('science'),
('education'),
('relationships'),
('gaming'),
('politics'),
('religion'),
('environment'),
('off-topic');


--nuke
delete from Posts;
alter table Posts AUTO_INCREMENT = 1;

delete from Threads;
alter table Threads AUTO_INCREMENT = 1;

delete from Users;
alter table Users AUTO_INCREMENT = 1;

delete from Categories;
alter table Categories AUTO_INCREMENT = 1;