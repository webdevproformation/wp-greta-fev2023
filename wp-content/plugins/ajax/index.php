<?php 

/**
 * Plugin Name: ajax in action
 * Author: Malik H
 * Description: ajouter ajax
 */

function add_ajax(){
    wp_register_script('add_ajax', plugins_url( 'script.js', __FILE__ ), array ('jquery'), '1', true);
    wp_enqueue_script('add_ajax');
}

add_action( 'wp_enqueue_scripts', 'add_ajax' );

function exemple_ajax_request (){
    
    if(!empty($_POST["article"])){
        //global $wp_session;
        if(!session_id()) session_start();
        $id = $_POST["article"][0];
        $nom = $_POST["article"][1];
        $sessionBefore = $_SESSION["panier"];
        if(isset($_SESSION["panier"]["{$id}"])){
            $newQte = $_SESSION["panier"]["{$id}"]["qte"] + 1 ;
            $_SESSION["panier"]["{$id}"] = ["nom" => $nom , "qte" => $newQte ];
        }else {
            $_SESSION["panier"]["{$id}"] = ["nom" => $nom , "qte" => 1 ] ;
        }
        echo json_encode($_SESSION["panier"]);
    }

    die();
}

add_action( "wp_ajax_toto" , "exemple_ajax_request") ;