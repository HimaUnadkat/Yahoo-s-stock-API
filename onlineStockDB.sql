DROP DATABASE IF EXISTS onlineStockAPI;
CREATE DATABASE onlineStockAPI;
USE onlineStockAPI;

CREATE TABLE users (
  uid INT(11)  NOT NULL AUTO_INCREMENT,
  ufname varchar(20) NOT NULL,
  
  ulname  VARCHAR(25)   NOT NULL,
uemail          VARCHAR(25)   NOT NULL,
upassword varchar(25) NOT NULL,

PRIMARY KEY (uid)
);  
select * from `onlineStockAPI`.users;
    select * from users;   

CREATE TABLE money (
  m_id INT(11)  NOT NULL AUTO_INCREMENT,
  m_uid INT(11) NOT NULL,
m_transaction varchar(10) not null,
  m_amount varchar(20) ,
  m_creditcardtype       VARCHAR(25)   ,
  m_creditcardno         VARCHAR(25) ,
  m_totalBalance INT(20),
  m_Date date,

PRIMARY KEY (m_id)  
);  


create table tempStock(
temp_id INT(11)  NOT NULL AUTO_INCREMENT,
 temp_uid INT(11) NOT NULL,
  temp_stockSymbol varchar(20) ,
temp_stockPrice      varchar(11)   ,
  temp_quantity        INT(11) ,
temp_total varchar(11),
temp_date date,
PRIMARY KEY (temp_id)  
);

create table purchaseStock(
p_id INT(11)  NOT NULL AUTO_INCREMENT,
 p_uid INT(11) NOT NULL,
  p_stockSymbol varchar(20) ,
p_stockPrice      varchar(11)   ,
  p_quantity        INT(11) ,
p_total varchar(11),
p_date date,
PRIMARY KEY (p_id)  
);

create table sellRecords(
s_id INT(11)  NOT NULL AUTO_INCREMENT,
s_uid INT(11) NOT NULL,
  s_stockSymbol varchar(20) ,
s_stockSellPrice      varchar(11)   ,
  s_quantity        INT(11) ,
s_totalSell varchar(11),
s_date date,
s_profit varchar(10),
s_loss varchar(10),
PRIMARY KEY (s_id)  
);

select sum(temp_total) from tempStock where temp_uid='2'
select * from money;
select * from sellRecords;
select * from purchaseStock;
select * from tempStock;
select * from users;
