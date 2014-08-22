node default {

  $domain = 'denkmal.dev'

  include 'cm::services'

  class {'cm::application':
    development => true,
  }

  cm::vhost {"www.${domain}":
    path => '/home/vagrant/denkmal',
    debug => true,
    aliases => [$domain, "admin.${domain}"],
  }

  environment::variable {'PHP_IDE_CONFIG':
    value => 'serverName=www.denkmal.dev',
  }

}
