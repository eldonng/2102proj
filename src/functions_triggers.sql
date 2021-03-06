--Add Project Stored Procedure
CREATE OR REPLACE FUNCTION add_project(uemailadd VARCHAR(64),  projectidadd CHAR(8), titleadd VARCHAR(64),  startdateadd DATE, enddateadd DATE,
categoryadd VARCHAR(64), targetamountadd INTEGER, descriptionadd VARCHAR(256))
    RETURNS VARCHAR AS $BODY$
    BEGIN
    IF EXISTS (SELECT * from project_advertised WHERE uemailadd = uemail AND title = titleadd) THEN
    RETURN 'Project with same title has already been created!';
    END IF;
    INSERT INTO project_advertised (uemail, projectid, title, startdate, enddate, category, targetamount, description)
    VALUES (uemailadd, projectidadd, titleadd, startdateadd, enddateadd, categoryadd, targetamountadd, descriptionadd);
    RETURN 'Project successfully added!';
    END;
    $BODY$ LANGUAGE plpgsql;

--Check Negative Values for Funds
CREATE OR REPLACE FUNCTION checkInvalidFunds()
RETURNS TRIGGER AS $$
BEGIN
RAISE EXCEPTION 'Unable to add funds!';
RETURN NULL;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER checkInvalidFunds
BEFORE INSERT
ON fund
FOR EACH ROW
when (NEW.amountfunded <= 0)
EXECUTE PROCEDURE checkInvalidFunds();


--Check Negative Values for project_advertised table
CREATE OR REPLACE FUNCTION checkInvalidFundsUpdate()
RETURNS TRIGGER AS $$
BEGIN
RAISE EXCEPTION 'Unable to add funds!';
RETURN NULL;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER checkInvalidFundsUpdate
BEFORE UPDATE
OF amountfund
ON project_advertised
FOR EACH ROW
when (NEW.amountfund <= OLD.amountfund)
EXECUTE PROCEDURE checkInvalidFundsUpdate();


--Check if fund target has been reached
CREATE OR REPLACE FUNCTION updatestatus()
RETURNS TRIGGER AS $$
BEGIN
NEW.status = 'funded';
RETURN NEW;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER updatestatus
BEFORE UPDATE
OF amountfund
ON project_advertised
FOR EACH ROW
when (NEW.amountfund >= OLD.targetamount)
EXECUTE PROCEDURE updatestatus();

--Check if user has previously funded the same project
CREATE OR REPLACE FUNCTION updatefund()
RETURNS TRIGGER AS $$
BEGIN
IF EXISTS(SELECT * FROM fund WHERE pprojectid = NEW.pprojectid AND uemail = NEW.uemail)
THEN UPDATE fund SET amountfunded = amountfunded + NEW.amountfunded;
RETURN NULL;
ELSE
RETURN NEW;
END IF;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER updatefund
BEFORE INSERT
ON fund
FOR EACH ROW
EXECUTE PROCEDURE updatefund();
