# PROJET GPS

![Petit meme](https://i.imgflip.com/1n8nsf.jpg)

## 1° LES ACCÈS

Le projet peut être accessible via 2 IP :  
    - __192.168.65.186__, l'adresse sur laquelle vous pouvez accéder au site.  
    - __192.168.64.157__, l'adresse sur laquelle vous pouvez accéder à la BDD.

Un partage Samba existe et est joignable au lecteur suivant : \\192.168.65.186\PartageApache


-----------------


## 2° LA BASE DE DONNÉES

Actuellement, la BDD contient 1 base. Vous pouvez y accéder grâce au couple d'identifiants root/root.

Base_PROJET     	
      
      └── User  
        ├── id : int (clé primaire)  
        ├── login : varchar unique (200)  
        └── passwd : varchar (200)  
        └── isAdmin : int (1)  

Pour fonctionner, un utilisateur doit être ajouté à la base avec le nom "dudule", le password "root", le nom
d'hôte à "%" et lui accorder tous les privilèges.

Un export de cette base existe dans le fichier __./bdd/Base_PROJET.sql__, que vous pouvez importer directement dans PhpMyAdmin.  
Tout est déjà configuré, est un Admin existe sous le nom de 'root' avec pour mot de passe 'iamtheboss'.

-----------------


## 3° ORGANISATION DU CODE


* __./assets__  
*(Ce fichier est consacré au css, js, etc... utilisé par le Bootstrap. Il contient cette liste non exhaustive :)*    
    /css    
    /img    
    /js  
    /scss    
    /vendor    
    .travis.yml  
    gulpfile.js  
    package-lock.json    
    package.json  


* __./bdd__  
    *bdd.php* -> code permettant une connexion à la BDD, utilisée dans les différentes pages    
    *Base_PROJET.sql* -> un export clean de la base afin que vous puissiez l'importer dans PhpMyAdmin  


* __./class__  
    *user.php* -> code pour la déclaration de la Class "User", contenant les fonctions principales pour gérer celui-ci  


* __./documentation__  
    /img  
        - *Class_User.png* -> image du diagramme de classe de la classse User    
        - *Diagramme_exigences.png* -> image du diagramme des exigences du projet    
        - *MCD_User.png* -> image du MCD de la classe User  
        - *pageadministrateur.png* -> image de la page d'admin    
        - *pageconnexion.png* -> image de la page de connexion    
        - *pageinscription.png* -> image de la page d'inscription    
        - *Use_Case.png* -> image du use case du projet  
    *cahier_des_charges.docx* -> document qui contient le cahier des charges    
    *cahier_test.docx* -> document contenant le cahier de tests réalisés pour le projet  
    *GANTT.xlsx* -> document GANTT du projet  
    *presentation.pttx* -> présentation du pojet sous PowerPoint  
    *TP1_MiseEnRoute.pdf* -> Rappel du projet avec le fichier pdf  
 

* __./extend_pages__  
*(Ce fichier est consacré aux pages founies avec le Bootstrap et qui pourrait peut-être vous être utiles, si besoin :)*  
    *blank.php*   
    *buttons.php*    
    *cards.php*     
    *charts.php*      
    *utilities-animation.php*     
    *utilities-border.php*    
    *utilities-color.php*    
    *utilities-other.php*  


* __./main_pages__  
    *404.php* -> page utilisée quand on accède à une page non autorisée ou non trouvée     
    *acceuil.php* -> page quand l'utilisateur se connecte et permet d'accéder aux autres pages    
    *admin.php* -> page de gestion si l'user est Admin qui lui permet d'afficher et de modifier tous les utilisateurs    
    *inscription.php* -> page d'inscription pour les nouveaux utilisateurs    
    *parametres.php* -> page sur laquelle l'user connecté peut modifier ses informations de connexion  


*index.php* -> page servant pour la connexion de l'utilisateur  
*readme.md* -> ce même fichier que vous êtes en train de lire pour vous aider à comprendre le code  

-----------------


Pour toutes questions sur le projet (en ce qui concerne la première partie), n'hésitez pas à venir demander à Lucas, Théo, Jean ou Éloïse pour plus d'informations.  

Enjoy ! 


















    
