CREATE TABLE user
(
         id int PRIMARY KEY NOT NULL,
         first_name varchar(50) NOT NULL,
         last_name varchar(50) NOT NULL,
         email varchar(100) NOT NULL,
         password char(60) NOT NULL,
         created int NOT NULL,
         user_group int NOT NULL
);

ALTER TABLE user MODIFY id INT AUTO_INCREMENT;
ALTER TABLE post ADD author_id int NULL;
CREATE INDEX post_author_id_index ON post(author_id);
ALTER TABLE post ADD FOREIGN KEY (author_id) REFERENCES user(id);
