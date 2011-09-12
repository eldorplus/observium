<?php

#$type_text['overview'] = "Overview";
$type_text['ipsec_tunnels'] = "IPSEC Tunnels";
$type_text['bgp'] = "BGP";
$type_text['cef'] = "CEF";
$type_text['ospf'] = "OSPF";
$type_text['vrf'] = "VRFs";

print_optionbar_start();

echo("<span style='font-weight: bold;'>Routing</span> &#187; ");

unset($sep);
foreach ($routing_tabs as $type)
{

  if (!$_GET['optc']) { $_GET['optc'] = $type; }

  echo($sep);

  if ($_GET['optc'] == $type)
  {
    echo('<span class="pagemenu-selected">');
  }

  echo("<a href='".$config['base_url']."/device/".$device['device_id']."/routing/" . $type . "/'> " . $type_text[$type] ." (".$device_routing_count[$type].")</a>");
  if ($_GET['optc'] == $type) { echo("</span>"); }
  $sep = " | ";
}

print_optionbar_end();

if (is_file("pages/device/routing/".mres($_GET['optc']).".inc.php"))
{
   include("pages/device/routing/".mres($_GET['optc']).".inc.php");
} else {
  foreach ($routing_tabs as $type)
  {
    if ($type != "overview")
    {
      if(is_file("pages/device/routing/overview/".mres($type).".inc.php")) {

        $g_i++;
        if (!is_integer($g_i/2)) { $row_colour = $list_colour_a; } else { $row_colour = $list_colour_b; }

        echo('<div style="background-color: '.$row_colour.';">');
        echo('<div style="padding:4px 0px 0px 8px;"><span class=graphhead>'.$type_text[$type].'</span>');
        include("pages/device/routing/overview/".mres($type).".inc.php");
        echo('</div>');
        echo('</div>');
      } else {
        $graph_title = $type_text[$type];
        $graph_type = "device_".$type;
        include("includes/print-device-graph.php");
      }
    }
  }
}

?>
