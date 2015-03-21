<div class="toggleNext">
  {$user->getDisplayName()|escape}
  <ul class="roles">
    {foreach $user->getRoles()->get() as $role}
      <li class="role">{translate ".internals.role.{$role}"}</li>
    {/foreach}
  </ul>
</div>
<div class="toggleNext-content">
  {component name='Admin_Component_UserRoles' user=$user}

  {form name='Denkmal_Form_User' user=$user}
  {formField name='email' label={translate 'E-Mail'}}
  {formField name='username' label={translate 'Username'}}
  {formField name='password' label={translate 'Passwort'}}
  {formAction action='Save' label={translate 'Speichern'}}
  {/form}
</div>
