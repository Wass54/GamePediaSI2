
# **Partie 1**

- **Question 1**
```php
<?php 

$avant = microtime(true);

//séquence d'instructions PHP

$$après = microtime(true);

var_dump($après-$avant); // temps de l'exécution
```

- **Question 2 :**

Un index est une structure qui reprend la liste ordonnée des valeurs auxquelles il se rapporte.
Les index sont utilisés pour accélérer les requêtes (notamment les requêtes impliquant plusieurs tables, ou les requêtes de recherche), et sont indispensables à la création de clés, étrangères et primaires, qui permettent de garantir l'intégrité des données de la base.
Lorsque vous créez un index sur une table, le logiciel gérant la bdd stocke cet index sous forme d'une structure particulière, contenant les valeurs des colonnes impliquées dans l'index. Cette structure stocke les valeurs triées et permet d'accéder à chacune de manière efficace et rapide.
Il peut y avoir plusieurs index sur une même table, et que l'ordre des lignes, pour chacun de ces index, n'est pas nécessairement le même.
Les index sont représentés par le mot-clé INDEX ou KEY  et peuvent être créés de deux manières :
    soit directement lors de la création de la table (create table) ;
    soit en les ajoutant par la suite (alter table).


# **Partie 2**

- **Question 3**

On débute la requete avec le modele (son nom). On ajoute une ou plusieurs methodes specifiant la ou les clauses (operations SQL...).
Pour finir une methode terminale (comme par exemple: ->get())



- **Question 4**

Des problèmes de performance liés à des relations de type parent/enfant. 
L'anti-pattern que l'on retrouve le plus fréquemment consiste à exécuter une requête pour obtenir la relation parente puis à récupérer les enfants un à un.

La solution pour éviter cela est bien évidemment d'utiliser des jointures SQL afin de récupérer les informations des auteurs avec les livres qu'ils ont écrit dans la même requête.