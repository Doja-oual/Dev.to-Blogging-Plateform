<?php
namespace App\Controllers;

require_once '../../vendor/autoload.php';
use Config\Database;
use App\Models\Model;
// namespace app\TagControllers;


// require_once '../models/Model.php';

class TagController{

    public  function getTag($id=null){
        if($id){
            $tag=Model::show('tags WHERE id = ' .$id);

            include '..app/view/tag.php';
        }else{
            $tag=Model::show('tags');
            // include '..app/view/tag.php';
            return $tag;

        }
    }

    public  function addTag(){
        if(isset($_POST['name'])){
            $data=[
                'name'=>$_POST['name']
            ];
            Model:add('tags',$data);
            header('Location :/tag');
        }
    }
    // modifie categorie
    public  function modifieTag($id){
        if(isset($_POST['name'])){
            $data=[
                'name'=>$_POST['name']
            ];
            Model::update('tags',$id,$data);
            header('Location:/tag');
        }
        
    }
    //supprime categorires
    public  function supprimeTag(){
        
            Model::delete('tags',$id);
            header('Location:/tag');
    }
}





?>
