{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {foreach $eventCategoryList as $eventCategory}
    {component name='Admin_Component_EventCategory' eventCategory=$eventCategory}
  {/foreach}
{/block}