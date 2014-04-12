{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <div class="notFound">
    <p>{translate 'Why do I see sheeps?'}</p>
    {img path="sheep.png" class='notFound-image'}
    {component name='CM_Component_Notfound'}
  </div>
{/block}
