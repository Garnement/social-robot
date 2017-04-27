<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Robot extends Model
{
    //On ajoute les champs qu'on veut remplir, c'est aussi une manière de sécuriser les données qu'on envoi.
    protected $fillable = ['name', 'description', 'category_id', 'published_at'];

    public function saveTags($tags = null)
    {
      if (!empty($tags)) 
      {
        //On se relie au modèle Tag et on utilise la méthode attach() dans lequel on passe le paramètre $tag
        $this->tags()->attach($tags);
        }
    }
    
    // Le nom de la méthode est conventionné -- CategoryId fait référence à category_id
    public function setCategoryIdAttribute($value)
    {
      $this->attributes['category_id'] = ( ($value == 0) ? null : $value ) ;
    }

    // Mise en place du mutateur permettant d'ajouter la date de soumission du formulaire
    public function setPublishedAtAttribute($value)
    {
      $this->attributes['published_at'] = ( ($value == 'on') ? Carbon::now() : null); // null == nullable();
    }

    public function getPublishedAtAttribute($date)
    {
      if ($date == null) return 'Non publié';
      
      return Carbon::parse($date)->format('d/m/Y');
      
      
    }

    public function isTag(int $tagId)
    {
      //Si le robot ne possède pas de tag false est renvoyé
      if( count($this->tags) == 0 ) return false;

      //On parcourt les tags du Robot 
      foreach($this->tags as $tag)
      {
        //tagId représente le paramètre de la fonction dans la vue
        if ($tag->id == $tagId) return true;
      }
      return false;



    }

    public function category()
    {
    return $this->belongsTo(Category::class); // Relie la table robots à la table categories [ManyToOne];
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function tags()
    {
      return $this->belongsToMany(Tag::class); // permet de récuperer tous les tags d'un robot.
    }

}
