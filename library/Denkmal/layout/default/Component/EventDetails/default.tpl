<div class="head clearfix">
  {if !$messageList->getCount()}
    {button_link page='Denkmal_Page_Now' icon='chat-flash' label={translate 'Write Something'} theme='transparent'}
  {/if}

  {if $mapLink}
    {button_link class='location' theme='transparent' href=$mapLink target='_blank' icon='location' label={translate 'Map'}}
  {/if}
</div>

{if $messageList->getCount()}
  {component name='Denkmal_Component_MessageList_Venue' venue=$venue count=3}
{/if}

{if $messageList->getCount()}
  <div class="action-chat">
    {button_link page='Denkmal_Page_Now' venue=$venue->getId() icon='chat-flash' label="{translate 'Read More'}…" theme='transparent'}
  </div>
{/if}
