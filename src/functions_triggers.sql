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
CREATE OR REPLACE FUNCTION checkNegativeFunds()
RETURNS TRIGGER AS $$
BEGIN
RAISE EXCEPTION 'Unable to add funds!';
RETURN NULL;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER checkNegativeFunds
BEFORE INSERT
ON fund
FOR EACH ROW
when (NEW.amountfunded < 0)
EXECUTE PROCEDURE checkNegativeFunds();


--Check Negative Values for project_advertised table
CREATE OR REPLACE FUNCTION checkNegativeFundsUpdate()
RETURNS TRIGGER AS $$
BEGIN
RAISE EXCEPTION 'Unable to add funds!';
RETURN NULL;
END; $$
LANGUAGE PLPGSQL;

CREATE TRIGGER checkNegativeFundsUpdate
BEFORE UPDATE
ON project_advertised
FOR EACH ROW
when (NEW.amountfund < OLD.amountfund)
EXECUTE PROCEDURE checkNegativeFunds();