<?php

namespace App\Controllers;

require_once '../app/models/Model.php';



class TagController{

    public function get($id=null){
        if($id){
            $tag=Model::show('tags WHERE id = ' .$id);
            include '..app/view/admin/tag.php';
        }else{
            $tage=Model::show('tags');
            include '..app/view/admin/tag.php';

        }
    }

    public function addCtegory(){
        if(isset($_POST['name'])){
            $data=[
                'name'=>$_POST['name']
            ];
            Model:add('tags',$data);
            header('Location :/tag');
        }
    }
    // modifie categorie
    public function modifie($id){
        if(isset($_POST['name'])){
            $data=[
                'name'=>$_POST['name']
            ];
            Model::update('tags',$id,$data);
            header('Location:/tag');
        }
        
    }
    //supprime categorires
    public function supprime(){
        
            Model::delete('tags',$id);
            header('Location:/tag');
    }
}





?>
