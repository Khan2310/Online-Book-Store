CREATE TABLE users (
  userid NUMBER(10) PRIMARY KEY,
  email VARCHAR(64) NOT NULL,
  name VARCHAR(100) NOT NULL,
  password VARCHAR(40) NOT NULL,
  is_admin NUMBER(1) DEFAULT 0 NOT NULL
);
CREATE SEQUENCE userid_sequence start with 1
increment by 1
minvalue 1
maxvalue 9999999999;

CREATE TABLE books (
  bookid NUMBER(10) PRIMARY KEY,
  bookname VARCHAR(128) NOT NULL,
  author VARCHAR(128) NOT NULL,
  publisher VARCHAR(64) NOT NULL,
  price NUMBER(5) NOT NULL,
  category VARCHAR(25) DEFAULT 'uncategorized';
  quantity_remaining NUMBER(5) NOT NULL;
);

CREATE SEQUENCE bookid_sequence start with 1
increment by 1
minvalue 1
maxvalue 9999999999;

CREATE TABLE cart (
  userid NUMBER(10) NOT NULL,
  bookid NUMBER(10) NOT NULL,
  quantity NUMBER(2) NOT NULL,
  is_active NUMBER(2) NOT NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  CONSTRAINT fk_userid FOREIGN KEY (userid) REFERENCES users(userid),
  CONSTRAINT fk_bookid FOREIGN KEY (bookid) REFERENCES books(bookid)
);
