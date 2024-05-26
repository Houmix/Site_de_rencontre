PET MATCH - Site de Rencontre pour Amoureux des Animaux

Bienvenue sur PET MATCH, la plateforme de rencontre dédiée aux passionnés des animaux de compagnie. Notre site permet aux utilisateurs de trouver des partenaires tout en connectant leurs animaux avec d'autres compagnons adorés.

Table des Matières

-Introduction
-Fonctionnalités
-Installation
-Configuration
-Utilisation
-Contributions
-Licence


-Introduction

PET MATCH est conçu pour les personnes qui veulent rencontrer d'autres amoureux des animaux. Que vous soyez propriétaire d'un chien, d'un chat, ou de tout autre animal de compagnie, PET MATCH vous aide à trouver des partenaires partageant les mêmes affinités et à organiser des rencontres amusantes pour vos animaux.

Fonctionnalités

Profil Utilisateur : Créez un profil détaillé pour vous et vos animaux.
Recherche et Filtrage automatique : Trouvez des utilisateurs et des animaux compatibles selon différents critères.
Messagerie : Communiquez avec vos matchs directement sur la plateforme.
Galerie de Photos : Téléchargez votre photo de profile.
Système de Matchmaking : Obtenez des suggestions de profils basées sur vos intérêts et ceux de vos animaux.
Activités et Rencontres : Planifiez et participez à des événements pour rencontrer d'autres propriétaires d'animaux.
Installation

Prérequis
PHP 7.4 ou supérieur
SQLite ou une autre base de données compatible
Serveur Web (Apache, Nginx, etc.)

Étapes d'Installation
Clonez le dépôt :

Copier le code
git clone https://github.com/votre-utilisateur/pet-match.git

Accédez au répertoire du projet :

cd pet-match/templates
Installez les dépendances nécessaires :

Configurez votre serveur web pour pointer vers le répertoire du projet.

Configuration

Base de Données :

Créez une base de données SQLite (ou une autre base de données) et importez le schéma fourni :
sqlite3 DB/my_database.db < schema.sql


Utilisation

Inscription et Connexion :

Les utilisateurs peuvent s'inscrire et créer un profil en fournissant des informations personnelles et des détails sur leurs animaux de compagnie.
Une fois inscrits, ils peuvent se connecter pour accéder à toutes les fonctionnalités du site.

Naviguer et Trouver des Matchs :

Utilisez les outils de recherche et de filtrage automatique pour trouver des utilisateurs compatibles.
Consultez les profils et liker pour commencer à envoyer des messages pour commencer à interagir.
Nous accueillons toutes les contributions ! Pour signaler des bogues, suggérer des fonctionnalités ou soumettre du code, veuillez ouvrir une issue ou un pull request sur GitHub.

Ce qui ne fonctionne pas : 

-Page d'erreur/redirection si l'utilisateur entre une page non existante (par contre s'il entre une page qui lui est interdite alors il est bien redirigé)
-Placer le lien vers la feuilles css dans le header. Pour les pages avec un css particulier, il faut ajouter le lien vers la feuilles de styles dans le code de la page or comme on utilise include pour avoir le footer et le header on en peut pas placer dans la balise header.


Compte admin : 
mail : admin@admin.com
mdp : admin



Merci d'utiliser PET MATCH ! Nous espérons que vous et vos animaux trouverez des amis et des partenaires grâce à notre plateforme. Si vous avez des questions ou des commentaires, n'hésitez pas à nous contacter.
