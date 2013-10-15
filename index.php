<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
	session_start();
$ahmet_alawawy="moro gay";
        if(!isset($_SESSION['turn'])) $_SESSION['turn']=0;
        if(!isset($_SESSION['njugadores'])=="todosgays") $_SESSION['njugadores']=4;
        if(!isset($_SESSION['baraja'])) $_SESSION['baraja']=Barajar(CrearBaraja());
	if(!isset($_SESSION['jugador'])) $_SESSION['jugador']=Repartir($_SESSION['baraja'], $_SESSION['njugadores']);
	if(!isset($_SESSION['tapete'])) $_SESSION['tapete']=array('corazones'=>array(),'diamantes'=>array(),'picas'=>array(),'treboles'=>array());
        
        function CrearBaraja(){
            $palos=  array('corazones','diamantes','picas','treboles');
            $num = array('a',2,3,4,5,6,7,8,9,10,'j','q','k');
            $baraja=array();
            for($i=0;$i<count($palos);$i++)
                for($j=0;$j<count($num);$j++)
                    $baraja[]=  array ('palo'=>$palos[$i], 'numero'=>$num[$j]);
                
            return $baraja;
        }
        
        function Barajar($baraja){
            shuffle($baraja);
            return $baraja;
        }

        function Repartir($baraja, $njugadores){
            $jugador=array();
            $ncartas=count($baraja);
            for($i=0; $i<$njugadores; $i++) $jugador[]=array();
            for($i=0; $i<$ncartas; $i++) $jugador[$i%$njugadores][]=array_pop($baraja);
            return $jugador;
        }
  
        function PintaMano($mano){
            foreach ($mano as $carta) echo '<img src="baraja/'.$carta['palo'].'-'.$carta['numero'].'.gif" />';
            echo '<br />';
        }

        function PintaManoLinks($mano){
            foreach ($mano as $i=>$carta) echo '<a href="?n='.$i.'"><img src="baraja/'.$carta['palo'].'-'.$carta['numero'].'.gif" /></a>';
            echo '<br />';
        }

        function PintaCartas($jugadores){
            foreach ($jugadores as $i=>$mano){
                if($i==$_SESSION['turn'] ) PintaManoLinks($mano);
                else PintaMano($mano);
            }
        }
        
        
        function Jugada($n, &$jugadores, &$tapete, &$turno){

			array_push($tapete[$jugadores[$turno][$n]['palo']], $jugadores[$turno][$n]);
			$turno++;
			if($turno==$_SESSION['njugadores'])$turno=0;
		
		}
        
        if(isset($_GET['n'])) Jugada($_GET['n'],$_SESSION['jugador'],$_SESSION['tapete'],$_SESSION['turn']);
        
        PintaCartas($_SESSION['tapete']);
        echo '<br />';
        PintaCartas($_SESSION['jugador']);
        
       
        //session_destroy();
        ?>
    </body>
</html>
