# php-base
## Premier pas dans la remise à niveau PHP

Ce repo peut être cloné avec la commande :
```
git clone https://github.com/CandussoR/php-base
```

On utilisera ensuite le serveur local intégré à PHP dans le dossier du projet pour le visualiser :
```
php -S localhost:8000
```

- Remise à niveau php : petit site minimal où manipuler `require` pour minimiser la répétition de code.

- Utilisation de php pour attribuer un titre différent à chaque page sans refaire le header.

- Création d'un Front Controller avec la variable `$-GET["param"]` :
  - besoin de reformuler les liens vers les différentes pages :
    ```
    href=index.php?param=qqch
    ```
  - on vérifie ensuite la valeur du paramètre, avec pour condition ou cas la valeur associée au param, 
en utilisant un switch ou un if-elseif.
