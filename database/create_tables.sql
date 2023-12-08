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
    question VARCHAR(500),
    numAnswers int,
    question_priority int,
    times_answered int
    );

CREATE TABLE IF NOT EXISTS answerdb(
    answerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    questionID INT,
    answer VARCHAR(250),
    answer_priority int,
    times_answered int
);

CREATE TABLE IF NOT EXISTS responsedb(
    responseID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    answer VARCHAR(500),
    questionID INT,
    surveyID INT(11)
    );

CREATE TABLE IF NOT EXISTS tagdb(
    tag_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50)
    );

CREATE TABLE IF NOT EXISTS categorydb(
    category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50)
    );

CREATE TABLE IF NOT EXISTS em_posts(
    post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_title VARCHAR(50),
    post_author INT(11),
    post_date DATETIME,
    post_type VARCHAR(20),
    post_content LONGTEXT,
    post_status VARCHAR(20),
    CONSTRAINT post_author_fk
    FOREIGN KEY (post_author)
    REFERENCES userdb (userid)
    );

CREATE TABLE IF NOT EXISTS em_tagdb(
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    CONSTRAINT em_tagdb_post_id_fk
    FOREIGN KEY (post_id)
    REFERENCES em_posts (post_id),
    CONSTRAINT em_tagdb_tag_id_fk
    FOREIGN KEY (tag_id)
    REFERENCES tagdb (tag_id)
    );

CREATE TABLE IF NOT EXISTS em_categorydb(
    post_id INT,
    category_id INT,
    CONSTRAINT em_categorydb_post_id_fk
    FOREIGN KEY (post_id)
    REFERENCES em_posts (post_id),
    CONSTRAINT em_category_category_id_fk
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

