-- Commands used to create Moss CLinc Database Tables
CREATE TABLE IF NOT EXISTS userdb(
    userid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    last_login DATE,
    user_type VARCHAR(50)
    );

CREATE TABLE IF NOT EXISTS surveydb(
    survey_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    survey_date DATETIME
    );

CREATE TABLE IF NOT EXISTS questiondb(
    question_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    question_type VARCHAR(50),
    question BLOB
    );

CREATE TABLE IF NOT EXISTS survey_responsedb(
    response_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    response_date DATETIME,
    survey_response_value INT(11)
    );

CREATE TABLE IF NOT EXISTS tagdb(
    tag_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50)
    );

CREATE TABLE IF NOT EXISTS categorydb(
    category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50)
    );

DROP TABLE IF EXISTS emdb;
CREATE TABLE IF NOT EXISTS emdb(
    materialid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    upload_date DATETIME,
    uploaded_by INT NOT NULL,
    file_type VARCHAR(50),
    description LONGTEXT,
    upload_file_path VARCHAR(50),
    CONSTRAINT uploaded_by_fk
    FOREIGN KEY (uploaded_by)
    REFERENCES userdb (userid)
    );

CREATE TABLE IF NOT EXISTS em_tagdb(
    materialid INT NOT NULL,
    tag_id INT NOT NULL,
    CONSTRAINT materialid_fk
    FOREIGN KEY (materialid)
    REFERENCES emdb (materialid),
    CONSTRAINT tag_id
    FOREIGN KEY (tag_id)
    REFERENCES tagdb (tag_id)
    );

CREATE TABLE IF NOT EXISTS em_categorydb(
    materialid INT,
    category_id INT,
    CONSTRAINT material_id_fk
    FOREIGN KEY (materialid)
    REFERENCES emdb (materialid),
    CONSTRAINT category_id_fk
    FOREIGN KEY (category_id)
    REFERENCES categorydb (category_id)
    );

CREATE TABLE IF NOT EXISTS survey_questiondb(
    survey_id INT,
    question_id INT,
    CONSTRAINT survey_id_fk
    FOREIGN KEY (survey_id)
    REFERENCES surveydb (survey_id),
    CONSTRAINT question_id_fk
    FOREIGN KEY (question_id)
    REFERENCES questiondb (question_id)
    );

CREATE TABLE IF NOT EXISTS question_responsedb(
    question_id INT,
    response_id INT,
    CONSTRAINT questionid_fk
    FOREIGN KEY (question_id)
    REFERENCES questiondb (question_id),
    CONSTRAINT response_id_fk
    FOREIGN KEY (response_id)
    REFERENCES survey_responsedb (response_id)
    );

