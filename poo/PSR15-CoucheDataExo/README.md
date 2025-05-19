# Framework PSR-15 avec Couche Data

## Installation

1. Cloner le projet
2. Se placer dans le répertoire du projet
3. Installer les dépendances PHP via Composer :
```bash
composer install
```
Cette commande va créer le répertoire `vendor` avec toutes les dépendances nécessaires.

4. Créer le fichier `.env` en copiant `.env.example` :
```bash
cp .env.example .env
```

5. Configurer les paramètres de base de données dans `.env` :
```env
DB_HOST=localhost
DB_NAME=votre_base_de_donnees
DB_USER=root
DB_PASSWORD=
```

6. Créer la base de données et exécuter le SQL suivant :
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (login, password, email) VALUES ('admin', 'admin', 'admin@example.com');
```

7. Lancer le serveur PHP intégré :
```bash
php -S localhost:3000
```

## Fonctionnalités implémentées

### CRUD Utilisateurs
- **Voir les utilisateurs** : `/users`
- **Ajouter un utilisateur** : `/users/add`
- **Modifier un utilisateur** : `/users/{id}`
- **Supprimer un utilisateur** : `/users/delete/{id}`

### Corrections apportées

1. **Routes avec slash final** : Le router normalise maintenant les routes en supprimant le slash final. `/users` et `/users/` fonctionnent de la même manière.

2. **Problème des backslashes** : Désactivation de `escape_sql` dans `InputSanitizerMiddleware`. Les apostrophes ne sont plus échappées avec des backslashes, car nous utilisons des requêtes préparées PDO qui gèrent la sécurité SQL. Ce n'est pas une bonne pratique moderne, car c'est une protection contre les injections SQL datant d'avant les requêtes préparées. De plus, les données sont modifiées à l'affichage : les apostrophes apparaissent comme \' dans l'interface. Enfin, il y a une mauvaise séparation des responsabilités car la protection SQL devrait se faire au niveau de la base de données.

## Explications techniques

### Méthode __set dans Model/User

La méthode magique `__set` dans `Model/User` est une méthode spéciale qui se déclenche automatiquement quand on essaie de définir une propriété qui n'existe pas dans la classe. 
Cette méthode résout un problème de différence de nommage entre :

La base de données : utilise created_at (avec underscore)
PHP/classe : utilise createdAt (camelCase)

#### Comment ça fonctionne ?

Quand PDO récupère les données de la base de données
Il trouve une colonne created_at
Il essaie de faire : $user->created_at = "2024-01-01"
Mais la propriété created_at n'existe pas dans la classe !
PHP appelle alors automatiquement __set('created_at', '2024-01-01')
La méthode convertit et assigne : $this->createdAt = "2024-01-01"

#### En résumé
C'est un traducteur automatique qui convertit les noms de colonnes de la base de données (snake_case) vers les noms de propriétés PHP (camelCase). Sans cette méthode, PDO ne pourrait pas remplir correctement la propriété createdAt de votre objet User.


## Architecture

Le projet suit une architecture MVC avec :
- **Controllers** : Gèrent les requêtes HTTP
- **Models** : Représentent les entités (User)
- **Repository Pattern** : Abstraction de l'accès aux données
- **Middlewares** : Authentification et sanitisation des entrées
- **Router PSR-7** : Gestion des routes et dispatch

## Routes disponibles

- `/` : Page d'accueil
- `/login` : Connexion
- `/users` : Liste des utilisateurs
- `/users/add` : Ajouter un utilisateur
- `/users/{id}` : Modifier un utilisateur
- `/users/delete/{id}` : Supprimer un utilisateur
- `/admin` : Page d'administration (protégée)
