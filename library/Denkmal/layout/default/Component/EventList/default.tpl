<div class="eventListMeta">{$render->getSite()->getRegion()->getName()|escape} - <time>{date_full date=$date timeZone=$date->getTimeZone()}</time></div>

{if $events->getCount()}
  <ul class="eventList">
    {foreach $events as $event}
      <li>
        {component name='Denkmal_Component_Event' event=$event}
      </li>
    {/foreach}
  </ul>
{else}
  <div class="noContent">
    {button_link page="Denkmal_Page_Add" theme="highlight" icon="plus" label="{translate 'Add Event'}"}
  </div>
{/if}

{if $twitterAccount || $facebookAccount}
  <div class="socialFollow">
    {if $twitterAccount}
      <a class="link hasIcon" href="https://twitter.com/{$twitterAccount}" target="_blank" title="{translate 'Follow us on Twitter'}">
        <span class="icon icon-twitter"></span>
      </a>
    {/if}
    {if $facebookAccount}
      <a class="link hasIcon" href="https://www.facebook.com/{$facebookAccount}" target="_blank" title="{translate 'Find us on Facebook'}">
        <span class="icon icon-facebook"></span>
      </a>
    {/if}
  </div>
{/if}
