https://stackoverflow.com/questions/66907635/how-do-i-prevent-php-cs-fixer-from-fixing-specific-function-names

[![CI](https://github.com/nicolasleborgne/featflip/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/nicolasleborgne/featflip/actions/workflows/ci.yml)

# Feat flip

Feat flip provide a rich experience around feature flagging, il enables you to :
- Manage feature flags from the web
- ...

# Getting Started

For contributing information, see @CONTRIBUTING.md

TODO

project
  list flags par projet
  list feature toujours utile ou pas ?
  lister les projets par organization
  migration sf 5.4

  gestion des utilisateurs
    sign in
    sign out
    register
      nom d'utilisateur
      email
    reset mot de passe
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
- RGPD: si pas de connexion depuis
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
