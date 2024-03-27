-- Début de la transaction
BEGIN TRANSACTION;

-- Insertion d'un nouvel utilisateur
INSERT INTO user (email, roles, password, firstname, lastname)
VALUES ('test@example.com', '["ROLE_USER"]', '$2y$13$Q1I5nq4GJWtSBeetT9qGzOQQGngBCWQSSJWu3ymndw.3IK7Ny6P/i', 'John', 'Doe');

-- Récupération de l'ID de l'utilisateur nouvellement créé
SET @user_id = LAST_INSERT_ID();

-- Insertion d'un nouveau patient associé à l'utilisateur
INSERT INTO patient (adlibelle, adcp, adcity, adcountry, user_id)
VALUES ('123 Rue du four', '34000', 'Montpellier', 'Fr', @user_id);

-- Récupération de l'ID du patient nouvellement créé
SET @patient_id = LAST_INSERT_ID();

-- Insertion d'un nouveau séjour pour le patient
INSERT INTO stay (reason, description, start_date, end_date, etat, validate, speciality_id, patient_id, medecin_id)
VALUES ('Consultation', 'Consultation de routine', '2024-03-29', '2024-03-30', 'Encours', TRUE, 1, @patient_id, 1);


-- Fin de la transaction
COMMIT;
