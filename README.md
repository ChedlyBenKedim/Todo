Todo Application
Description
Cette application Todo vous permet de gérer vos tâches avec des fonctionnalités telles que la création, la mise à jour, la suppression et la visualisation des tâches. Elle inclut également un système de statistiques pour suivre vos progrès.

Prérequis
.PHP 7.4 ou version supérieure
.Composer - Gestionnaire de dépendances PHP
.WAMP Server ou XAMPP (si vous utilisez une alternative)
.MySQL 5.7 ou version supérieure


Installation
1. Cloner le Dépôt
Clonez le dépôt GitHub dans votre répertoire de travail local :
(bash)
git clone https://github.com/ChedlyBenKedim/Todo.git
cd Todo/todo-app

2. Installer les Dépendances
Assurez-vous que Composer est installé, puis installez les dépendances du projet :
(bash)
composer install

3. Configurer les Variables d'Environnement
Ouvrez le fichier .env et configurez les paramètres de connexion à la base de données :
(fichier.env)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=

4. Générer la Clé d'Application
Générez la clé d'application Laravel :
(bach)
php artisan key:generate

5. Migrer la Base de Données
creer manuellement une base de donneés vide avec le nom todo_app (en utilisatant phpmyadmin)  

Exécutez les migrations pour créer les tables nécessaires dans la base de données :
(bash)
php artisan migrate

6. Démarrer le Serveur de Développement
(bash)

php artisan serve

7. Accédez à l'application à l'adresse http://127.0.0.1:8000/login

8. Inscrivez-vous d'abord, s'il vous plaît.


Note===> J'ai utilisé Mailtrap pour les notifications par e-mail concernant les tâches. Vous devrez donc modifier les paramètres SMTP dans le fichier '.env' avec votre 'MAIL_USERNAME', 'MAIL_PASSWORD' et 'MAIL_FROM_ADDRESS'.

(fichier courante contient)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=a3202af26bbdbb
MAIL_PASSWORD=2248dceb61945d
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=chedlyinfo@gmail.com
MAIL_FROM_NAME="${todo-app}"



Note==> Concernant Docker, j'ai bien fourni les fichiers nécessaires. (Si vous souhaitez tester avec Docker  )

Contact
Pour toute question ou suggestion, vous pouvez me contacter à chedlyinfo@gmail.com