# Hackathon

---

Application web symfony pour gerer des hackathons et s'inscrire à des hackathons.

---

## Contexte :
Vous travaillez sur l’écosystème Hackat’Innov : une suite d’apps pour organiser des hackathons (inscriptions, équipes, planning, etc.). Pour ce TP, on ne gère que l’entité Participant (profil réutilisable d’un inscrit). Pas de jury, pas de notes, pas d’équipes : focus CRUD propre et testable.

## API
L'objectif est de concevoir une API à l'aide de symfony.

### Trouver les fichiers lié à l'API 
 - /src/Controller/
   - On retrouve dans ce repertoire les différents controlleur
 - /src/Entity/
   - On retrouve ici les différentes entitées

### Routes fonctionnels
 - http://127.0.0.1:8000/api/participants/ => Lister (GET), ajouter(POST), tout les participants
 - http://127.0.0.1:8000/api/participants/{id} => Modifier, supprimer un participant

## Applications utilisé
 - Phpstorm (IDE)
 - Insomnia (Test des URL)
 - Dbeaver (Visualiser la base de données)

