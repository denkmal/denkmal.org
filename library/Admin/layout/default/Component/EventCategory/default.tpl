<ul class="genreList">
  {foreach $eventCategory->getGenreList() as $genre}
    <li class="genre" data-genre="{$genre|escape}">
      {$genre|escape}
      {button_link class='removeGenre warning' icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
    </li>
  {/foreach}
</ul>