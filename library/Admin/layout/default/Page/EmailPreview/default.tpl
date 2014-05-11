{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <ul class="emailList menu-pills">
    {foreach $emailList as $emailItem}
      <li class="email{if $emailItem == $activeEmail} active{/if}">
        <a href="{linkUrl page='Admin_Page_EmailPreview' class=$emailItem}">{$emailItem}</a>
      </li>
    {/foreach}
  </ul>
  {component name='CM_Component_EmailPreview' email=$email}
{/block}
