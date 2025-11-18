-- Trigger pour ajouter une place à nb_place_reste quand on ajoute une reservation à un ministage (revoit un message d'erreur quand il n'y a plus de places dans le ministage)
DROP TRIGGER IF EXISTS trg_ajouter_place ON t_reservation

CREATE OR REPLACE FUNCTION fn_trg_ajouter_place()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM t_ministage WHERE nb_place_reste > 0 AND id = NEW.t_ministage_id) THEN
        RAISE EXCEPTION 'Il n''y a plus de place pour ce ministage!';
END IF;
UPDATE t_ministage
SET nb_place_reste = nb_place_reste - 1
WHERE id = NEW.t_ministage_id;

RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_ajouter_place
    BEFORE INSERT ON t_reservation
    FOR EACH ROW
    EXECUTE FUNCTION fn_trg_ajouter_place();

-- Fonctionne
INSERT INTO tucana.t_reservation (id, t_ministage_id, t_eleve_id, t_utilisateur_id, confirmation, rappel, absence)
VALUES(39, 224, 206, 88, true, '2025-11-18 15:17:34.0', false);

-- Trigger pour supprimer une place à nb_place_reste quand on supprime une reservation à un ministage (revoit un message d'erreur quand il n'y a pas d'inscrit à un ministage)
DROP TRIGGER IF EXISTS trg_retirer_place ON t_reservation;

CREATE OR REPLACE FUNCTION fn_trg_retirer_place()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM t_ministage
        WHERE nb_place_reste < nb_place
          AND id = OLD.t_ministage_id
    ) THEN
        RAISE EXCEPTION 'Il n''y a pas d''inscrit à ce ministage.';
END IF;

UPDATE t_ministage
SET nb_place_reste = nb_place_reste + 1
WHERE id = OLD.t_ministage_id;

RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_retirer_place
    BEFORE DELETE ON t_reservation
    FOR EACH ROW
    EXECUTE FUNCTION fn_trg_retirer_place();

-- Fonctionne
DELETE FROM tucana.t_reservation
WHERE id=33;
