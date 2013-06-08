{$events = array("one", "two", "three")}
{$events =    array(array(["location" => "Sommercasino"], ["time" => "18:00"], ["name" => "Imagine Festival"], ["bands" => "The Kitchen, Sink, Wolfmother"], ["genre" => "soul, funk"]),
array(["location" => "Hirscheneck"], ["time" => "23:00-24:00"], ["name" => "Woodstock"], ["bands" => "Backstreet Boys, NSync, Kelly Family"], ["genre" => "Rock n Roll"]),
array(["location" => "Agora Bar"], ["time" => "22:00"], ["name" => ""], ["bands" => "Queen, ABBA, Scooter"], ["genre" => "Blues , Acid Jazz"]),
array(["location" => "NT Areal"], ["time" => "15:00"], ["name" => "Ballermann"], ["bands" => "The Roots, Simon and Garfunkel, The Killers"], ["genre" => "Electro, House, BoomBoom"])
)}

<time class="currentDate">Samstag, 32. Februar 2013</time>
<ul class="eventList">
	{foreach $events as $event}
		<li class="event featured">
			{link icon="play" class="playButton navButton playAudio"}
			<div class="event-content">
				{link icon="map" class="mapButton navButton showMap"}
				<a href="javascript:;" class="location nowrap">
					{$event.0.location}
				</a>
				<span class="name nowrap">{$event.2.name}</span>
				<time class="time">
					<span class="icon icon-time"></span>
					{$event.1.time}
				</time>
				<p>
					<span class="artists nowrap">{$event.3.bands}</span>
					<span class="genre nowrap">{$event.4.genre}</span>
				</p>
			</div>
		</li>
	{/foreach}
</ul>
