<?php
/**
 * Created by PhpStorm.
 * User: bikash
 * Date: 8/9/2015
 * Time: 12:47 AM
 */
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
{
    require_once 'trophyClass.php';
    $shape["radius"] = $_POST['radius'];
    $shape["height"] = $_POST['height'];
    $shape["width"] = $_POST['width'];
    $shape["length"] = $_POST['length'];

    $shape_type = $_POST['shape_type'];
    $metal = $_POST['metal'];
    $metal_purity_percentage = $_POST['metal-purity'];
    $coating_element = $_POST['coating'];
    $coating_thickness = $_POST['coating-thickness'];

    $trophy = new trophy($shape_type, $metal, $metal_purity_percentage, $coating_element, $coating_thickness);
    $volume = $trophy->getVolumeHandle();
    $trophy->putParam($shape);
    $surface = $trophy->getSuraceAreaHandle();
    $volume_calculated = $trophy->$volume();
    $surface_calculated = $trophy->$surface();


    echo "Your quotation for trophy is - Rs." . number_format((float)$trophy->cost($volume_calculated, $surface_calculated), 2, '.', '');
}
