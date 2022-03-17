### Sans Index

- **Temps de la requête pour les jeux commençant par Mario** :  0.10073280334473
- **Temps de la requête pour les jeux commençant par Sonic** : 0.10054087638855
- **Temps de la requête pour les jeux commençant par World** : 0.095066070556641



### Avec Index

- **Temps de la requête pour les jeux commençant par Mario** :  0.038083076477051
- **Temps de la requête pour les jeux commençant par Sonic** : 0.013938903808594
- **Temps de la requête pour les jeux commençant par World** :  0.020671844482422

On peut donc voir que les requêtes avec index sont bien plus optimisées que celles sans.
De plus, on peut voir qu'il y a un peu plus de différence entre chaque requête. Celles qui contiennent moins de ligne
sont plus rapides.


- **Temps de la requête pour les jeux contenant Mario** :  0.15466904640198
- **Temps de la requête pour les jeux contenant Sonic** : 0.090996026992798
- **Temps de la requête pour les jeux contenant World** :  0.10601687431335

On peut constater que lorsque l'on recherche le nom des jeux qui contiennent une valeur, la durée de la
requête redevient bien plus longue.
Cela peut s'expliquer que l'index ne sert pas car on ne recherche pas la valeur que dans le début du mot.
On doit donc parcourir toute la table.
