{block name='before'}{/block}

<ul class="messageList clearfix">
  {foreach $messageList->getItems() as $message}
    <li class="message" data-id="{$message->getId()|escape}">

      <div class="message-header">
        <a href="{linkUrl page='Denkmal_Page_Now' venue=$message->getVenue()->getId()}" class="message-venue nowrap">
          {$message->getVenue()->getName()|escape}
        </a>
        <div class="message-created nowrap">
          {date_timeago time=$message->getCreated()->getTimestamp()}
        </div>
      </div>

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
          <div class="message-text message-sheet usertext">
            {$message->getText()|escape}
          </div>
        {/if}
      </div>

      {if $message->getUser() || $canDelete}
        <div class="message-meta message-sheet">
          {if $message->getUser()}
            <span class="message-user">
              <span class="username nowrap">
                {$message->getUser()->getDisplayName()|escape}
              </span>
              <span class="icon icon-hipster"></span>
            </span>
          {/if}
          {if $canDelete}
            {button_link class='deleteMessage warning' icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
          {/if}
        </div>
      {/if}
    </li>
  {/foreach}
</ul>

<script type="text/template" class="template-message">
  <li class="message" data-id="[[-id]]">

    <div class="message-header">
      <a href="{literal}[[print(cm.getUrl('/now', {venue:venue.id}))]]{/literal}" class="message-venue nowrap">
        [[-venue.name]]
      </a>
      <div class="message-created nowrap">
        [[print(cm.date.timeago(created))]]
      </div>
    </div>

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
      <div class="message-text message-sheet usertext">
        [[-text]]
      </div>
      [[ } ]]
    </div>

    [[ if (hasUser || canDelete) { ]]
    <div class="message-meta message-sheet">
      [[ if (hasUser) { ]]
          <span class="message-user">
            <span class="username nowrap">
              [[-user.displayName]]
            </span>
            <span class="icon icon-hipster"></span>
          </span>
      [[ } ]]
      [[ if (canDelete) { ]]
      {button_link class='deleteMessage warning' icon='trash' iconConfirm='trash-open' data=['click-confirmed' => true]}
      [[ } ]]
    </div>
    [[ } ]]
  </li>
</script>
