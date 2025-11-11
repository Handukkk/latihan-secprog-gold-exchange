<?php
include 'config/database.php';


if (is_connect_to_db() && is_db_exist() && is_tables_exist()) {
    //kalau udah ready semua, glhf
    header("Location: ./public/index.php");
} else{
    //kalau gak nemu redirect ke install.php
    header("Location: install.php");
}