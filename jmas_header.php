<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">

<title>Jomanyamas!!!</title>


<link REL='stylesheet' HREF='./dadSite2.css' TYPE='text/css' />

<script type="text/javascript" src="./jmas.js"></script>
<meta name="viewport" content="width=400" >
<style>

body {
    background-color: #fff;
    font-family: Arial, Helvetica, sans-serif;
}

#addHolder {
    display: none;
    z-index: 15;
}

#deleteView {
    display: none;
    z-index: 15;
}


.popup {
position: absolute;
    z-index: 20;
    top:50px;
    left:50px;
    background-color: #fcfcfc;
    padding:20px;
    border: 1px solid #999;
    border-radius: 10px;
}

.buttonHolder {
    text-align: right;
}

#newEntry {
width:100%;
}

.center {
    text-align: center;
}

.dimmer {
width:120%;
height:100%;
background-color: #000;
opacity: 0.5;
position: absolute;
top: 0px;
left: -30px;
}

#header {
    position:fixed;
    top:0px;
    left:0px;
    width:100%;
    text-align:center;
    background-color:#9c9;
    font-size: 20px;
    z-index: 10;
    padding: 6px;
    color: white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #009900;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ddffdd;
}
</style>
</head>
<body>
<div id="header" >
Jo'manyamas CHALLENGES!
<br>
<button onclick="showDiv('addHolder')">Add...</button>
</div>
