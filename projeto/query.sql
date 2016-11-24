SELECT name
FROM doctor NATURAL JOIN study
WHERE study.description LIKE '%X-ray%' AND study.manufacturer = 'Philips'
AND DATEDIFF(current_date ,study_date)  <= 7 GROUP BY doctor_id
HAVING count(request_number) >= ALL (
SELECT count(request_number)
FROM study
WHERE study.description LIKE '%X-ray%' AND study.manufacturer = 'Philips'
AND DATEDIFF(current_date ,study_date) <= 7 GROUP BY doctor_id);
