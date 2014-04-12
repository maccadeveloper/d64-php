<?
// d64-web 0.01a
$show_bam = $_POST["show_bam"]||$_GET["show_bam"];
$show_dir = $_POST["show_dir"]||$_GET["show_dir"];
$Submit = $_POST["Submit"]||$_GET["Submit"];
$followfile = "demo1.d64";
//$file = $_POST["file"]||$_GET["file"];
if ( $show_bam == '1' ) {
	$checked_bam = "checked";
} else {
	$checked_bam = "unchecked";
}

if ( $show_dir == '1' ) {
	$checked_dir = "checked";
} else {
	$checked_dir = "unchecked";
}

?>
<html>
<body>
<font face="Arial, Helvetica, sans-serif">
<form name=file action=<?=$_SERVER['PHP_SELF']?> method=post>
Show BAM <input type=checkbox name=show_bam value=1 <?=$checked_bam?>>
 - Show Directory <input type=checkbox name=show_dir value=1 <?=$checked_dir?>>
 - Disk Image File <input type=text name=file value=<?=$file?>>
<input type=submit name=Submit value="Submit">
</form>

<?
if ( $followfile ) {
	$followfile = base64_decode($followfile);
	echo "Followfile: $followfile";
}else{
	$followfile = $file;
}

if ( $Submit ) {

$format = substr($file, -2);

if ( substr($file, -2) == 'gz' ) {
	$format = substr($file, -5, 2);
}

//$d64 = gzopen( $file, "r" );
$d64 = fopen( "demo1.d64", "r" );
echo("<pre>");
for($x=0;$x<664;$x++)
{
	fseek($d64, ($x * 256));
	$out = fread($d64, 2);
	echo(dechex($x).":".bin2hex($out).":");
	fseek($d64, ($x * 256)+2);
	$out = fread($d64, 254);
	echo(bin2hex($out)."<br />");
}
echo("</pre>");
			
//  Track #Sect #Blocks in D64 Offset   Track #Sect #Blocks in D64 Offset
//  ----- ----- ---------- ----------   ----- ----- ---------- ----------
//    1     21       0       $00000      21     19     414       $19E00
//    2     21      21       $01500      22     19     433       $1B100
//    3     21      42       $02A00      23     19     452       $1C400
//    4     21      63       $03F00      24     19     471       $1D700
//    5     21      84       $05400      25     18     490       $1EA00
//    6     21     105       $06900      26     18     508       $1FC00
//    7     21     126       $07E00      27     18     526       $20E00
//    8     21     147       $09300      28     18     544       $22000
//    9     21     168       $0A800      29     18     562       $23200
//   10     21     189       $0BD00      30     18     580       $24400
//   11     21     210       $0D200      31     17     598       $25600
//   12     21     231       $0E700      32     17     615       $26700
//   13     21     252       $0FC00      33     17     632       $27800
//   14     21     273       $11100      34     17     649       $28900
//   15     21     294       $12600      35     17     666       $29A00
//   16     21     315       $13B00      36*    17     683       $2AB00
//   17     21     336       $15000      37*    17     700       $2BC00
//   18     19     357       $16500      38*    17     717       $2CD00
//   19     19     376       $17800      39*    17     734       $2DE00
//   20     19     395       $18B00      40*    17     751       $2EF00

//  Track #Sect #SectorsIn D71 Offset    Track #Sect #SectorsIn D71 Offset
//  ----- ----- ---------- ----------    ----- ----- ---------- ----------
//    1     21       0       $00000        36    21     683       $2AB00
//    2     21      21       $01500        37    21     704       $2C000
//    3     21      42       $02A00        38    21     725       $2D500
//    4     21      63       $03F00        39    21     746       $2EA00
//    5     21      84       $05400        40    21     767       $2FF00
//    6     21     105       $06900        41    21     788       $31400
//    7     21     126       $07E00        42    21     809       $32900
//    8     21     147       $09300        43    21     830       $33E00
//    9     21     168       $0A800        44    21     851       $35300
//   10     21     189       $0BD00        45    21     872       $36800
//   11     21     210       $0D200        46    21     893       $37D00
//   12     21     231       $0E700        47    21     914       $39200
//   13     21     252       $0FC00        48    21     935       $3A700
//   14     21     273       $11100        49    21     956       $3BC00
//   15     21     294       $12600        50    21     977       $3D100
//   16     21     315       $13B00        51    21     998       $3E600
//   17     21     336       $15000        52    21    1019       $3FB00
//   18     19     357       $16500        53    19    1040       $41000
//   19     19     376       $17800        54    19    1059       $42300
//   20     19     395       $18B00        55    19    1078       $43600
//   21     19     414       $19E00        56    19    1097       $44900
//   22     19     433       $1B100        57    19    1116       $45C00
//   23     19     452       $1C400        58    19    1135       $46F00
//   24     19     471       $1D700        59    19    1154       $48200
//   25     18     490       $1EA00        60    18    1173       $49500
//   26     18     508       $1FC00        61    18    1191       $4A700
//   27     18     526       $20E00        62    18    1209       $4B900
//   28     18     544       $22000        63    18    1227       $4CB00
//   29     18     562       $23200        64    18    1245       $4DD00
//   30     18     580       $24400        65    18    1263       $4EF00
//   31     17     598       $25600        66    17    1281       $50100
//   32     17     615       $26700        67    17    1298       $51200
//   33     17     632       $27800        68    17    1315       $52300
//   34     17     649       $28900        69    17    1332       $53400
//   35     17     666       $29A00        70    17    1349       $54500

//  Track #Sect #SectorsIn D81 Offset  |  Track #Sect #SectorsIn D81 Offset
//  ----- ----- ---------- ----------  |  ----- ----- ---------- ----------
//    1     40       0       $00000    |    41     40    1600       $64000
//    2     40      40       $02800    |    42     40    1640       $66800
//    3     40      80       $05000    |    43     40    1680       $69000
//    4     40     120       $07800    |    44     40    1720       $6B800
//    5     40     160       $0A000    |    45     40    1760       $6E000
//    6     40     200       $0C800    |    46     40    1800       $70800
//    7     40     240       $0F000    |    47     40    1840       $73000
//    8     40     280       $11800    |    48     40    1880       $75800
//    9     40     320       $14000    |    49     40    1920       $78000
//   10     40     360       $16800    |    50     40    1960       $7A800
//   11     40     400       $19000    |    51     40    2000       $7D000
//   12     40     440       $1B800    |    52     40    2040       $7F800
//   13     40     480       $1E000    |    53     40    2080       $82000
//   14     40     520       $20800    |    54     40    2120       $84800
//   15     40     560       $23000    |    55     40    2160       $87000
//   16     40     600       $25800    |    56     40    2200       $89800
//   17     40     640       $28000    |    57     40    2240       $8C000
//   18     40     680       $2A800    |    58     40    2280       $8E800
//   19     40     720       $2D000    |    59     40    2320       $91000
//   20     40     760       $2F800    |    60     40    2360       $93800
//   21     40     800       $32000    |    61     40    2400       $96000
//   22     40     840       $34800    |    62     40    2440       $98800
//   23     40     880       $37000    |    63     40    2480       $9B000
//   24     40     920       $39800    |    64     40    2520       $9D800
//   25     40     960       $3C000    |    65     40    2560       $A0000
//   26     40    1000       $3E800    |    66     40    2600       $A2B00
//   27     40    1040       $41000    |    67     40    2640       $A5000
//   28     40    1080       $43800    |    68     40    2680       $A7800
//   29     40    1120       $46000    |    69     40    2720       $AA000
//   30     40    1160       $48800    |    70     40    2760       $AC800
//   31     40    1200       $4B000    |    71     40    2800       $AF000
//   32     40    1240       $4D800    |    72     40    2840       $B1800
//   33     40    1280       $50000    |    73     40    2880       $B4000
//   34     40    1320       $52800    |    74     40    2920       $B6800
//   35     40    1360       $55000    |    75     40    2960       $B9000
//   36     40    1400       $57800    |    76     40    3000       $BB800
//   37     40    1440       $5A000    |    77     40    3040       $BE000
//   38     40    1480       $5C800    |    78     40    3080       $C0800
//   39     40    1520       $5F000    |    79     40    3120       $C3000
//   40     40    1560       $61800    |    80     40    3160       $C5800


if ( $format == '' ) {
	echo "Unknown format, will attempt D64<hr>";
	
}
$format = 64;
// Veo que formato de disco es
switch ( $format ) {
	case 64:
		$blk = 664;
		$sectors = 21; // hasta la pista 17 !!!!
		$dir = 18;
		$drive = "1541";
		break;
	case 71:
		$blk = 1328;
		$sectors = 21; // hasta la pista 17 !!!!
		$dir = 18;
		$drive = "1571";
		break;
	case 81:
		$blk = 3200;
		$sectors = 40; // todas las pistas !!!!
		$dir = 40;
		$drive = "1581";
		break;
	default:
		die("No puedo procesar el formato $formato.");
}

// Moved 256-byte sectors per track of each disc format
// and up to the track directory and that 141 added to advance the BAM
// If it is d64, d71
$offset 	= ( (256 * $sectors) * ($dir-1) );

if ( $format == '64' or $format == '71' ) {
	// Different Offsets for the header
	$offset_bam 	= $offset + 0;
	$offset_name 	= $offset + 144;
	$offset_id 	= $offset + 162;
	$offset_2a 	= $offset + 165;
	$offset_xtra 	= $offset + 180;

	// read the name of the disc
	fseek($d64, $offset_name);
	$nombre = fread($d64, 17);

	// read the ID of the disc
	fseek($d64, $offset_id);
	$id = fread($d64, 2);

	// read the 2A of the disc
	fseek($d64, $offset_2a);
	$dosa = fread($d64, 2);

	// read the extra characters if any
	fseek($d64, $offset_xtra);
	$extra = fread($d64, 11);
}

if ( $format == '81' ) {
	// Different Offsets for the header
	$offset_name 	= $offset + 4;
	$offset_id 	= $offset + 22;
	$offset_2a 	= $offset + 25;

	// Leo el nombre del disco
	fseek($d64, $offset_name);
	$nombre = fread($d64, 16);

	// Leo el ID del disco
	fseek($d64, $offset_id);
	$id = fread($d64, 2);

	// Leo el 2A del disco
	fseek($d64, $offset_2a);
	$dosa = fread($d64, 2);

	$extra = "N/A";

}

?>
<table cellpadding="2" cellspacing="2" border="1" style="text-align: left; width: 100%;">
  <tbody>
      <tr bgcolor="#efefef">
	    <td>Extra information: <?=$extra?></td>
	    <td colspan=2>Image: <?=$drive?></td>
	</tr>
	<tr bgcolor="#ffffcc">
	    <td width=80%><?=$nombre?></td><td width=10><?=$id?></td><td width=10><?=$dosa?></td>
      </tr>
  </tbody>
</table>
<?

if ( $show_dir == 1 ) {
	$parms = "file=$file&show_bam=$show_bam&show_dir=$show_dir&Submit=Submit";
	echo "<br><center><font size=+3>Directory</font>";
	LeerDir($d64, $dir, $format, $parms);
	echo "</center>";
}

// Muestro la BAM si corresponde
if ( $show_bam == 1 ) {
	echo "<br><center><font size=+3>BAM (Block Availability Map)</font>";

	$td=$_GET["td"];
	$sd=$_GET["sd"];

	ShowBam($d64, $offset_bam, $format, $followfile, $td, $sd);
	echo "</center>";
}

fclose($d64);
}


// Funcion para leer el directorio
function LeerDir($d64, $tr, $format, $parms) {
	require("tracks.inc");

	$t = $tr;
	if ( $format == '81' ) {
		// La primera entrada de directorio esta 
		// en el sector 3 en la 1581
		$s = 3;
	} else {
		// La primera entrada de directorio esta 
		// en el sector 1 en la 1541 y 1571
		$s = 1;
	}

	$entry = 0;
	$tot_blocks = 0;

	?>
	<table cellpadding="2" cellspacing="2" border="1" style="text-align: left; width: 50%;">
	  <tbody>
			    <tr bgcolor="#ccccff">
			        <td width=10%>Blocks</td>
				  <td width=60%>Name</td>
				  <td width=10%>Type</td>
				  <td width=10%>Track</td>
				  <td width=10%>Sector</td>
			    </tr>

	<?

	while ( $t > 0 ) {
		$tr = $t;

		for ( $cant=0; $cant < 8; $cant++ ) {

			// Advance to the track directory and add 32 for the next input
			fseek($d64, ( $track[$tr] + (256*$s) + 2 ) + ( $cant * 32 ) );
			$type = ord(fread($d64, 1));
			//echo ">>>>>>> $type <<<<<<<<\n";
			$type = $type - 128;

			switch ( $type ) {
				case 0:
					$type = "DEL";
					break;
		
				case 1:
					$type = "SEQ";
					break;
		
				case 2:
					$type = "PRG";
					break;
			
				case 3:
					$type = "USR";
					break;
			
				case 4:
					$type = "REL";
					break;

				case 66:
					$type = "PRG<";
					break;

				case 69:
					$type = "CBM";
					break;

				case -128:
					$type = "???";
					break;
		
				}

		
			fseek($d64, ( $track[$tr] + (256*$s) + 3 ) + ( $cant * 32 ) );
			$td = ord(fread($d64, 1));
	
			fseek($d64, ( $track[$tr] + (256*$s) + 4 ) + ( $cant * 32 ) );
			$sd = ord(fread($d64, 1));
	
			fseek($d64, ( $track[$tr] + (256*$s) + 5 ) + ( $cant * 32 ) );
			$dir = fread($d64, 16);

			fseek($d64, ( $track[$tr] + (256*$s) + 30 ) + ( $cant * 32 ) );
			$blocks = ord(fread($d64, 2));
	
			if ( $type != '???' ) {
			if ( $bgcolor == "#efefef") {
				$bgcolor= "#cccccc";
			} else {
				$bgcolor= "#efefef";
			}
			?>
			    <tr bgcolor="<?=$bgcolor?>">
			        <td width=10%><?=$blocks?></td>
				  <td width=60%><a href=<?$PHP_SELF?>?followfile=<?=base64_encode($dir)?>&td=<?=$td?>&sd=<?=$sd?>&<?=$parms?>><?=$dir?></a></td>
				  <td width=10%><?=$type?></td>
				  <td width=10%><?=$td?></td>
				  <td width=10%><?=$sd?></td>
			    </tr>

			<?
				$entry++;
				$tot_blocks = $tot_blocks + $blocks;
			}
		}
		// Leo Track tr sector 1
		fseek($d64, $track[$tr] + (256*$s) );
		$t = ord(fread($d64, 1));
	
		fseek($d64, $track[$tr] + (256*$s) + 1);
		$s = ord(fread($d64, 1));
	}
	switch ( $format ) {
		case 64:
			$blk = 664;
			$sectors = 21;
			break;
		case 71:
			$blk = 1328;
			$sectors = 21;
			break;
		case 81:
			$blk = 3160;
			$sectors = 40;
			break;
	}
	?>
	    <tr bgcolor="#ffffcc">
	          <td style="vertical-align: top;" rowspan="1" colspan="5"><?=$tot_blocks?> blocks used in <?=$entry?> files. <?=($blk-$tot_blocks)?> blocks free.</td>
	    </tr>
	</tbody>
	</table>

	<?

}


function ShowBam($d64, $offset_bam, $format, $followfile, $td, $sd) {
	require("tracks.inc");

	if ( $format == '64' or $format =='71' ) {
		// Leo la BAM del disco
		for ( $a=0; $a < 144; $a++ ) {
			fseek($d64, $offset_bam + $a);
			$bam[$a] = fread($d64, 1);
		}
	}

	if ( $format == '71' ) {
		// Read the second part of the disk BAM
		// In track 53 (18 on the 2 side) this 2nd BAM. side
		// To follow agragando to the array of the BAM
		// I'm still in the 144 and endorse him 104 (because the structure of the BAM)
		// 2nd. side is different, as they improvised!
		// or go to 248
		$offset_bam2 = ( (256 * 21) * (53-1) );
		for ( $a=144; $a < 248; $a++ ) {
			fseek($d64, $offset_bam2 + $a);
			$bam[$a] = fread($d64, 1);
		}
	}
	//echo "(T: ".ord($bam[0]).")(S: ".ord($bam[1]).")(DOS Version: ".$bam[2].")<br>";

	if ( $format == '64' ) {
		// Veo los sectores libres
		$trac=1;
		for ( $a=4; $a <= 140; $a=$a+4) {
			$free[$trac++] = ord($bam[$a]);
		}
	}

	if ( $format == '71' ) {
		// Veo los sectores libres de las pistas 36 a 70
		//for ( $a=144; $a < 248; $a++ ) {
		//	fseek($d64, $offset_bam2 + $a);
		//	$bam[$a] = fread($d64, 1);
		//}
		//$trac=36;
		//for ( $a=4; $a <= 140; $a=$a+4) {
		//	$free[$trac++] = ord($bam[$a]);
		//}
	}

	$trac=1;
	$bam_disk[]="";


	for ( $a=5; $a <= 141; $a++) {
		// take 3 bytes for each sector
		$byte[1] = decbin(ord($bam[$a++]));
		$byte[2] = decbin(ord($bam[$a++]));
		$byte[3] = decbin(ord($bam[$a++]));

		for ( $x=1; $x <= 3; $x++ ) {
			// fill to 8 bits
			$byte[$x] = sprintf("%08d",$byte[$x]);

			// invert every byte because the BAM uses asii
			for ( $z=7; $z>=0; $z-- ) {
				if ( $byte[$x][$z] != '' ) {
					// store the BAM track by track
					$bam_disk[$trac] = $bam_disk[$trac] . $byte[$x][$z];
				}
			}
		}

		$trac++;

	}


	if ( $format == '64' ) {
		// Continue to see that the file occupies sectors
		if ( $followfile ) {
			$arr_ts[1] = $td.":".$sd;
			echo("<h3>Block used in this file</h3>");
			echo("<br />".str_pad(dechex($td),2,"0",STR_PAD_LEFT).":".str_pad(dechex($sd),2,"0",STR_PAD_LEFT));   
					 
			$arr_orden[$arr_ts[1]] = 1;
			// try to extract actual data
			$off = $track[$td] + ($sd*256);
			fseek($d64, $off+2);
			$out = fread($d64, 254);
			echo("<br />".bin2hex($out));
			//echo(bin2hex($out));
			$i=2;
			while ( $td != 0 ) {
				// Calculate the offset to read from disk
				if ( $td < 10 ) {
					$td = "0".$td;
				}
				//echo ">>(".$track[$td].")(".$td.")(".$sd.")<<";
				$finaltd=$td;
				$finalsd=$sd;
				$off = $track[$td] + ($sd*256);
				fseek($d64, $off);
				$td = ord(fread($d64, 1));

				fseek($d64, ($off+1) );
				$sd = ord(fread($d64, 1));

				// for the last block use track = $00 then next bytes to $00xx where xx is the last byte of the file

				//if ( $td != 0 ) {
					
					if ($td !=0){
						$off = $track[$td] + ($sd*256);
						fseek($d64, $off+2);
						echo(" -> ".str_pad(dechex($td),2,"0",STR_PAD_LEFT).":".str_pad(dechex($sd),2,"0",STR_PAD_LEFT));
						$buffer = fread($d64, 254);
					}else{
						//$off = $track[$finaltd] + ($finalsd*256);
						fseek($d64, $off+2);
						echo(" -> ".str_pad(dechex($td),2,"0",STR_PAD_LEFT).":".str_pad(dechex($sd),2,"0",STR_PAD_LEFT));

						$buffer = fread($d64, $sd-1);
					}

					echo("<br />".bin2hex($buffer));
					$out .= $buffer;
					$arr_ts[$i] = $td.":".$sd;
					//echo("<br />".str_pad(dechex($td),2,"0",STR_PAD_LEFT).":".str_pad(dechex($sd),2,"0",STR_PAD_LEFT));
					$arr_orden[$arr_ts[$i]] = $i;
					$i++;
					
				//}
			}
			
			//$off = $track[$finaltd] + ($finalsd*256);
			//fseek($d64, $off+2);
			//$buffer = fread($d64, $sd);
			//echo("<br />".bin2hex($buffer));
			//$out .= $buffer;
			
			echo("<br />".bin2hex($out)."<br />");
		}
/*
		echo "<hr>";
		foreach ( $arr_ts as $data ) {
			echo $data."<br>";
		}
		echo "<hr>";
		foreach ( $arr_orden as $data ) {
			echo $data."<br>";
		}
		echo "<hr>";
*/

		echo "<table border=1>";
		echo "<tr><td>Track</td><td>Free</td><td>0</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>a</td><td>b</td><td>c</td><td>d</td><td>e</td><td>f</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>";
		for( $tr=1; $tr<$trac; $tr++ ) {
			echo "<tr><td><b>".dechex($tr)."($tr)</b></td><td>($free[$tr])</td>";
			for( $sec=0; $sec<=20; $sec++ ) {
				switch( $tr ) {
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
					case 6:
					case 7:
					case 8:
					case 9:
					case 10:
					case 11:
					case 12:
					case 13:
					case 14:
					case 15:
					case 16:
					case 17:
						if ( $sec <= 20 ) {
							if ( $bam_disk[$tr][$sec] == '1' ) {
								$bam_disk[$tr][$sec] = '';
								$color = '#cccccc';
							} else {
								$bam_disk[$tr][$sec] = 'X';
								$color = '#000000';
							}
							if ( $followfile ) {
								if ( in_array($tr.":".$sec, $arr_ts) ) {
									$bam_disk[$tr][$sec] = ' ';
									$color = '#ffff00';
								}
							}
							echo "<td bgcolor=".$color." width=20>".$arr_orden[$tr.":".$sec]."</td>";
						}
						break;
					case 18:
					case 19:
					case 20:
					case 21:
					case 22:
					case 23:
					case 24:
						if ( $sec <= 18 ) {
							if ( $bam_disk[$tr][$sec] == '1' ) {
								$bam_disk[$tr][$sec] = '';
								$color = '#cccccc';
							} else {
								$bam_disk[$tr][$sec] = 'X';
								$color = '#000000';
							}
							if ( $followfile ) {
								if ( in_array($tr.":".$sec, $arr_ts) ) {
									$bam_disk[$tr][$sec] = ' ';
									$color = '#ffff00';
								}
							}
							echo "<td bgcolor=".$color." width=20>".$arr_orden[$tr.":".$sec]."</td>";
						}
						break;

					case 25:
					case 26:
					case 27:
					case 28:
					case 29:
					case 30:
						if ( $sec <= 17 ) {
							if ( $bam_disk[$tr][$sec] == '1' ) {
								$bam_disk[$tr][$sec] = '';
								$color = '#cccccc';
							} else {
								$bam_disk[$tr][$sec] = 'X';
								$color = '#000000';
							}
							if ( $followfile ) {
								if ( in_array($tr.":".$sec, $arr_ts) ) {
									$bam_disk[$tr][$sec] = ' ';
									$color = '#ffff00';
								}
							}
							echo "<td bgcolor=".$color." width=20>".$arr_orden[$tr.":".$sec]."</td>";
						}
						break;

					case 31:
					case 32:
					case 33:
					case 34:
					case 35:
					case 36:
					case 37:
					case 38:
					case 39:
					case 40:
						if ( $sec <= 16 ) {
							if ( $bam_disk[$tr][$sec] == '1' ) {
								$bam_disk[$tr][$sec] = '';
								$color = '#cccccc';
							} else {
								$bam_disk[$tr][$sec] = 'X';
								$color = '#000000';
							}
							if ( $followfile ) {
								if ( in_array($tr.":".$sec, $arr_ts) ) {
									$bam_disk[$tr][$sec] = ' ';
									$color = '#ffff00';
								}
							}
							echo "<td bgcolor=".$color." width=20>".$arr_orden[$tr.":".$sec]."</td>";
						}
						break;
				} 
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}



?>
</font>
</body>
</html>
