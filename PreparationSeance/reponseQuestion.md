- **Question 1**
json_encode() retournera un tableau uniquement si le tableau rentré en paramètre
contient des index numériques et séquentiels (0, 1, 2, 3, 4, ...) et pas (0, 2, 3, 8, ...)
Pour tous les autres cas, la fonction retournera un objet.

- **Question 2**
Récupérer les données dans l'url : 
```php
getQueryParams() : renvoie un tableau ou
getQueryParam($key, $default = null) pour un seul query param.
```

Pour les données dans le body :
```php
getParsedBody()
```

- **Question 3**
```php
$app->response->setStatus(codeNumber) </br>
$app->response->headers->set(headerName, value);
```
