# Ecf_Quai_Antique

Guide pour déployer l'application en local

## Pré-requis
- PHP 8.2 ou ultérieur
- MariaDb 10.6 ou ultérieur
- Composer

## Déploiement
<pre><code>
  $ git clone https://github.com/PEZZOLIolivier/Ecf_Quai_Antique.git
  $ cd Application (*chemin d'installation de votre application en local*)
  $ composer install
  $ php bin/console doctrine:database:create
  $ php bin/console doctrine:schema:update --force
</code></pre>

## Création admin en local
  Ajout de l'utilisateur admin@test.com en base de donnée avec le [ROLE_ADMIN]
  le mot de passe défini sera indiqué dans OLIVIER_PEZZOLI_Copie_à_rendre.pdf télécharger sur la plateforme de studi.
<pre><code>
  Dans le terminal taper:
  $ Mysql
  $ USE db_quai_antique;
  $ INSERT INTO db_quai_antique.`user`
(id, email, roles, password, default_nb_places, default_allergy, first_name, last_name, phone_number, birthday)
VALUES(1, 'admin@test.com', '["ROLE_ADMIN"]', '$2y$13$J9uLtiMYYcQlwI1cgb8yqeqzv2cHSIgNyKVIjq37SCeYhHa1QeRKS', 1, NULL, 'Olivier', 'PEZZOLI', '00 00 00 00 00', NULL); 
</code></pre>
  
  L'utilisateur admin@test.com est maintenant implémenté pour l'application


