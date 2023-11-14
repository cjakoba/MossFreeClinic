/*
* **Moss Free Clinic Educational Materials**
*
* DELETE FROM userdb;
* DELETE FROM tagdb;
* DELETE FROM categorydb;
* DELETE FROM em_posts;
* DELETE FROM em_tagdb;
* DELETE FROM em_categorydb;
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
INSERT INTO userdb (username, password, last_login, user_type) 
VALUES ("homebasedb", "homebasedb", "2023-10-31", "exec");


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

INSERT INTO em_posts (post_title, post_date, post_author, post_type, post_content, post_status) 
VALUES ("Bone Diseases", "2023-10-31 12:00:00", 1, 'blog', "Bones", 'published');
INSERT INTO em_posts (post_title, post_date, post_author, post_type, post_content, post_status) 
VALUES ("Heart Surgery", "2023-10-31 12:00:00", 1, 'blog', "Everything you need to know about Open Heart Surgery", 'published');
INSERT INTO em_posts (post_title, post_date, post_author, post_type, post_content, post_status) 
VALUES ("Cardiovascular Exercises", "2023-10-31 12:00:00", 1, 'blog', "Best exercises for your cardiovascular system", 'published');

INSERT INTO em_tagdb (post_id, tag_id) VALUES (1,1);
INSERT INTO em_tagdb (post_id, tag_id) VALUES (1,2);
INSERT INTO em_tagdb (post_id, tag_id) VALUES (2,4);
INSERT INTO em_tagdb (post_id, tag_id) VALUES (3,4);
INSERT INTO em_tagdb (post_id, tag_id) VALUES (3,5);

INSERT INTO em_categorydb (post_id, category_id) VALUES (1,3);
INSERT INTO em_categorydb (post_id, category_id) VALUES (2,9);
INSERT INTO em_categorydb (post_id, category_id) VALUES (3,1);

INSERT INTO em_posts 
(post_title, post_author, post_date, post_type, post_content, post_status) 
VALUES
('Diabetes', 
1, 
'2023-11-07 10:37:52', 
'blog', 
'{\"time\":1699371472615,
\"blocks\":[{\"id\":\"6j0LxzNU7f\",
\"type\":\"header\",
\"data\":{\"text\":\"Overview\",
\"level\":2}},
{\"id\":\"A1snvfHA8C\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). 
Glucose is an important source of energy for the cells that make up the muscles and tissues. 
It\'s also the brain\'s main source of fuel.\"
}},
{\"id\":\"JMUIs69Uix\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"The main cause of diabetes varies by type. 
But no matter what type of diabetes you have, it can lead to excess sugar in the blood. 
Too much sugar in the blood can lead to serious health problems.\"
}},
{\"id\":\"cyodKHlA40\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. 
Potentially reversible diabetes conditions include prediabetes and gestational diabetes. 
Prediabetes happens when blood sugar levels are higher than normal. 
But the blood sugar levels aren\'t high enough to be called diabetes. 
And prediabetes can lead to diabetes unless steps are taken to prevent it. 
Gestational diabetes happens during pregnancy. 
But it may go away after the baby is born.\"
}},
{\"id\":\"FJNy_-j-X7\",
\"type\":\"paragraph\",
\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},
{\"id\":\"vOL3xZ7uox\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"
}},
{\"id\":\"_stS2xXp8h\",
\"type\":\"header\",
\"data\":{\"text\":\"Symptoms\",
\"level\":2}},
{\"id\":\"EK0dXBlh14\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"Diabetes symptoms depend on how high your blood sugar is. 
Some people, especially if they have
&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">
prediabetes
<\\/a>,
&nbsp;
<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">
gestational diabetes
<\\/a>&nbsp;
or&nbsp;
<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">
type 2 diabetes
<\\/a>
, may not have symptoms. In&nbsp;
<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">
type 1 diabetes
<\\/a>
, symptoms tend to come on quickly and be more severe.\"
}},
{\"id\":\"MyZvFrHXqh\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"
}},
{\"id\":\"tvQVXYFaXm\",
\"type\":\"list\",
\"data\":{\"style\":\"unordered\",
\"items\":
[\"Feeling more thirsty than usual.\",
\"Urinating often.\",
\"Losing weight without trying.\",
\"Presence of ketones in the urine. 
Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",
\"Feeling tired and weak.\",
\"Feeling irritable or having other mood changes.\",
\"Having blurry vision.\",
\"Having slow-healing sores.\",
\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]
}},
{\"id\":\"r9b5okf-yY\",
\"type\":\"paragraph\",
\"data\":{\"text\":\
"Type 1 diabetes can start at any age. 
But it often starts&nbsp;
<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">
during childhood
<\\/a>&nbsp;
or teen years. 
Type 2 diabetes, 
the more common type, 
can develop at any age. 
Type 2 diabetes is more common in people older than 40. 
But&nbsp;
<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">
type 2 diabetes in children
<\\/a>&nbsp;
is increasing.\"
}},
{\"id\":\"Sg5kqbOH61\",
\"type\":\"embed\",
\"data\":{\"service\":\"youtube\",
\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",
\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",
\"width\":580,
\"height\":320,
\"caption\":\"Video from YouTube\"}}],
\"version\":\"2.28.2\"}', 
'published');

INSERT INTO ratingdb (rating, em_post_id) VALUES (5,1);
INSERT INTO ratingdb (rating, em_post_id) VALUES (2,1);
INSERT INTO ratingdb (rating, em_post_id) VALUES (3,2);
INSERT INTO ratingdb (rating, em_post_id) VALUES (4,3);
INSERT INTO ratingdb (rating, em_post_id) VALUES (5,4);
INSERT INTO ratingdb (rating, em_post_id) VALUES (1,4);