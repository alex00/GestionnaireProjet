<?php 

# Example :
#
# $props = array('siteName' => 'Venom',
# 				 'emailContact' => 'plop@plop.com');
# TzRender::addProps($props); # ajoute automatiquement les propriété à la vue
# 							  # en les cumulant au données déja existantes
#
use Components\RenderTplEngine\TzRender;
#
#


if (isset($_SESSION['User'])){
    $props = array('User' => $_SESSION['User']);
    TzRender::addProps($props);
}