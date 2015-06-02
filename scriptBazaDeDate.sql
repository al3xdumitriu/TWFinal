clear screen;


drop table detaliiUtilizator;
drop table articles;
drop table Search_Table;
drop table domeniuTypesStat;
drop table queriesStat;
drop table categoriiStat;
drop table platformeStat;
drop table users;


Create Table users (
id integer unique,
username varchar2(50) unique,
password varchar2(50),
email varchar(250) unique,
active integer,
code varchar2(50),
data_c varchar2(50),
interes varchar2(250),
apelatapi integer,
constraint t_pk primary key(id,username)
);





--CREATE SEQUENCE users_seq;

CREATE OR REPLACE TRIGGER users_ins 
BEFORE INSERT ON users 
FOR EACH ROW

BEGIN
  SELECT users_seq.NEXTVAL
  INTO   :new.id
  FROM   dual;
END;
/

insert into users values(1,'alex','a197c5c3f500e6341486dd4379a27890','al3xdumitriu@yahoo.com',1,1234,'16-05-2015','gta',0);


Create Table detaliiUtilizator (
username  varchar2(50) Primary key,
nume  varchar2(50),
prenume  varchar2(50),
varsta integer,
so_folosit  varchar2(50),
platforma  varchar2(50),
limbiVorbite  varchar2(50),
telefonMobil  varchar2(50),
fix  varchar2(50),
adresa  varchar2(250),
CONSTRAINT fk_username
    FOREIGN KEY (Username)
    REFERENCES Users(Username)
);

Create Table articles (
idArt integer Primary key,
username  varchar2(50) ,
title  varchar2(250),
subtext  varchar2(550),
data_curenta date,
url  varchar2(250),
popularitate  integer,
CONSTRAINT fk_usernameart
    FOREIGN KEY (Username)
    REFERENCES Users(Username)
);
drop table evidentaVoturi;
Create Table evidentaVoturi (
username  varchar2(50) ,
idArt integer ,
votat  integer,
CONSTRAINT fk_votat
    FOREIGN KEY (Username)
    REFERENCES Users(Username)
);
commit;
--CREATE SEQUENCE articles_seq;

CREATE OR REPLACE TRIGGER articles_ins 
BEFORE INSERT ON articles 
FOR EACH ROW

BEGIN
  SELECT articles_seq.NEXTVAL
  INTO   :new.idArt
  FROM   dual;
END;
/
--INSERT INTO ARTICLES VALUES(2,'diana','sadasf asf asf','dasfasdasdasdasd',sysdate,'dasdasdasdasd',8);


Create Table domeniuTypesStat (
domeniu varchar2(50) primary key,
frecventa integer);

INSERT INTO domeniuTypesStat VALUES ('text',0);
INSERT INTO domeniuTypesStat VALUES ('presentation',0);
INSERT INTO domeniuTypesStat VALUES ('video',0);
INSERT INTO domeniuTypesStat VALUES ('source-code',0);


Create Table queriesStat (
termeni_cautati varchar2(50) primary key,
frecventa integer);



Create Table categoriiStat (
Categorie varchar2(50) primary key,
frecventa integer);

Insert into categoriiStat Values('SO',0);
Insert into categoriiStat Values('ENGINEERING',0);
Insert into categoriiStat Values('GAMES',0);
Insert into categoriiStat Values('TECHNOLOGIES',0);
Insert into categoriiStat Values('LIMBAJE',0);
Insert into categoriiStat Values('COMERT',0);


Create Table platformeStat (
Platforma varchar2(50) primary key,
frecventa integer);


Create Table Search_Table (
id integer not null,
Termeni_Cautati  varchar2(50) not null,
categorie  varchar2(50),
domeniu  varchar2(50),
data_cautare date,
Limba varchar2(50),
Platforma varchar2(50),  
CONSTRAINT fk_product
    FOREIGN KEY (Platforma)
    REFERENCES PlatformeStat(Platforma),
CONSTRAINT fk_domeniu
    FOREIGN KEY (domeniu)
    REFERENCES DomeniuTypesStat(domeniu),
CONSTRAINT fk_categorie
    FOREIGN KEY (categorie)
    REFERENCES CategoriiStat(Categorie),
CONSTRAINT fk_term
    FOREIGN KEY (Termeni_cautati)
    REFERENCES QueriesStat(Termeni_cautati)
--CONSTRAINT fk_id
--    FOREIGN KEY (id)
--    REFERENCES Users(Id)
);


CREATE OR REPLACE TRIGGER update_tables
before INSERT
   ON search_table
   FOR EACH ROW
   
DECLARE
   v_termeni_cautati varchar2(50);
   v_categorie varchar2(50);
   v_domeniu varchar2(50);
   v_platforma varchar2(50);
   
BEGIN
   

  begin
  Select distinct termeni_cautati into  v_termeni_cautati  from QueriesStat where termeni_cautati=:new.termeni_cautati ;
  update queriesStat set frecventa=frecventa+1 where termeni_cautati=:new.termeni_cautati;

  exception
  WHEN NO_DATA_FOUND THEN 
    insert into QueriesStat Values(:new.termeni_cautati,1);

  end;
   
 if (:new.categorie is null) then dbms_output.put_line('categoria e null'); 
  else 
    
    begin
    Select distinct categorie into  v_categorie  from CategoriiStat where categorie=:new.categorie ;
    update CategoriiStat set frecventa=frecventa+1 where categorie=:new.categorie;
    
    exception
      WHEN NO_DATA_FOUND THEN 
        insert into CategoriiStat Values(:new.categorie,1);

    end;
  end if;


 if (:new.domeniu is null) then dbms_output.put_line('domeniuul e null'); 
  else 
    
    begin
    Select distinct domeniu into  v_domeniu  from domeniuTypesStat where domeniu=:new.domeniu ;
    update domeniuTypesStat set frecventa=frecventa+1 where domeniu=:new.domeniu;
    
    exception
      WHEN NO_DATA_FOUND THEN 
        insert into domeniuTypesStat Values(:new.domeniu,1);

    end;
  end if;

if (:new.platforma is null) then dbms_output.put_line('platforma e null'); 
  else 
    
    begin
    Select distinct platforma into  v_platforma  from PlatformeStat where platforma=:new.platforma ;
    update PlatformeStat set frecventa=frecventa+1 where platforma=:new.platforma;
    
    exception
      WHEN NO_DATA_FOUND THEN 
        insert into PlatformeStat Values(:new.platforma,1);

    end;
  end if;

     
END;
/

--insert into search_table Values(30,'altceva','GAMES','text',sysdate,'','PS4');
--insert into users values(1,'asdgasdaslex','a197c5c3f500e634148s6dd4379a27890','al3xdudmiasdtriu@yahoo.com',1,1322234,'16-05-2015');
--insert into detaliiutilizator values('asdaslex','windows 8','PC','engleza','0754699571','strada smechera');










create or replace procedure afisare_fis2 IS
  f_line varchar2(2000);
  l_file utl_file.file_type;
  Comma1 varchar(10);
  search_term varchar(50);
  domeniu varchar(50);
  platforma varchar(50);
  categorie varchar(50);
  dice Integer;
    counter Integer;
    counter2 Integer;
begin
 
    select max(id) into counter2 from search_table;
     
      l_file := utl_file.fopen('TMP', 'fielding.csv', 'r');
  counter:=0;
loop
counter2:=counter2+1;
begin
utl_file.get_line(l_file,f_line);
exception
when no_data_found then
exit;
   end;   
   
   
     Comma1 := INSTR(f_line, ',' ,1 , 1);
  
 search_term := SUBSTR(f_line, 2, Comma1-3);
  
  dice:=dbms_random.value(0,3);
  CASE dice
      When 0 then
                domeniu:='text';
      When 1 then  
        domeniu:='presentation';
      When 2 then  
        domeniu:='video';
      When 3 then 
        domeniu:='source-code';
  end case;
  
  dice:=dbms_random.value(0,5);
  CASE dice
      When 0 then
                categorie:='SO';
      When 1 then  
        categorie:='ENGINEERING';
      When 2 then  
        categorie:='GAMES';
      When 3 then 
        categorie:='TECHNOLOGIES';
      When 4 then  
        categorie:='LIMBAJE';
      When 5 then 
        categorie:='COMERT';
  end case;
  
  
  dice:=dbms_random.value(0,8);
  CASE dice
      When 0 then
                platforma:='PC';
      When 1 then  
        platforma:='MAC';
      When 2 then  
        platforma:='ANDROID';
      When 3 then 
        platforma:='PS4';
      When 4 then  
        platforma:='XBOXONE';
      When 5 then 
        platforma:='WII';
      When 6 then  
        platforma:='PS3';
      When 7 then 
        platforma:='WINDOWSPHONE';
      When 8 then 
        platforma:='IPHONE';
  end case;
  
  
--dbms_output.put_line(search_term||' '||domeniu||' '||categorie||' '||platforma);
   INSERT INTO search_table VALUES (counter2,search_term,categorie,domeniu,sysdate,'english',platforma);
  
    counter:=counter+1;
  end loop;
  
    utl_file.fclose(l_file);
exception
when others then 
dbms_output.put_line('eroare la linia:'||counter);
WHILE (counter>0)
LOOP

delete from search_table where id=(select max(id) from search_table);
counter:=counter-1;
END LOOP;

end afisare_fis2;
/
BEGIN
AFISARE_FIS2;
END;
/
create or replace procedure export_fis2 IS
  f_line varchar2(2000);
  l_file utl_file.file_type;
  Comma1 varchar(10);
  search_term varchar(50);
  domeniu varchar(50);
  platforma varchar(50);
  categorie varchar(50);
  dice Integer;
    counter Integer;
    counter2 Integer;
begin
 
    
     counter:=0;
      l_file := utl_file.fopen('TMP', 'export.csv', 'w');
  
for c1 in (select * from search_table )  
  loop
  
  utl_file.put_line(l_file,c1.id||','||c1.termeni_cautati||','||c1.categorie||','||c1.domeniu||','||c1.data_cautare||','||c1.limba||','||c1.platforma);

  
   
 counter:=counter+1;
 end loop;
   
    utl_file.fclose(l_file);
    
exception
when others then dbms_output.put_line('eroare la linia'||counter);
WHILE (counter>0)
LOOP
delete from search_table where id=(select max(id) from search_table);
counter:=counter-1;
END LOOP;

end export_fis2;
/




create or replace procedure bagaArticol (
vusername  IN varchar2 ,
vtitle  IN varchar2,
vsubtext  IN varchar2,
vurl IN varchar2,
vpopularitate IN  integer
) IS
 gasit INTEGER;
 newvpopularitate integer;
begin
 gasit:=0;
   newvpopularitate:=vpopularitate ;
    
  
for c1 in (select * from  articles)  
  loop
  if (c1.title=vtitle ) then 
      if(c1.username=vusername) then gasit:=1;
        else newvpopularitate:=c1.popularitate;
      end if;
  end if;
  if(c1.url=vurl) then
    if(c1.username=vusername) then gasit:=1;
        else newvpopularitate:=c1.popularitate;
    end if;
  end if;
  
  end loop;
 if (gasit=0) then INSERT INTO ARTICLES VALUES(1,vusername,vtitle,vsubtext,sysdate,vurl,newvpopularitate)  ;
 end if;
    

end bagaArticol;
/

create or replace procedure updatepop  IS
 maxim INTEGER;

begin
 
  
for c1 in (select title from  articles)  
  loop
  Select Max(popularitate) into maxim from articles where title=c1.title;
  dbms_output.put_line(maxim);
  end loop;
 
    

end updatepop;
/

--Select Max(popularitate) from articles where title='Jack is slowly turning into Lester from GTA V';
--
----begin
----bagaarticol('diana','jmecheie','asdasdasdasdasd','http://asasdasdad',0);
----end;
----/






CREATE OR REPLACE VIEW TOP_5_QUERIES AS
SELECT *
FROM(select * from queriesstat  order by frecventa DESC) QUERIES WHERE rownum <= 5
ORDER BY rownum;


CREATE OR REPLACE VIEW TOP_5_PlATFORMS AS
SELECT *
FROM(select * from PLATFORMEstat  order by frecventa DESC) QUERIES WHERE rownum <= 5
ORDER BY rownum;





insert into search_table Values(21,'windows','SO','',sysdate,'english','PC');

insert into detaliiutilizator values('alex','dumitriu','alex',12,'windows','pc','eng','0754699571','','iasi,suceava');



update users set apelatApi=0 where username='dan';
UPDATE USERS SET APELATAPI=1 WHERE USERNAME='alex';
UPDATE ARTICLES SET POPULARITATE=9 WHERE username='alex';

SELECT * FROM EVIDENTAVOTURI;

select * from search_table;
select * from articles;
select * from users;
COMMIT;