<ul class="messageList">
  {foreach $messageList->getItems() as $message}
    <li class="message" data-id="{$message->getId()}">
      {date_timeago time=$message->getCreated()->getTimestamp()}

      <div class="message-location nowrap">
        {$message->getVenue()->getName()|escape}
      </div>

      <div class="message-content">
        {if $message->hasText()}
          <div class="message-text">
            {$message->getText()|escape}
          </div>
        {/if}
        {if count($message->getTags()->getAll()) > 0}
          <div class="message-tags">
            {foreach $message->getTags()->getAll() as $tag}
              {img class='tag-image' path="tag/{$tag->getId()}.svg"}
            {/foreach}
          </div>
        {/if}
        {if $message->hasImage()}
          <div class="message-image">
            <img src="{$render->getUrlUserContent($message->getImage()->getFile('thumb'))|escape}" />
          </div>
        {/if}
      </div>
    </li>
  {/foreach}
</ul>

<script type="text/template" class="template-message">
  <li class="message" data-id="[[-id]]">
    [[print(cm.date.timeago(created))]]

    <div class="message-location nowrap">
      [[-venue]]
    </div>

    <div class="message-content">
      [[ if (hasText) { ]]
        <div class="message-text">
          [[-text]]
        </div>
      [[ } ]]
      [[ if (hasTags) { ]]
      <div class="message-tags">
        [[ _.each(tagList, function(tagId) { ]]
          {img class='tag-image' path='tag/[[-tagId]].svg'}
        [[ }); ]]
      </div>
      [[ } ]]
      [[ if (hasImage) { ]]
        <div class="message-image">
          <img src="[[-imageUrl]]" />
        </div>
      [[ } ]]
    </div>
  </li>
</script>
