<div class="toggleNext">
  {$user->getDisplayName()|escape} <span class="email">&lt;{$user->getEmail()|escape}&gt;</span>
  <ul class="roles">
    {foreach $user->getRoles()->get() as $role}
      <li class="role">{translate ".internals.role.{$role}"}</li>
    {/foreach}
  </ul>
</div>
<div class="toggleNext-content">
  {component name='Admin_Component_UserRoles' user=$user}

  {form name='Denkmal_Form_User' user=$user}
  {formField name='email' label={translate 'Email'}}
  {formField name='username' label={translate 'Username'}}
  {formField name='password' label={translate 'Password'}}
  {formAction action='Save' label={translate 'Save'}}
  {/form}
</div>
