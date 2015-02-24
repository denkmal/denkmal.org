<ul class="messageList clearfix">
  {foreach $messageList->getItems() as $message}
    <li class="message" data-id="{$message->getId()|escape}">

      {if $viewer && $viewer->getRoles()->contains(Denkmal_Role::ADMIN)}
        <div class="message-actions">
          {button_link class='deleteMessage' icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
        </div>
      {/if}

      <div class="message-header nowrap">
        <span class="message-venue">
          {$message->getVenue()->getName()|escape}
        </span>
      </div>

      {date_timeago time=$message->getCreated()->getTimestamp()}

      <div class="message-content">
        {if count($message->getTags()->getAll()) > 0 || $message->hasImage()}
          {strip}
            <ul class="message-tags">
              {foreach $message->getTags()->getAll() as $tag}
                <li class="tag">
                  {img class='tag-image' path="tag/{$tag->getLabel()}.svg"}
                </li>
              {/foreach}
              {if $message->hasImage()}
                <li class="tag message-image">
                  <img src="{$render->getUrlUserContent($message->getImage()->getFile('thumb'))|escape}" class="showImage" />
                </li>
              {/if}
            </ul>
          {/strip}
        {/if}
        {if $message->hasText()}
          <div class="message-text usertext">
            {$message->getText()|escape}
          </div>
        {/if}
      </div>

      {if $message->getUser()}
        <span class="message-user-container">
          <span class="message-user">
            <span class="icon icon-hipster"></span>
            {$message->getUser()->getDisplayName()|escape}
          </span>
        </span>
      {/if}
    </li>
  {/foreach}
</ul>

<script type="text/template" class="template-message">
  <li class="message" data-id="[[-id]]">

    {if $viewer && $viewer->getRoles()->contains(Denkmal_Role::ADMIN)}
      <div class="message-actions">
        {button_link class='deleteMessage' icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
      </div>
    {/if}

    <div class="message-header nowrap">
      <div class="message-venue">
        [[-venue]]
      </div>
    </div>

    [[print(cm.date.timeago(created))]]

    <div class="message-content">
      [[ if (hasTags || hasImage) { ]]
      <ul class="message-tags">
        [[ _.each(tagList, function(tagLabel) { ]]
        <li class="tag">
          {img class='tag-image' path='tag/[[-tagLabel]].svg'}
        </li>
        [[ }); ]]
        [[ if (hasImage) { ]]
        <li class="tag message-image">
          <img src="[[-imageUrl]]" class="showImage" />
        </li>
        [[ } ]]
      </ul>
      [[ } ]]
      [[ if (hasText) { ]]
      <div class="message-text usertext">
        [[-text]]
      </div>
      [[ } ]]
    </div>

    [[ if (hasUser) { ]]
    <span class="message-user-container">
      <span class="message-user">
        <span class="icon icon-hipster"></span>
        [[-user.displayName]]
      </span>
    </span>
    [[ } ]]
  </li>
</script>
