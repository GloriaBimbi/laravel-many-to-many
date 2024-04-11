<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'title', 'content'];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
    
    // metodo per ottenere solo un abstract del content dei projects passando come parametro il numero di caratteri che voglio che vengano visualizzati (al quale diamo un default di 50, nel caso in cui da fuori (nella index) non venga specificato niente)
    // questo metodo ritorna un ternario che fa in modo che si vedano i ... alla fine dell'abstract solo nel caso in cui esso non sia uguale al content, ma solo una sua parte
    public function getAbstract($chars_number = 50) {
        return (strlen($this->content) > $chars_number) ? substr($this->content, 0, $chars_number) . '...' : $this->content;
    }

    //metodo da richiamare nelle viste per ottenere un un elenco delle technologie seguite da virgole (a meno che non si tratti dell'ultima)
    public function getTechnologiesToText(){
        return implode(', ', $this->technologies->pluck('label')->toArray());
    }

}
