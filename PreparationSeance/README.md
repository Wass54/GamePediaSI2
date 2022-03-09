##Noms et Prénoms:
- El Bakhtaoui Wassim
- Karakaya Enes
- Mallert Maxence
- Deveaux Paul



##Préparation Séance 2


 - Question 1
```SQL
Rcateg_Annon( #categ_id, #annonce_id)
RCategorie( id, nom, descr)
Rannonce(id, titre, date, texte)
Rphoto( id, fille, date, taille_octet, #annonce_id)

```

 - Question 2

Classe Annonce
```php
class Annonce extends \Illuminate\Database\Eloquent\Model
{
    protected $table='annonce';
    protected $primaryKey='id';

    public function categorie(){
        return $this->belongsToMany('Categorie',
                        'categ_Annon',
                            'annonce_id',
                            'categ_id');
    }

    public function photos() {
        return $this->hasMany('Photo','annonce_id');
    }
}
```

Classe Categorie
```php
class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table='categorie';
    protected $primaryKey='id';

    public function annonces(){
        return $this->belongsToMany('Annonce',
                        'categ_Annon',
                            'categ_id',
                            'annonce_id');
    }
}
```

Classe Photo
```php
class Photo extends \Illuminate\Database\Eloquent\Model
{
    protected $table='photo';
    protected $primaryKey='id';

    public function annonce(){
        return $this->belongsTo('annonce','annonce_id');
    }
}
```




 - Question 3.1

```php
        $a= Annonce::find(22);
        $p= $a->photo()->get();

        foreach ($p as $val){
            echo($val->id . " " . $val->file . " " . $val->date . "<br>");
        }
```

- Question 3.2
```php
        $a= Annonce::find(22);
        $p= $a->photos()->where('taille_octet',">","100000")->get();

        foreach ($p as $val){
            echo($val->id . " " . $val->file . " " . $val->date . "<br>");
        }
```


- Question 3.3
- 
```php
        foreach(Annonce::all() as $value){
            if($value->photos()->count()>3){
                echo($value->id . " " . $value->titre . " " . $value->date . "<br>");
            }
        }
```



- Question 3.4

```php
        foreach (Annonce::all() as $value){
            if($value->photos()->where('taille_octet',">","100000")){
                echo($value->id . " " . $value->titre . " " . $value->date . "<br>");
            }
        }
```


 - Question 4

```php
        $p = new Photo();
        $p->file='fichier.png';
        $p->date='12/31/2456';
        $p->taille_octet='123455';

        $a = Annonce::find('22');
        $a->photos()->save($p);
```


 - Question 5

```php
        $p = Annonce::find('22');

        $a = Categorie::find('42');
        $a->categories()->save($p);

        $a = Categorie::find('73');
        $a->categories()->save($p);
```