/*
* **Moss Free Clinic Educational Materials**
*
* INSERT statements for EM import
*/

INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User1", "Password1", "2023-10-31", "exec");
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User2", "Password2", "2023-10-31", "exec");
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User3", "Password3", "2023-10-31", "exec");
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User4", "Password4", "2023-10-31", "admin");
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User5", "Password5", "2023-10-31", "admin");
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("User6", "Password6", "2023-10-31", "admin");

INSERT INTO tagdb (tag_name) VALUES ("Bone");
INSERT INTO tagdb (tag_name) VALUES ("Leg");
INSERT INTO tagdb (tag_name) VALUES ("Arm");
INSERT INTO tagdb (tag_name) VALUES ("Heart");
INSERT INTO tagdb (tag_name) VALUES ("Lung");
INSERT INTO tagdb (tag_name) VALUES ("Stomach");
INSERT INTO tagdb (tag_name) VALUES ("Liver");
INSERT INTO tagdb (tag_name) VALUES ("Skin");
INSERT INTO tagdb (tag_name) VALUES ("Eyes");

INSERT INTO categorydb (category_name) VALUES ("Exercise");
INSERT INTO categorydb (category_name) VALUES ("Diet");
INSERT INTO categorydb (category_name) VALUES ("Disease");
INSERT INTO categorydb (category_name) VALUES ("Congenital");
INSERT INTO categorydb (category_name) VALUES ("Medicine");
INSERT INTO categorydb (category_name) VALUES ("Muscular-System");
INSERT INTO categorydb (category_name) VALUES ("Lymphatic-System");
INSERT INTO categorydb (category_name) VALUES ("Child-Birth");
INSERT INTO categorydb (category_name) VALUES ("Surgery");

INSERT INTO emdb (name, upload_date, uploaded_by, file_type, description, upload_file_path) 
VALUES ("Bone Diseases", "2023-10-31 12:00:00", 1, NULL, "Bones", NULL);
INSERT INTO emdb (name, upload_date, uploaded_by, file_type, description, upload_file_path) 
VALUES ("Heart Surgery", "2023-10-31 12:00:00", 1, NULL, "Everything you need to know about Open Heart Surgery", NULL);
INSERT INTO emdb (name, upload_date, uploaded_by, file_type, description, upload_file_path) 
VALUES ("Cardiovascular Exercises", "2023-10-31 12:00:00", 1, NULL, "Best exercises for your cardiovascular system", NULL);

INSERT INTO em_tagdb (materialid, tag_id) VALUES (1,1);
INSERT INTO em_tagdb (materialid, tag_id) VALUES (1,2);
INSERT INTO em_tagdb (materialid, tag_id) VALUES (2,4);
INSERT INTO em_tagdb (materialid, tag_id) VALUES (3,4);
INSERT INTO em_tagdb (materialid, tag_id) VALUES (3,5);

INSERT INTO em_categorydb (materialid, category_id) VALUES (1,3);
INSERT INTO em_categorydb (materialid, category_id) VALUES (2,9);
INSERT INTO em_categorydb (materialid, category_id) VALUES (3,1);
