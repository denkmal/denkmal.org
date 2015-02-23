<ul class="messageList">
  {foreach $messageList->getItems() as $message}
    <li class="message" data-id="{$message->getId()}">
      {date_timeago time=$message->getCreated()->getTimestamp()}

      <div class="message-location nowrap">
        {$message->getVenue()->getName()|escape}
      </div>

      {if $message->getUser()}
        <div class="message-user">
          {$message->getUser()->getDisplayName()|escape}
        </div>
      {/if}

      <div class="message-content">
        {if $message->hasText()}
          <div class="message-text">
            {$message->getText()|escape}
          </div>
        {/if}
        {if count($message->getTags()->getAll()) > 0}
          {strip}
          <ul class="message-tags">
            {foreach $message->getTags()->getAll() as $tag}
              <li class="tag">
                {img class='tag-image' path="tag/{$tag->getLabel()}.svg"}
              </li>
            {/foreach}
          </ul>
          {/strip}
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

    [[ if (hasUser) { ]]
      <div class="message-user">
        [[-user.displayName]]
      </div>
    [[ } ]]

    <div class="message-content">
      [[ if (hasText) { ]]
        <div class="message-text">
          [[-text]]
        </div>
      [[ } ]]
      [[ if (hasTags) { ]]
      <ul class="message-tags">
        [[ _.each(tagList, function(tagLabel) { ]]
          <li class="tag">
            {img class='tag-image' path='tag/[[-tagLabel]].svg'}
          </li>
        [[ }); ]]
      </ul>
      [[ } ]]
      [[ if (hasImage) { ]]
        <div class="message-image">
          <img src="[[-imageUrl]]" />
        </div>
      [[ } ]]
    </div>
  </li>
</script>
