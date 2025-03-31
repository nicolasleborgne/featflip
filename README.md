https://stackoverflow.com/questions/66907635/how-do-i-prevent-php-cs-fixer-from-fixing-specific-function-names

[![CI](https://github.com/nicolasleborgne/featflip/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/nicolasleborgne/featflip/actions/workflows/ci.yml)

# Feat flip

Feat flip provide a rich experience around feature flagging, il enables you to :
- Manage feature flags from the web
- ...

# Getting Started



Ajout requête pour récupérer les organizations 
test qui liste les organizations d'un user sur la page d'acceuil
test qui affiche l'info sur le manque d'organization sur la page d'acceuil 












For contributing information, see @CONTRIBUTING.md

DESIGN

nav bar sans bordure, avec juste le nom de l'app et l'icone pour le moment
bouton + pour ajouter un projet dans la card orga
card très épuré par organisation
    Avec la liste des projets, avec un picto avec la première lettre du projet
    Liste seulement 5 projet, puis un "view more" ?


TODO

List les flags 
/organizations/slug/projects/slug/env

GET /organizations/slug/projects/slug/flag_id/toggle pour allumer eteindre un flag

remove env, project, feature, organization
update env, project, feature, organization

ACL

ajouter des membres à une organization
supprimer des membres à une organization
modifier le role d'une personne au sein d'une organization

API REST flags ?? Open flags ?



  pouvoir marquer un environnement comme protégé
  organization acl
    owner
    member
    reporter

  project acl
    owner
    member
    reporter
    guest

  acl projet hérite des acl orga. acl projet surcharge les acl orga
  
  ajout service PermissionChecker
    can
    guard

    check via mock qu'il est bien appelé dans les différentes fonction.
    check via unit test qu'il rend bien les bonnes permissions


| action                   | owner | member | reporter |
|--------------------------|-------|--------|----------|
| list organizations       |   –   |   –    |     –    |
| edit organization        |   ✓   |   ⨯    |     ⨯    |
| list projects            |   ✓   |   ✓    |     ✓    |
| list features            |   ✓   |   ✓    |     ✓    |
| add environment          |   ✓   |   ⨯    |     ⨯    |
| add feature              |   ✓   |   ✓    |     ⨯    |
| edit feature             |   ✓   |   ✓    |     ⨯    |
| add user to organization |   ✓   |   ⨯    |     ⨯    |


un flag c'est une feature + une valeur + contrainte ? + environnement ?

  list flags par projet
  list feature toujours utile ou pas ?
  lister les projets par organization

  gestion des utilisateurs
    récuperation des données personnelles
    suppression du compte
    informations légales
    
  gestion d'une organization
    un utilisateur créé une organization devient owner
    il peut ajouter des skackholders
  gérer l'état d'un flag par event sourcing
  lister les organizations par utilisateurs (nécéssite la gestion des utilisateurs du coup)
  ajouter un loggable bundle doctrine extension ?





- gérer les environnements par projets
- exposer les features d'un projet
- gérer des access token
  - indépendant du reste, possède un scope permettant d'en définir la portée en terme de métier et ces authorization
- gérer les utilisateurs
- RGPD: si pas de connexion depuis x temps
- ajouter une organization avec le même nom ? Génère un slug avec un numérique ?
- ajouter un projet avec le même nom interdit
- ajouter une feature avec le même nom interdit
- ajouter la valeur du flag dans les features
- lister les projets
- intégration graphique


danger zone 
  - supprimer un projet
  - supprimer une organization
  - supprimer un flag
  - supprimer un environment

- approche didactique sur la création d'une organization/projet ou on enchaine tout, création d'env etc ...

- gérer des utilisateurs
- gérer des access token par projet
- gérer les différentes features par api platform
- exposer les features d'un projet
- token = 
  - scopes : feature project organization endpoint
  - read/write
  - durée d'expiration
  - tache qui marque un token comme expiré. On garde l'historique
- gérer les utilisateurs

- ajout de la possibilité de "subscribe" à une feature/projet pour être notifier des actions
- ajout de role utilisateur
  - owner
  - developer
  - un object avec la matrice de toutes les actions est initialisé dans l'objet materialisant un rôle utilisateur. Si on ajoute une feature, une valeur par défaut est donné d'office (false ?)
- activation feature programmé
- feature arret urgence
- campagne de com sur une feature
- ab testing
- Statistique d'usage de feature dashboard
  - nb feature activé
  - nb feature en incident
  - nb feature cree
  - par mois semaine ...

- ajouter les created_at, updated_at
