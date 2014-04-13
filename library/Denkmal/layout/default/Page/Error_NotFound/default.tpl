{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  <div class="notFound">
    <h1>{translate 'Why do I see sheeps?'}</h1>
    {img path="sheep.png" class='notFound-image'}
    {component name='CM_Component_Notfound'}
    {button_link page='Denkmal_Page_Index' theme='highlight' class='button-large' label={translate 'Save me'}}
  </div>
{/block}
