DELIMITER $$
CREATE TRIGGER check_study_insert before INSERT ON study FOR EACH ROW
BEGIN
-- Check validity of parameter doctor
IF NEW.doctor_id in (SELECT doctor_id FROM request WHERE request.request_number=NEW.request_number) THEN
    call operacao_nao_permitida();
    END IF;
-- Check validity of parameter date
IF (SELECT (DATEDIFF(NEW.study_date ,request.request_date) ) < 1  FROM request WHERE request.request_number=NEW.request_number) then
    call operacao_nao_permitida();
END IF;
END $$

DELIMITER ;
