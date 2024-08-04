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


2. Installer les Dépendances
Assurez-vous que Composer est installé, puis installez les dépendances du projet :
(bash)
composer install

3. Configurer les Variables d'Environnement
Copiez le fichier .env.example en .env :
(bash)
copy .env.example .env

4.  Note===> J'ai utilisé Mailtrap pour les notifications par e-mail concernant les tâches. Vous devrez donc modifier les paramètres SMTP dans le fichier '.env' avec votre 'MAIL_USERNAME', 'MAIL_PASSWORD' et 'MAIL_FROM_ADDRESS' (vous devez faire une inscription ,si vous n'avez pas de compte mailtrap).

(mon exemple)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=a3202af26bbdbb
MAIL_PASSWORD=2248dceb61945d
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=chedlyinfo@gmail.com
MAIL_FROM_NAME="${todo-app}"

5. Générer la Clé d'Application
Générez la clé d'application Laravel :
(bach)
php artisan key:generate


6. Migrer la Base de Données
creer manuellement une base de donneés vide avec le nom todo_app (si vous n'avez pas modifier DB_DATABASE=todo_app )en utilisatant phpmyadmin 

Exécutez les migrations pour créer les tables nécessaires dans la base de données :
(bash)
php artisan migrate

7. Démarrer le Serveur de Développement
(bash)

php artisan serve

8. Accédez à l'application à l'adresse http://127.0.0.1:8000/login

9. Inscrivez-vous d'abord, s'il vous plaît.


Note==> Concernant Docker, j'ai bien fourni les fichiers nécessaires. (Si vous souhaitez tester avec Docker  )

Contact
Pour toute question ou suggestion, vous pouvez me contacter à chedlyinfo@gmail.com