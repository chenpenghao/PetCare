DROP TABLE request;
DROP TABLE pet;
DROP TABLE petcategory;
DROP TABLE pet_user;

DROP SEQUENCE user_id_seq;
DROP SEQUENCE pets_id_seq;
DROP SEQUENCE request_id_seq;
--DROP SEQUENCE avail_id_seq;

CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 0 START WITH 1 NO CYCLE;
CREATE SEQUENCE pets_id_seq INCREMENT BY 1 MINVALUE 0 START WITH 1 NO CYCLE;
CREATE SEQUENCE request_id_seq INCREMENT BY 1 MINVALUE 0 START WITH 1 NO CYCLE;
CREATE SEQUENCE avail_id_seq INCREMENT BY 1 MINVALUE 0 START WITH 1 NO CYCLE;



CREATE TABLE petcategory(
    pcat_id INT PRIMARY KEY,
    size VARCHAR(20),
    age VARCHAR(10),
    name VARCHAR(100)
);

CREATE TABLE pet_user(
    user_id INT PRIMARY KEY DEFAULT nextval('user_id_seq'),
    name VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL,
    email VARCHAR(64) UNIQUE,
    address VARCHAR(64)
);

CREATE TABLE pet(
    pets_id INT PRIMARY KEY DEFAULT nextval('pets_id_seq'),
    owner_id INT REFERENCES pet_user(user_id),
    pcat_id INT REFERENCES petcategory(pcat_id)
);

CREATE TABLE availability(
    avail_id INT PRIMARY KEY DEFAULT nextval('avail_id_seq'),
    begin_time TIME NOT NULL,
    begin_date DATE NOT NULL,
    end_time TIME NOT NULL,
    end_date DATE NOT NULL,
    pcat_id INT REFERENCES petcategory(pcat_id),
    taker_id INT REFERENCES pet_user(user_id),
    is_deleted BOOLEAN
);

CREATE TABLE request(
    request_id INT PRIMARY KEY DEFAULT nextval('request_id_seq'),
    avail_id INT REFERENCES availability(avail_id),
    begin_time TIME NOT NULL,
    begin_date DATE NOT NULL,
    end_time TIME NOT NULL,
    end_date DATE NOT NULL,
    bids NUMERIC NOT NULL,
    pets_id INT REFERENCES pet(pets_id),
    status VARCHAR(20) DEFAULT 'pending' CHECK (status IN ('pending', 'failed', 'successful'))
);

INSERT INTO petcategory(pcat_id, age, size, name) VALUES (1,'puppy','small','Chihuahua');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (2,'puppy','medium','Maltese');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (3,'puppy','large','Corgi');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (4,'puppy','giant','Shepherd');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (5,'adult','small','Chihuahua');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (6,'adult','medium','Maltese');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (7,'adult','large','Corgi');
INSERT INTO petcategory(pcat_id, age, size, name) VALUES (8,'adult','giant','Shepherd');

INSERT INTO pet_user(name, password, email, address) VALUES ('Patti Dennis',12345,'empathy@msn.com','157 Foxrun Street Newnan, GA 30263');
INSERT INTO pet_user(name, password, email, address) VALUES ('Carmen Grant',23456,'presoff@hotmail.com','9 South Surrey Street Rockford, MI 49341');
INSERT INTO pet_user(name, password, email, address) VALUES ('Abel Lucas',34567,'keijser@optonline.net','930 Storm Court Washington, PA 15301');
INSERT INTO pet_user(name, password, email, address) VALUES ('Marguerite Jennings',45678,'curly@gmail.com','508 E. Longfellow Rd. Revere, MA 02151');
INSERT INTO pet_user(name, password, email, address) VALUES ('Samuel Lawrence',56789,'squirrel@aol.com','8807 Aurora Road Ogden, UT 84404');
INSERT INTO pet_user(name, password, email, address) VALUES ('Lydia Turner',67900,'cantu@verizon.net','29 Paradise Court Moorhead, MN 56560');
INSERT INTO pet_user(name, password, email, address) VALUES ('Eloise Cooper',79011,'pajas@msn.com','9267 1st St. Wenatchee, WA 98801');
INSERT INTO pet_user(name, password, email, address) VALUES ('Maxine Ramos',90122,'vertigo@aol.com','671 Liberty Dr. Ankeny, IA 50023');
INSERT INTO pet_user(name, password, email, address) VALUES ('Kyle Colon',12334,'aprakash@me.com','49 Walt Whitman Street Apopka, FL 32703');
INSERT INTO pet_user(name, password, email, address) VALUES ('Laverne Valdez',12344,'lishoy@verizon.net','12 Bald Hill Street Norfolk, VA 23503');
INSERT INTO pet_user(name, password, email, address) VALUES ('David Reynolds',23455,'marnanel@hotmail.com','224 Second Drive Cocoa, FL 32927');
INSERT INTO pet_user(name, password, email, address) VALUES ('Clyde Mack',34566,'smartfart@verizon.net','870 Addison Court Dacula, GA 30019');
INSERT INTO pet_user(name, password, email, address) VALUES ('Cameron Huff',45677,'petersko@yahoo.ca','7834 Ann Street Quincy, MA 02169');
INSERT INTO pet_user(name, password, email, address) VALUES ('Ebony Mendez',56788,'avalon@att.net','8789 Hart St. Ballston Spa, NY 12020');
INSERT INTO pet_user(name, password, email, address) VALUES ('Joe Munoz',67899,'ournews@live.com','94 Meadowbrook St.Apt 36 Florence, SC 29501');
INSERT INTO pet_user(name, password, email, address) VALUES ('Travis Pearson',79010,'chaffar@mac.com','436 E. Second Avenue Missoula, MT 59801');
INSERT INTO pet_user(name, password, email, address) VALUES ('Robin Goodman',90121,'mdielmann@hotmail.com','11 Brewer Road Chardon, OH 44024');
INSERT INTO pet_user(name, password, email, address) VALUES ('Marcus Gilbert',81232,'weazelman@yahoo.com','12 Summerhouse St. Hoboken, NJ 07030');
INSERT INTO pet_user(name, password, email, address) VALUES ('Doug Neal',12343,'msloan@me.com','5 East Proctor Street Missoula, MT 59801');
INSERT INTO pet_user(name, password, email, address) VALUES ('Josephine Erickson',23454,'goresky@msn.com','7943 East Lakeshore Street Rockford, MI 49341');

INSERT INTO pet(pcat_id, owner_id) VALUES (2,1);
INSERT INTO pet(pcat_id, owner_id) VALUES (3,5);
INSERT INTO pet(pcat_id, owner_id) VALUES (5,4);
INSERT INTO pet(pcat_id, owner_id) VALUES (1,2);
INSERT INTO pet(pcat_id, owner_id) VALUES (4,8);
INSERT INTO pet(pcat_id, owner_id) VALUES (7,3);
INSERT INTO pet(pcat_id, owner_id) VALUES (2,9);
INSERT INTO pet(pcat_id, owner_id) VALUES (5,6);
INSERT INTO pet(pcat_id, owner_id) VALUES (2,10);
INSERT INTO pet(pcat_id, owner_id) VALUES (8,7);