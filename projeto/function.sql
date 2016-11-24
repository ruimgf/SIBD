DELIMITER $$
CREATE FUNCTION overlap_rect( x1a FLOAT(4), y1a FLOAT(4) , x2a FLOAT(4) , y2a FLOAT(4) , x1b FLOAT(4) , x2b FLOAT(4) , y1b FLOAT(4) ,  y2b FLOAT(4) )
RETURNS BOOLEAN
BEGIN
IF ( (x2a < x1b) OR (x2b < x1a) ) THEN RETURN FALSE;
END IF;
IF( (y1a > y2b) OR (y1b > y2a) ) THEN RETURN FALSE;
END IF;
RETURN TRUE;
END $$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION overlap_serie(serie_id_a VARCHAR(255),serie_id_b VARCHAR(255))
RETURNS BOOLEAN
BEGIN
RETURN EXISTS (SELECT series_id FROM region AS r1, region AS r2
WHERE (r1.series_id = serie_id_a)
AND (r2.series_id = serie_id_b)
AND overlap_rect(r1.x1,r1.y1,r1.x2,r1.y2,r2.x1,r2.y1,r2.x2,r2.y2));
END $$
DELIMITER ;
