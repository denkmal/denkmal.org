{$events = array("one", "two", "three")}
{$events =    array(array(["location" => "Sommercasino"], ["time" => "18:00"], ["name" => "Imagine Festival"], ["bands" => "The Kitchen, Sink, Wolfmother"], ["genre" => "soul, funk"]),
array(["location" => "Hirscheneck"], ["time" => "23:00-24:00"], ["name" => "Woodstock"], ["bands" => "Backstreet Boys, NSync, Kelly Family"], ["genre" => "Rock n Roll"]),
array(["location" => "Agora Bar"], ["time" => "22:00"], ["name" => ""], ["bands" => "Queen, ABBA, Scooter"], ["genre" => "Blues , Acid Jazz"]),
array(["location" => "NT Areal"], ["time" => "15:00"], ["name" => "Ballermann"], ["bands" => "The Roots, Simon and Garfunkel, The Killers"], ["genre" => "Electro, House, BoomBoom"])
)}

<ul class="eventList">
	{foreach $events as $event}
		<li>
			{component name='Denkmal_Component_Event' event=$event}
		</li>
	{/foreach}
</ul>
