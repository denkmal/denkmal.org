<ul class="messageList">
  {foreach array_reverse($messageList->getItems()) as $message}
    <li class="message" data-id="{$message->getId()}">
      {date_timeago time=$message->getCreated()->getTimestamp()}

      <span class="message-location nowrap">
        {$message->getVenue()->getName()|escape}
      </span>

      <span class="message-content">
        {if $message->hasText()}
          <span class="message-text">
            {$message->getText()|escape}
          </span>
        {/if}
        {if $message->hasImage()}
          <span class="message-image">
            <img src="{$render->getUrlUserContent($message->getImage()->getFile('thumb'))|escape}" />
            <img src="{$render->getUrlUserContent($message->getImage()->getFile('view'))|escape}" />
          </span>
        {/if}
      </span>
    </li>
  {/foreach}
</ul>
